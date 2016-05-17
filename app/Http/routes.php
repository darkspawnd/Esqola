<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * PUBLIC APP
 */

Route::auth();
Route::get('/', 'HomeController@index');


//ADMINISTRATION
Route::get('/admin', 'adminController@dashboard');

//REMOVE USER
Route::get('/admin/users','Admin\UsersController@mainUsers');
Route::get('/admin/users/add','Admin\UsersController@addUser');

// SAVING USERS
Route::post('/admin/users/add', 'Admin\UsersController@createUser');

//DELETING USERS
Route::get('/admin/users/remove/{email}', ['uses'=>'Admin\UsersController@removeUser']);


Route::get('/test','Admin\NotasController@index');