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

Route::get('/', function(){
					return Redirect::to('/index'); 
				});
Route::get('/index', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::post('upload', array('as'=>'FileUpload', 'uses'=>'HelperController@uploadFile' ));

Route::get('map', function(){
								return View::make('map'); 
							});

Route::get('case-filter-by/{groupType}', 'CaseController@filterBy' );
Route::resource('case', 'CaseController', ['except' => ['edit', 'create']]);

Route::resource('hotspot', 'HotspotController', ['except' => ['edit', 'create']]);


Route::post('login', array('as'=>'login', 'uses'=>'UserController@login' ));
Route::post('signup', array('as'=>'signup', 'uses'=>'UserController@signup' ));
Route::get('logout', array('as'=>'logout', 'uses'=>'UserController@logout' ));
Route::put('update-user', array('as'=>'updateUser', 'uses'=>'UserController@updateUser' ));

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
