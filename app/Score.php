<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'score';
    protected $fillable = ['id','user_id','published_by','course_id','unit_id','homework_id','title','score'];
}
