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




// Public:
// -> Authentication:
Route::auth();
Route::get('register', 'UserController@create');
// -> Controllers:
Route::resource('users', 'UserController');
Route::resource('projects', 'ProjectController');

// Private:
Route::resource('quests', 'QuestController');
Route::group(['prefix' => 'my', 'middleware' => 'auth'], function () {
  Route::get('quests', ['as' => 'my-quests', 'uses' => 'UserController@overview']);
  Route::get('bubbles', ['as' => 'my-bubbles', 'uses' => 'UserController@overview']);
  Route::get('projects', ['as' => 'my-projects', 'uses' => 'UserController@overview']);
  Route::get('resources', ['as' => 'my-resources', 'uses' => 'UserController@overview']);
  Route::get('profile', ['as' => 'my-profile', 'uses' => 'UserController@profile']);
});

// Route::get('projects', 'ProjectController@index');
// Route::get('projects/create', 'ProjectController@create');
// Route::post('projects', 'ProjectController@store');
// Route::get('projects/{id}', 'ProjectController@show');
// Route::get('projects/{id}/edit', 'ProjectController@edit');
// Route::put('projects/{id}', 'ProjectController@update');
// Route::delete('projects/{id}', 'ProjectController@destroy');

// GET     /users                      index   users.index
// GET     /users/create               create  users.create
// POST    /users                      store   users.store
// GET     /users/{user}               show    users.show
// GET     /users/{user}/edit          edit    users.edit
// PUT     /users/{user}               update  users.update
// DELETE  /users/{user}               destroy users.destroy


// Route::resource('projects', 'ProjectController', ['only' => [
//   'index', 'show'
// ]]);

// Route::group(['before' => 'auth'], function() {
//
//   Route::resource('projects', 'ProjectController', ['only' => [
//     'create', 'store', 'update', 'destroy'
//   ]]);
//
// });

// Route::resource('projects', 'ProjectController', ['only' => [
//     'index', 'show'
// ]]);
// Route::resource('projects', 'ProjectController', ['middleware' => [
//     'auth'
// ], 'only' => [
//     'create', 'store', 'update', 'destroy'
// ]]);

Route::get('/', 'ProjectController@index');
// Route::get('home', 'HomeController@index');
