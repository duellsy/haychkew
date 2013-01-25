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

Route::any('pocket/action/{action}/{item_id}', 'PocketController@action');

Route::any('pocket/add_link', 'PocketController@add_link');

// Composers

View::composer('templates.bootstrap.index', function($event){

    $site_name = Setting::where('var', 'site_name')->first();
    $site_name = $site_name->value;

    $event->view->with('site_name', $site_name);

});

View::composer('partials/readinglist', function($event){

    $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
    $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

    if( ! $pocket_consumer_key
        OR ! $pocket_access_token
        OR $pocket_consumer_key->value == ''
        OR $pocket_access_token->value == '') {

        $event->view->with('connected', false);

    } else {

        $event->view->with('connected', true);

        $options = array(
            'state'         => 'unread',
            'detailType'    => 'complete'
        );

        $pockpack = new Duellsy\Pockpack\Pockpack($pocket_consumer_key->value, $pocket_access_token->value);
        $list = $pockpack->retrieve($options);

        $event->view->with(
            'reading_list',
            $list->list
        );

    }

});
