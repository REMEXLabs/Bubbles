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


Route::auth();
Route::get('/home', 'HomeController@index');

// Users
Route::resource('users', 'UserController',
  ['only' => ['index', 'show', 'edit', 'update']]);
// Route::resource('users', 'UserController',
//   ['except' => ['create', 'store', 'update', 'destroy']]);

Route::get('/', function () {
    return view('welcome');
});
