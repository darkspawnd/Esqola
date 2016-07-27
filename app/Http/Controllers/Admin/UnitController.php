<?php

namespace App\Http\Controllers\Admin;

use App\errors as Error;
use App\Grades as Grade;
use App\Units as Unit;
use App\Http\Requests;
use App\User as User;
use App\User_attribute as Attributes;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission as Permission;
use Spatie\Permission\Models\Role as Roles;
use Validation;
use Webpatser\Uuid\Uuid as UUID;

class UnitController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function index() {
        $units = Unit::all();
        return view('admin.units.main', ['units' => $units]);
    }

    /**
     * @return mixed
     */
    public function add() {
        return view('admin.units.add');
    }

    /**
     * @param Request $data
     * @return mixed
     */
    public function create(Request $data) {
        $user = Auth::user();
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'confirmed' => 'Las contraseñas no coinciden.',
            'min' => 'El campo :attribute debe de cumplir con el número de caracteres.'
        ];
        $this->validate($data, [
            'unit' => 'required'
        ], $message);

        try{
            if(!Unit::where('common_name','=',$data['unit'])->exists()){
                DB::table('units')->insert( array(
                    'unit_number' => $data['unit'],
                    'common_name' => $data['unit'])
                );

                $status = (object) array(
                    'created' => 'success',
                    'message' => 'Unidad creada satisfactoriamente..',
                );
            } else {
                $status = (object) array(
                    'created' => 'error',
                    'message' => 'Error creando Unidad, Unidad ya existe.',
                );
            }
        } catch (\Exception $e) {
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to create Unit',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error creando Unidad intente de nuevo.',
            );
        }

        return view('admin.units.add',['status'=>$status]);
    }

    public function remove($id) {
        $requested_user = Auth::user();
        try{
            $units = Unit::where('id','=',$id)->delete();
        }Catch(\Exception $e){
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to remove unit.',
                'description' => $e,
                'type' => 2,
            ]);
        }

        $units = Unit::all();
        return redirect()->action('Admin\UnitController@index', ['unit'=>$units ]);
    }

    public function edit($id) {
        $requested_user = Auth::user();
        if(Unit::where('id','=',$id)->exists()) {
            $updating_unit = Unit::where('id','=',$id)->get()->first();
            return View('admin.units.update', ['unit' => $updating_unit, 'units' => $updating_unit]);
        } else {
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to edit grade, grade not found.',
                'description' => 'Grade not found',
                'type' => 2,
            ]);
            return View('admin.units.main');
        }
    }

    public function update(Request $data) {
        $user = Auth::user();

        $message = [
            'required' => 'El campo :attribute es requerido.',
            'confirmed' => 'Las contraseñas no coinciden.',
            'min' => 'El campo :attribute debe de cumplir con el número de caracteres.'
        ];
        $this->validate($data, [
            'unit' => 'required',
        ], $message);

        try {
            if(!Unit::where('id','=',$data['id'])->exists()){
                $status = (object) array(
                    'created' => 'error',
                    'message' => 'Error unidad no existe.',
                );

            }else{

                DB::table('units')
                    ->where('id', $data['id'])
                    ->update(array('common_name' => $data['unit'], 'unit_number' => $data['unit'],));

                //$to_edit = Unit::where('id','=',$data['id'])->get()->first();

                //return $data['unit'];
                //$to_edit->common_name = $data['unit'];
                //$to_edit->save();

                $status = (object) array(
                    'created' => 'success',
                    'message' => 'Unidad actualizada satisfactoriamente.',
                );

                $unit = Unit::where('id','=',$data['id'])->get()->first();

                return view('admin.units.update', ['status' => $status, 'unit'=>$unit]);
            }
        } catch(\Exception $e) {
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to update unit',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error al editar unidad intente de nuevo.',
            );
        }

        return view('admin.units.main', ['status' => $status]);
    }

}
