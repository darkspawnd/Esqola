<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Contents extends Model
{
    protected $table = 'contents';
    protected $fillable = ['uuid','course_id','user_id','grade_id','unit_id','title','description','file_path'];

    public function Unit() {
        return $this->belongsTo('App\Units');
    }

    public function formatted() {
        $contentFormatted = DB::select('SELECT contents.uuid, contents.id, contents.title, contents.description, contents.file_path, users.name as user, grades.name as grade, units.common_name as unit, courses.name as course FROM app_esqola.contents
                            INNER JOIN app_esqola.users
                            ON contents.user_id = users.id
                            INNER JOIN app_esqola.grades
                            ON contents.grade_id = grades.id
                            INNER JOIN app_esqola.units
                            ON contents.unit_id = units.id
                            INNER JOIN app_esqola.courses
                            ON contents.course_id = courses.id WHERE contents.id = :id', ['id'=>$this->id]);
        return $contentFormatted;
    }
}
