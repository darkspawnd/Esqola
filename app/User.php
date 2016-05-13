<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname','telephone','age', 'email', 'password', 'address','firstaccess'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function attribute() {
        return $this->hasOne('App\User_attribute');
    }

    public function settings() {
        return $this->hasOne('App\User_settings');
    }

    public function badge() {
        //return $this->hasMany('App\Saved_badges');
        return $this->belongsToMany('App\Badges','saved_badges');
    }

}
