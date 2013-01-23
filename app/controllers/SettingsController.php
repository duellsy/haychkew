<?php

class SettingsController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |   Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function index()
    {
        $data = array(
            'settings' => Setting::all()
        );

        $this->layout->nest('content', 'settings', $data);
    }


    public function save()
    {

        $input = Input::get();
        foreach($input as $key => $val) {
            $setting = Setting::where('var', $key);
            $setting->update(array('value' => $val));
        }

        return Redirect::to('settings');

    }



}
