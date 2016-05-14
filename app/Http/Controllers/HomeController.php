<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User as User;

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
        $badge = \App\User::find(1)->badge;
        $user = User::find(1);
        echo $user->name .' has badges: ';
        foreach($badge as $item) {
            echo '<br> Title: '.$item->title;
        }
        return view('home');
    }
}
