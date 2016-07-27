<?php

namespace App\Http\Controllers\Admin;
use App\errors as Error;
use App\Grades as Grade;
use App\Events as Event;
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


class EventsController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function index() {
        $events = Event::all();
        return view('admin.events.main', ['events' => $events]);
    }

    /**
     * @return mixed
     */
    public function add() {
        return view('admin.events.add');
    }

    public function create(Request $data) {
        $user = Auth::user();
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'confirmed' => 'Las contraseñas no coinciden.',
            'min' => 'El campo :attribute debe de cumplir con el número de caracteres.'
        ];
        $this->validate($data, [
            'event' => 'required'
        ], $message);

        try{
            if(!Event::where('title','=',$data['event'])->exists()){

                Event::create([
                    'title' => $data['event'],
                    'media' => $data['event']
                ]);

                //DB::table('events')->insert( array(
                //        'title' => $data['event'],
                //        'media' => $data['event'])
                //);

                $status = (object) array(
                    'created' => 'success',
                    'message' => 'Evento creada satisfactoriamente..',
                );
            } else {
                $status = (object) array(
                    'created' => 'error',
                    'message' => 'Error creando Evento, Evento ya existe.',
                );
            }
        } catch (\Exception $e) {
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to create Event',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error creando Evento intente de nuevo.',
            );
        }

        return view('admin.events.add',['status'=>$status]);
    }

    public function remove($id) {
        $requested_user = Auth::user();
        try{
            $events = Event::where('id','=',$id)->delete();
        }Catch(\Exception $e){
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to remove event.',
                'description' => $e,
                'type' => 2,
            ]);
        }

        $events = Event::all();
        return redirect()->action('Admin\EventsController@index', ['event'=>$events ]);
    }

    public function edit($id) {
        $requested_user = Auth::user();
        if(Event::where('id','=',$id)->exists()) {
            $updating_unit = Event::where('id','=',$id)->get()->first();
            return View('admin.events.update', ['event' => $updating_unit, 'event' => $updating_unit]);
        } else {
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to edit event, event not found.',
                'description' => 'Event not found',
                'type' => 2,
            ]);
            return View('admin.events.main');
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
            'event' => 'required',
        ], $message);

        try {
            if(!Event::where('id','=',$data['id'])->exists()){
                $status = (object) array(
                    'created' => 'error',
                    'message' => 'Error Evento no existe.',
                );

            }else{

                DB::table('events')
                    ->where('id', $data['id'])
                    ->update(array('title' => $data['event'], 'media' => $data['event'],));

                //$to_edit = Unit::where('id','=',$data['id'])->get()->first();

                //return $data['unit'];
                //$to_edit->common_name = $data['unit'];
                //$to_edit->save();

                $status = (object) array(
                    'created' => 'success',
                    'message' => 'Evento actualizado satisfactoriamente.',
                );

                return view('admin.events.update', ['status' => $status, 'event'=>$data]);
            }
        } catch(\Exception $e) {
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to update event',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error al editar evento intente de nuevo.',
            );
        }

        return view('admin.events.main', ['status' => $status]);
    }
}
