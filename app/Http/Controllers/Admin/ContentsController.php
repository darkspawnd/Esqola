<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\errors as Error;
use Auth;
use Validation;
use Webpatser\Uuid\Uuid as UUID;
use App\Contents as Contents;
use App\Helpers\FileHelper\FileHelper as FileHelper;

class ContentsController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index()
    {
        $contents = Contents::all();
        return view('admin.contents.main', ['contents'=>$contents]);
    }

    public function add() {
        return view('admin.contents.add');
    }

    public function create(Request $data)
    {
        var_dump($data->all());
    }

}
