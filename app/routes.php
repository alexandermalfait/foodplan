<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');

Route::get('/users/login', 'UsersController@login');
Route::post('/users/login/execute', 'UsersController@executeLogin');
Route::post('/users/register/execute', 'UsersController@executeRegister');