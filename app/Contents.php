<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    protected $table = 'contents';
    protected $fillable = ['user_id','grade_id','unit_id','title','description','file_path'];

    public function Unit() {
        return $this->belongsTo('App\Units');
    }
}
