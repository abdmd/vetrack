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

//home routes

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

//drivers route

Route::get('drivers', 'DriversController@index');

Route::post('drivers', 'DriversController@store');

Route::get('drivers/edit/{id}', 'DriversController@edit');

Route::post('drivers/edit/{id}', 'DriversController@update');

Route::get('drivers/destroy/{id}', 'DriversController@destroy');

//vehicles route

Route::get('vehicles', 'VehiclesController@index');

Route::post('vehicles', 'VehiclesController@store');

Route::get('vehidelete/{id}', 'VehiclesController@delete');

Route::get('vehiedit/{id}', 'VehiclesController@edit');

Route::post('vehiedit/{id}', 'VehiclesController@update');


/*

Route::get('vehicles', 'VehiclesController@index');
Route::post('vehicles', 'VehiclesController@store');

Route::get('vehicles/edit/{id}', 'VehiclesController@edit');

Route::post('vehicles/edit/{id}', 'VehiclesController@update');

Route::get('vehicles/destroy/{id}', 'VehiclesController@destroy');
*/

//job route
Route::get('/jobs', 'JobsController@index');

Route::post('/jobs', 'JobsController@store');

Route::get('delete/{id}', 'JobsController@delete');

Route::get('jobedit/{id}', 'JobsController@edit');

Route::post('jobedit/{id}', 'JobsController@update');

Route::post('assignjob/{id}', 'AssignJobController@store');

Route::get('assignjob/{id}', 'AssignJobController@index');

//auth route / profile route

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('changepassword', 'CPassController@index');
Route::post('changepassword', 'CPassController@update');

Route::get('faq', 'FaqController@index');

Route::get('editprofile', 'ProfileController@index');
Route::post('editprofile', 'ProfileController@update');

Route::get('register', 'RegisterController@index');
Route::post('register', 'RegisterController@store');