<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_settings extends Model
{
    protected $table = "user_attributes";
    protected $fillable = ['user_id', 'configuration'];

    public function User() {
        return $this->belongsTo('App\User');
    }
}
