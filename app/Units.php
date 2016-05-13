<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $table = 'units';
    protected $fillable = ['unit_number','common_name'];

    public function contents() {
        return $this->hasMany('App\Contents');
    }
}
