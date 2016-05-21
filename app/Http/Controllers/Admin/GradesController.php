<?php

namespace App\Http\Controllers\Admin;

use App\errors as Error;
use App\Grades as Grade;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use Validation;

class GradesController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */

    public function index() {
        $grades = Grade::all();

        return view('admin.grades.main', ['grades'=>$grades]);
    }

    public function addGrade() {
        return view('admin.grades.add');
    }

    public function create(Request $data) {
        $user = Auth::user();
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'confirmed' => 'Las contraseñas no coinciden.',
            'min' => 'El campo :attribute debe de cumplir con el número de caracteres.'
        ];
        $this->validate($data, [
            'Grado' => 'required'
        ], $message);

        try{
            if(!Grade::where('name','=',$data['Grado'])->exists()){
                Grade::create([
                    'name' => $data['Grado']
                ]);
                $status = (object) array(
                    'created' => 'success',
                    'message' => 'Grado creado satisfactoriamente..',
                );
            } else {
                $status = (object) array(
                    'created' => 'error',
                    'message' => 'Error creando grado, grado ya existe.',
                );
            }
        } catch (\Exception $e) {
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to create grade',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error creando grado intente de nuevo.',
            );
        }

        return view('admin.grades.add',['status'=>$status]);

    }


    public function remove() {

    }

}
