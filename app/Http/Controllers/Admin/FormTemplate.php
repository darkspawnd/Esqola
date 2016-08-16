<?php
/**
 * Created by PhpStorm.
 * User: rdieg
 * Date: 15/8/2016
 * Time: 02:58
 */

namespace app\Http\Controllers\Admin;


use Illuminate\Http\Request;

interface FormTemplate
{

    public function index();
    public function add();
    public function create(Request $data);
    public function edit();
    public function update(Request $data);
    public function delete($uuid);

}