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

Route::get('github/authorize', ['as' => 'github.authorize', 'uses' => 'SocialController@github_authorize']);
Route::get('github/login', ['as' => 'github.login', 'uses' => 'SocialController@github_login']);

// -> Controllers:
Route::get('/', ['as' => 'welcome', 'uses' => 'BubbleController@index']);

// -> Static Sites:
Route::get('imprint', ['as' => 'imprint', function () {
    return view('home.imprint');
}]);
Route::get('terms', ['as' => 'terms', function () {
    return view('home.terms');
}]);

// -> Public Resources:
Route::resource('quests', 'QuestController');
Route::get('quests/accept/{id}', ['as' => 'quests.accept', 'uses' => 'QuestController@accept']);
Route::get('quests/finish/{id}', ['as' => 'quests.finish', 'uses' => 'QuestController@finish']);
Route::get('quests/close/{id}', ['as' => 'quests.close', 'uses' => 'QuestController@close']);
Route::get('quests/reopen/{id}', ['as' => 'quests.reopen', 'uses' => 'QuestController@reopen']);
Route::get('quests/scan/repo', ['as' => 'repo.scan', 'uses' => 'QuestController@scan']);
Route::get('quests/parse/repo', ['as' => 'repo.parse', 'uses' => 'QuestController@parse']);
Route::post('quests/parse/repo', ['as' => 'repo.parse', 'uses' => 'QuestController@parse']);
Route::post('quests/store/repo', ['as' => 'repo.store', 'uses' => 'QuestController@store_repos']);
Route::get('quests/{id}/add/resource', ['middleware' => 'auth', 'as' => 'quests.add_resource', 'uses' => 'QuestController@add_resource']);
Route::get('quests/{quest_id}/add/resource/{resource_id}', ['middleware' => 'auth', 'as' => 'quests.store_resource', 'uses' => 'QuestController@store_resource']);
Route::get('quests/{quest_id}/delete/resource/{resource_id}', ['middleware' => 'auth', 'as' => 'quests.delete_resource', 'uses' => 'QuestController@delete_resource']);
Route::get('quests/{quest_id}/add/tag/{tag_id}', ['middleware' => 'auth', 'as' => 'quests.store_tag', 'uses' => 'QuestController@store_tag']);
Route::get('quests/{quest_id}/delete/tag/{tag_id}', ['middleware' => 'auth', 'as' => 'quests.delete_tag', 'uses' => 'QuestController@delete_tag']);

Route::resource('projects', 'ProjectController');
Route::get('projects/{id}/add/resource', ['middleware' => 'auth', 'as' => 'projects.add_resource', 'uses' => 'ProjectController@add_resource']);
Route::get('projects/{project_id}/add/resource/{resource_id}', ['middleware' => 'auth', 'as' => 'projects.store_resource', 'uses' => 'ProjectController@store_resource']);
Route::get('projects/{project_id}/delete/resource/{resource_id}', ['middleware' => 'auth', 'as' => 'projects.delete_resource', 'uses' => 'ProjectController@delete_resource']);
Route::get('projects/{project_id}/add/tag/{tag_id}', ['middleware' => 'auth', 'as' => 'projects.store_tag', 'uses' => 'ProjectController@store_tag']);
Route::get('projects/{project_id}/delete/tag/{tag_id}', ['middleware' => 'auth', 'as' => 'projects.delete_tag', 'uses' => 'ProjectController@delete_tag']);

Route::resource('users', 'UserController');

Route::get('search', ['as' => 'search', 'uses' => 'SearchController@index']);
Route::post('search', ['as' => 'search', 'uses' => 'SearchController@search']);

// Private Resources:
Route::resource('bubbles', 'BubbleController');
Route::resource('resources', 'ResourceController');
Route::resource('tags', 'TagController');

// Private Settings:
Route::group(['prefix' => 'my', 'middleware' => 'auth'], function () {
    Route::get('quests', ['as' => 'my-quests', 'uses' => 'QuestController@overview']);
    Route::get('bubbles', ['as' => 'my-bubbles', 'uses' => 'BubbleController@overview']);
    Route::get('projects', ['as' => 'my-projects', 'uses' => 'ProjectController@overview']);
    Route::get('resources', ['as' => 'my-resources', 'uses' => 'ResourceController@overview']);
    Route::get('tags', ['as' => 'my-tags', 'uses' => 'TagController@overview']);
    Route::get('profile', ['as' => 'my-profile', 'uses' => 'UserController@profile']);
});

// Sharing:
Route::group(['prefix' => 'embed'], function () {
    Route::get('profile/{id}', ['as' => 'embed-profile', 'uses' => 'SharingController@profile']);
    Route::get('bubble/{id}', ['as' => 'embed-bubble', 'uses' => 'SharingController@bubble']);
});

// Public API
Route::group(['prefix' => 'api'], function () {
    Route::get('quests', ['as' => 'api.quests', function () {
        $data = Quest::orderBy('created_at', 'DESC')->get(Quest::$public)->filter(function ($item) {
            return $item->author()->quests_public == 1;
        })->values();
        return response()->json($data);
    }]);
    Route::get('projects', ['as' => 'api.projects', function () {
        $data = Project::orderBy('created_at', 'DESC')->get(Project::$public);
        return response()->json($data);
    }]);
    Route::get('users', ['as' => 'api.users', function () {
        $data = User::orderBy('points', 'DESC')->get(User::$public)->filter(function ($user) {
            return $user->points > 1;
        })->values();
        return response()->json($data);
    }]);
});
