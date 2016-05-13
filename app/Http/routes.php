<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    // Authentication routes...
    Route::get('auth/login', [
        'uses' => 'Auth\AuthController@getLogin',
        'as' => 'login'
    ]);
    Route::get('/', function(){
        return Redirect::route('login');
    });
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');
    
    // Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');
   
    Route::get('profile', ['uses' => 'ProfileController@main'
    ]);
    
    Route::post('profile', ['uses' => 'ProfileController@createPost'
    ]);
    
    Route::get('test', ['uses' => 'ProfileController@post'
    ]);
    
    Route::get('home', 'ProfileController@home');
    
    
    Route::get('createProfile', 'ProfileController@createProfileGet');
    Route::post('createProfile', 'ProfileController@createProfilePost');
    Route::get('/{image}', [
        'uses' => 'ProfileController@image',
        'as' => 'image'
    ]);
    
    Route::get('/profile/{username}', [
        'uses' => 'ProfileController@publicProfile',
        'as' => 'username'
    ]);
    
    Route::get('/updateRequest/{id}', [
        'uses' => 'ProfileController@updateRequest',
        'as' => 'updateRequest'
    ]);
    Route::get('/setRequest/{id}', [
        'uses' => 'ProfileController@setRequest',
        'as' => 'setRequest'
    ]);
    
    Route::get('/profile/friends/requests', [
        'uses' => 'ProfileController@requests',
        'as' => 'requests'
    ]);
    
    Route::get('/profile/friends/search', 'ProfileController@searchView');
    Route::post('/profile/friends/search', 'ProfileController@search');
    
    
});
