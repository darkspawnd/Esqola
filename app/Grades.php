<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Grades extends Model
{
    protected $table = 'grades';
    protected $fillable = ['name','uuid'];

    public function gruser(){
        return $this->belongsToMany('App\User', 'rltn_user_grade','grade_id', 'user_id');
    }

    public function usersSorted(){
        return $this->belongsToMany('App\User', 'rltn_user_grade','grade_id', 'user_id')->orderBy('lastname','ASC');
    }

    public function courses(){
        return $this->belongsToMany('App\Courses', 'rltn_grade_course','grade_id', 'course_id');
    }

}
