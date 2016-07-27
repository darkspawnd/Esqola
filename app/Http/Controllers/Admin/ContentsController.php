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
            'title' => 'required',
            'grade' => 'required',
            'unit' => 'required',
            'course' => 'required',
        ], $message);

        try {
            $name = '';
            if($data->hasFile('attachment'))
                $name = FileHelper::upload($data->file('attachment'));

            $course = Courses::where('uuid','=',$data['course'])->get()->first();
            $grade = Grades::where('uuid','=',$data['grade'])->get()->first();
            $unit = Units::where('id','=',$data['unit'])->get()->first();

            $newcontent = Contents::create([
                'course_id' => $course->id,
                'user_id' => $user->id,
                'grade_id' => $grade->id,
                'unit_id' => $unit->id,
                'title' => $data['title'],
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

}
