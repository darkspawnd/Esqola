<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Validation;

class adminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show dashboard home
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard() {

        $user = Auth::user();

        return view('admin.home', ['user' => $user]);
    }

}
