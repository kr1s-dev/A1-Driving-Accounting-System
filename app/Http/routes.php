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

Route::get('/', function () {
    //return view('welcome');
    return Redirect::to('/login');
});
Route::auth();

// Uses authentication middleware, to avoid uneccessary access if not login
Route::group(['middleware' => 'auth'], function () {
	//Branch Routes
	Route::resource('branches','Branches\BranchController');

	//User Routes
	Route::resource('user','Users\UserController');

	//Students Routes
	Route::resource('students','Students\StudentController');
});
