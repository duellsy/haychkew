<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{

		$pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
		$pocket_access_token = Setting::where('var', 'pocket_access_token')->first();
		$reading_list = Getpocket::retrieve($pocket_consumer_key->value, $pocket_access_token->value);

		$data = array(
			'groups' => Group::with('bookmarks')->get(),
			'reading_list'	=> $reading_list
		);

		$this->layout->nest('content', 'hello', $data);
	}

}
