<?php

namespace App\Http\Controllers\Admin;
use App\errors as Error;
use App\Grades as Grades;
use App\Homeworks as Homework;
use App\Homeworks;
use App\Http\Requests;
use App\Courses as Courses;
use App\User as User;
use App\Units as Units;
use App\Helpers\FileHelper\FileHelper as FileHelper;
use App\Contents as Contents;
use Auth;
use Illuminate\Http\Request;
use Validation;
use Webpatser\Uuid\Uuid as UUID;

class HomeworksController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function index() {
        $homeworks = Homework::all();
        $courses = Courses::all();
        return view('admin.homeworks.main', ['homeworks' => $homeworks, 'courses' => $courses]);
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

            $newhomework = Homework::create([
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
        return view('admin.homeworks.add',['grades'=>$grades, 'units'=>$units, 'courses'=>$courses]);

    }

    /**
     * @return mixed
     */
    public function add() {
        $user = Auth::user();
        $grades = Grades::all();
        $units = Units::all();
        $courses = Courses::all();
        return view('admin.homeworks.add',['grades'=>$grades, 'units'=>$units, 'courses'=>$courses]);
    }

    public function remove($id) {
        $requested_user = Auth::user();
        try{
            $homework = Homework::where('id','=',$id)->get()->first();
            // averiguar lo del helper para tareas file_path
            $homework = Homework::where('id','=',$id)->get()->first()->delete();
            if(FileHelper::remove($homework->file)) {
               where::where('id','=',$id)->delete();
            }


        }Catch(\Exception $e){
            Error::create([
                'user_id' => $requested_user->id,
                'error' => 'Failed to remove content',
                'description' => $e,
                'type' => 2,
            ]);
        }

        $homeworks = Homeworks::all();
        $homeworksFormatted = array();
        foreach ($homeworks as $home) {
            array_push($homeworksFormatted, $home->formatted()[0]);
        }
        return view('admin.homeworks.main', ['homeworks'=>$homeworksFormatted]);
    }

    public function getAdd(Request $request){
        $check = User::find($request->input('teacher'));
        $relaciones = DB::table('rltn_user_grade')->where('user_id',$check->id)->get(['grade_id']);
        if($request->ajax()){
            return response()->json([
                'relaciones' => $relaciones
            ]);
            return $relaciones;
        }
    }

}
