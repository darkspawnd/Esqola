<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use DB;
use App\Grades;

class User extends Authenticatable
{
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bk','name', 'lastname','telephone','age', 'email', 'password', 'address','firstaccess', 'uuid', 'id'
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
    public function usgra(){
        return $this->belongsToMany('App\Grades', 'rltn_user_grade','user_id', 'grade_id');
    }
    public function settings() {
        return $this->hasOne('App\User_settings');
    }

    public function badge() {
        //return $this->hasMany('App\Saved_badges');
        return $this->belongsToMany('App\Badges','saved_badges');
    }

    public function grade() {
        return $this->belongsToMany('App\Grades','grades');
    }

    public function full_name() {
        return $this->name . ' ' . $this->lastname;
    }

    public function full_listed_name() {
        return $this->lastname . ' ' . $this->name;
    }

    public function error() {
        return $this->hasOne('App\errors');
    }

    public function courses() {
        $courses = DB::select(' SELECT courses.name, rltn_grade_course.course_id, COUNT(*) AS cantidad FROM app_esqola.courses	
                                INNER JOIN app_esqola.rltn_grade_course
                                ON courses.id = rltn_grade_course.course_id
                                WHERE grade_id IN (
                                SELECT grades.id FROM app_esqola.users
                                INNER JOIN app_esqola.rltn_user_grade
                                ON app_esqola.users.id = app_esqola.rltn_user_grade.user_id
                                INNER JOIN app_esqola.grades 
                                ON app_esqola.rltn_user_grade.grade_id = app_esqola.grades.id
                                WHERE users.id = :id)
                                GROUP BY rltn_grade_course.course_id', ['id'=>$this->id]);
        return $courses;
    }

}
