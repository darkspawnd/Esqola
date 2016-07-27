<?php

namespace App\Http\Controllers\Admin;
use App\errors as Error;
use App\Grades as Grade;
use App\Homeworks as Homework;
use App\Http\Requests;
use App\User as User;
use App\User_attribute as Attributes;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Permission as Permission;
use Spatie\Permission\Models\Role as Roles;
use Validation;
use Webpatser\Uuid\Uuid as UUID;

class HomeworksController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }
    public function index() {
        $homeworks = Homework::all();
        return view('admin.homeworks.main', ['homeworks' => $homeworks]);
    }

    /**
     * @return mixed
     */
    public function add() {
        $teachers = DB::table('user_has_roles')->where('role_id', 3)->get();
        $teachName = [];
        foreach ($teachers as $teacher){
            //print $teacher -> user_id;
            $teachName[] = User::where('id','=',$teacher->user_id)->get();
        }


        return view('admin.homeworks.add', ['teachers' => $teachName]);
    }

    public function getAdd(Request $request){
        $check = User::find($request->input('id'));
        $relaciones = DB::table('rltn_user_grade')->where('user_id',$check->id)->get(['grade_id']);
        if($request->ajax()){
            return response()->json([
                'relaciones' => $relaciones
            ]);
        }
    }

}
