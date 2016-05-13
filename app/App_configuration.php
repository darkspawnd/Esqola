<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_configuration extends Model
{
    protected $table = 'app_configuration';
    protected $fillable = ['property','value'];
}
