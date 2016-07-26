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
Route::get('/', 'BubbleController@index');
Route::resource('users', 'UserController');
Route::resource('projects', 'ProjectController');

// Private:
Route::resource('bubbles', 'BubbleController');
Route::resource('quests', 'QuestController');
Route::resource('resources', 'ResourceController');

Route::group(['prefix' => 'my', 'middleware' => 'auth'], function () {
    Route::get('quests', ['as' => 'my-quests', 'uses' => 'QuestController@overview']);
    Route::get('bubbles', ['as' => 'my-bubbles', 'uses' => 'BubbleController@overview']);
    Route::get('projects', ['as' => 'my-projects', 'uses' => 'ProjectController@overview']);
    Route::get('resources', ['as' => 'my-resources', 'uses' => 'ResourceController@overview']);
    Route::get('profile', ['as' => 'my-profile', 'uses' => 'UserController@profile']);
});
