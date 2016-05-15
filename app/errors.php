<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class errors extends Model
{
    protected $table = 'errors';
    protected $fillable = [
        'user_id', 'error', 'description', 'type'
    ];
}
