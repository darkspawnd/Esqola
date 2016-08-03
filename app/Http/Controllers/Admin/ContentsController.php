<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\errors as Error;
use Auth;
use Validation;
use Webpatser\Uuid\Uuid as UUID;
use App\Contents as Contents;
use App\Helpers\FileHelper\FileHelper as FileHelper;
use App\Grades as Grades;
use App\User as User;
use App\Units as Units;
use App\Courses as Courses;

class ContentsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        $contents = Contents::all();
        $contentsFormatted = array();

        foreach ($contents as $content) {
            array_push($contentsFormatted, $content->formatted()[0]);
        }
        return view('admin.contents.main', ['contents'=>$contentsFormatted]);
    }

    public function add() {
        $user = Auth::user();
        $grades = Grades::all();
        $units = Units::all();
        $courses = Courses::all();
        return view('admin.contents.add',['grades'=>$grades, 'units'=>$units, 'courses'=>$courses]);
    }

    public function create(Request $data)
    {
        $user = Auth::user();
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'min' => 'El campo :attribute debe de cumplir con el número de caracteres.'
        ];
        $this->validate($data, [
            'titulo' => 'required',
            'grado' => 'required',
            'unidad' => 'required',
            'materia' => 'required',
        ], $message);

        try {
            $name = '';
            if($data->hasFile('attachment'))
                $name = FileHelper::upload($data->file('attachment'));

            $course = Courses::where('uuid','=',$data['materia'])->get()->first();
            $grade = Grades::where('uuid','=',$data['grado'])->get()->first();
            $unit = Units::where('id','=',$data['unidad'])->get()->first();

            $newcontent = Contents::create([
                'uuid' => UUID::generate(4),
                'course_id' => $course->id,
                'user_id' => $user->id,
                'grade_id' => $grade->id,
                'unit_id' => $unit->id,
                'title' => $data['titulo'],
                'description' => $data['description'],
                'file_path' => $name
            ]);

            $status = (object) array(
                'created' => 'success',
                'message' => 'Se ha creado exitosamente!',
            );

        } catch(\Exception $e) {
            Error::create([
                'user_id' => $user->id,
                'error' => 'Failed to create content',
                'description' => $e,
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error creando contenido intente de nuevo.',
            );
        }

        $grades = Grades::all();
        $units = Units::all();
        $courses = Courses::all();
        return view('admin.contents.add',['grades'=>$grades, 'units'=>$units, 'courses'=>$courses]);

    }

    public function remove($uuid) {
        $requested_user = Auth::user();
        try{
            $content = Contents::where('uuid','=',$uuid)->get()->first();
            if(FileHelper::remove($content->file_path)) {
                Contents::where('uuid','=',$uuid)->delete();
            }
        }Catch(\Exception $e){
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to remove content',
                'description' => $e,
                'type' => 2,
            ]);
        }

        $contents = Contents::all();
        $contentsFormatted = array();

        foreach ($contents as $cont) {
            array_push($contentsFormatted, $cont->formatted()[0]);
        }
        return view('admin.contents.main', ['contents'=>$contentsFormatted]);
    }

    public function edit($uuid) {
        $requested_user = Auth::user();
        if(Contents::where('uuid','=',$uuid)->exists()) {
            $updating_content = Contents::where('uuid','=',$uuid)->get()->first();
            $units = Units::all();
            $grades = Grades::all();
            $courses = Courses::all();
            return View('admin.contents.update', ['update_content'=>$updating_content, 'units'=>$units, 'grades'=>$grades, 'courses'=>$courses]);
        } else {
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to edit user, user not found.',
                'description' => 'User not found',
                'type' => 2,
            ]);
            return redirect()->action('Admin\ContentsController@index');
        }
    }

    public function update(Request $data) {
        $requested_user = Auth::user();
        $message = [
            'required' => 'El campo :attribute es requerido.',
            'min' => 'El campo :attribute debe de cumplir con el número de caracteres.'
        ];
        $this->validate($data, [
            'titulo' => 'required',
            'grado' => 'required',
            'unidad' => 'required',
            'materia' => 'required',
        ], $message);
        if(Contents::where('uuid','=',$data['auth'])->exists()) {
            try {
                $name = '';
                $current_content = Contents::where('uuid','=',$data['auth'])->get()->first();
                if($data->hasFile('attachment'))
                    $name = FileHelper::update($data->file('attachment'),$current_content->file_path);

                $course = Courses::where('uuid','=',$data['materia'])->get()->first();
                $grade = Grades::where('uuid','=',$data['grado'])->get()->first();
                $unit = Units::where('id','=',$data['unidad'])->get()->first();

                $current_content->title = $data['titulo'];
                $current_content->description = $data['description'];
                $current_content->course_id = $course->id;
                $current_content->grade_id = $grade->id;
                $current_content->unit_id = $unit->id;
                $current_content->user_id = $requested_user->id;
                $current_content->file_path = $name;
                $current_content->save();

                $status = (object) array(
                    'created' => 'success',
                    'message' => 'Se ha actualizado exitosamente!',
                );

            } catch(\Exception $e) {
                Error::create([
                    'user_id' => $requested_user->id,
                    'error' => 'Failed to update content',
                    'description' => $e,
                    'type' => 2,
                ]);
                $status = (object) array(
                    'created' => 'error',
                    'message' => 'Error actualizando contenido intente de nuevo.',
                );
            }
            $grades = Grades::all();
            $units = Units::all();
            $courses = Courses::all();
            return view('admin.contents.update',['update_content'=>$current_content,'grades'=>$grades, 'units'=>$units, 'courses'=>$courses, 'status'=>$status]);
        } else {
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to edit content, content not found.',
                'description' => 'Content not found',
                'type' => 2,
            ]);
            $status = (object) array(
                'created' => 'error',
                'message' => 'Error actualizando contenido intente de nuevo.',
            );
        }
        return redirect()->action('Admin\ContentsController@index');
    }
}
