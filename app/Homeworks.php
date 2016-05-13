<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homeworks extends Model
{
    protected $table = 'homeworks';
    protected $fillable = ['user_id','grade_id','course_id','unit_id','title','description','file','due_date'];

    public function comments() {
        return $this->hasMany('App\Comments');
    }
}
