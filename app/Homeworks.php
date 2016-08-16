<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Homeworks extends Model
{
    protected $table = 'homeworks';
    protected $fillable = ['id','user_id','grade_id','course_id','unit_id','title','description','file','due_date'];

    public function comments() {
        return $this->hasMany('App\Comments');
    }
    public function Unit() {
        return $this->belongsTo('App\Units');
    }

    public function formatted() {
        $homeworksFormatted = DB::select('SELECT  homeworks.id, homeworks.title, homeworks.description, homeworks.file, users.name as user, grades.name as grade, units.common_name as unit, courses.name as course FROM app_esqola.homeworks
                            INNER JOIN app_esqola.users
                            ON homeworks.user_id = users.id
                            INNER JOIN app_esqola.grades
                            ON homeworks.grade_id = grades.id
                            INNER JOIN app_esqola.units
                            ON homeworks.unit_id = units.id
                            INNER JOIN app_esqola.courses
                            ON homeworks.course_id = courses.id WHERE homeworks.id = :id', ['id'=>$this->id]);
        return $homeworksFormatted;
    }
}
