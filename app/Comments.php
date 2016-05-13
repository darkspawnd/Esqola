<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id','homework_id','comment'];

    public function comments() {
        return $this->belongsTo('App\Homeworks');
    }
}
