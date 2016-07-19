<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class grade_course extends Model
{
    protected $table = 'rltn_grade_course';
    protected $fillable = ['grade_id', 'course_id'];
    
}
