<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saved_badges extends Model
{
    protected $table = 'saved_badges';
    protected $fillable = ['user_id','badge_id'];

    public function badges() {
        return $this->hasMany('App\Badges');
    }

    public function User() {
        return $this->belongsTo('App\User');
    }
}
