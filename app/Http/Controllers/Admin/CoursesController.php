<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Courses as Course;
use App\errors as Error;
use Auth;
use Validation;
use Webpatser\Uuid\Uuid as UUID;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CoursesController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * @return mixed
     */
    public function index() {
        $courses = Course::all();
        return view('admin.courses.main', ['courses' => $courses]);
    }

    /**
     * @return mixed
     */
    public function add() {
        return view('admin.courses.add');
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
            'Materia' => 'required'
        ], $message);

        try{
            if(!Course::where('name','=',$data['Materia'])->exists()){
                Course::create([
                    'name' => $data['Materia'],
                    'uuid' => UUID::generate(4)
                ]);
                $status = (object) array(
                    'created' => 'success',
                    'message' => 'Materia creada satisfactoriamente..',
                );
            } else {
                $status = (object) array(
                    'created' => 'error',
                    'message' => 'Error creando materia, materia ya existe.',
                );
            }
        } catch (\Exception $e) {
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to create course',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error creando materia intente de nuevo.',
            );
        }

        return view('admin.courses.add',['status'=>$status]);
    }


    function remove($uuid) {
        $requested_user = Auth::user();
        try{
            $course = Course::where('uuid','=',$uuid)->delete();
        }Catch(\Exception $e){
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to remove course',
                'description' => $e,
                'type' => 2,
            ]);
        }

        $courses = Course::all();
        return redirect()->action('Admin\CoursesController@index', ['courses'=>$courses]);
    }

    public function edit($uuid) {
        $requested_user = Auth::user();
        if(Course::where('uuid','=',$uuid)->exists()) {
            $updating_course = Course::where('uuid','=',$uuid)->get()->first();
            return View('admin.courses.update', ['course' => $updating_course]);
        } else {
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to edit course, course not found.',
                'description' => 'Course not found',
                'type' => 2,
            ]);
            return View('admin.course.main');
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
            'Materia' => 'required',
        ], $message);

        try {
            if(!Course::where('uuid','=',$data['auth'])->exists()){
                $status = (object) array(
                    'created' => 'error',
                    'message' => 'Error materia no existe.',
                );
            }else{
                $to_edit = Course::where('uuid','=',$data['auth'])->get()->first();
                $to_edit->name = $data['Materia'];

                $to_edit->save();

                $status = (object) array(
                    'created' => 'success',
                    'message' => 'Materia actualizada satisfactoriamente.',
                );

                return view('admin.courses.update', ['status' => $status, 'course'=>$to_edit]);
            }
        } catch(\Exception $e) {
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to update grade',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error al editar materia, intente de nuevo.',
            );
        }

        return view('admin.grades.main', ['status' => $status]);
    }

}
