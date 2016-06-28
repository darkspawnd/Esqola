<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user->hasRole('admin'))
            return redirect()->action('Admin\DashboardController@index');
        if($user->hasRole('teacher'))
            return redirect()->action('teacherController@dashboard');
        if($user->hasRole('student'))
            return redirect()->action('student@dashboard');
    }
    public function logout(){
        Auth::logout();
        return redirect()->action('HomeController@index');
    }
}
