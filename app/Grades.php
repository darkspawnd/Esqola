<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    protected $table = 'grades';
    protected $fillable = ['name','uuid'];

    public function User() {
        return $this->hasManyThrough('App\Users','App\user_grade','grade_id', 'user_id');
    }

    public function courses(){
        return $this->belongsToMany('App\Courses', 'rltn_grade_course','grade_id', 'course_id');
    }

}
