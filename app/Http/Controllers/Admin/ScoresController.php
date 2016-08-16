<?php

namespace App\Http\Controllers\Admin;

use App\Courses;
use App\Grades;
use App\Homeworks;
use App\Score;
use App\User;
use App\Units;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ScoresController extends AdminBaseController implements FormTemplate
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        $scores = Score::all();
        return view('admin.scores.main', ['scores'=>$scores]);
    }


    public function add() {
        $courses = Courses::all();
        $units = Units::all();
        $homeworks = Homeworks::all();
        $grades = Grades::all();
        return view('admin.scores.add',['courses'=>$courses,'units'=>$units,'homeworks'=>$homeworks,'grades'=>$grades]);
    }

    public function getStudents(Request $data) {

    }

    public function create(Request $data) {
        $grade_uuid = $data['grade'];
        $grade = Grades::where('uuid',$grade_uuid)->get()->first();
        $students = $this->sanitizeStudents($grade->gruser);
        return json_encode($students);
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }

    public function update(Request $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($uuid)
    {
        // TODO: Implement delete() method.
    }

    private function sanitizeStudents($students) {
        $sanitizedStudents = array();

        foreach ($students as $student) {
            if($student->hasRole('Estudiante')) {
                array_push($sanitizedStudents,array (
                    'uuid' => $student->uuid,
                    'name' => $student->full_name(),
                ));
            }
        }

        return $sanitizedStudents;
    }

}
