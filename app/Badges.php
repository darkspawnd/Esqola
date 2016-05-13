<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Badges extends Model
{
    protected $table = 'badge';
    protected $fillable = ['title','description','goal'];

    public function User() {
        return $this->hasManyThrough('App\Users','App\Saved_badges','badge_id', 'user_id');
    }
}
