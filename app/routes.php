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

Route::get('settings', 'SettingsController@index');
Route::post('settings', 'SettingsController@save');


Route::any('pocket/connect', 'PocketController@connect');
Route::any('pocket/receiveToken', 'PocketController@receiveToken');
Route::any('pocket/return', 'PocketController@return');
