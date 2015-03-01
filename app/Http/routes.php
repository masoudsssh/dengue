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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('map', function(){
								return View::make('map'); 
							});

Route::get('case-filter-by/{groupType}', 'CaseController@filterBy' );
Route::resource('case', 'CaseController', ['except' => ['edit', 'create']]);

Route::resource('hotspot', 'HotspotController', ['except' => ['edit', 'create']]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
