<?php

class PocketController extends BaseController {

    public function connect()
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $request_token = Getpocket::connect($pocket_consumer_key->value);

        setcookie('gpcode', $request_token);

        header('Location: ' . Getpocket::getBaseUrl() . '/auth/authorize?request_token='.$request_token.'&redirect_uri='. URL::to('pocket/receiveToken'));
        exit;

    }


    public function receiveToken()
    {
        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $request_token = $_COOKIE['gpcode'];
        $access_token = Getpocket::receiveToken($pocket_consumer_key->value, $request_token);

        $setting = Setting::where('var', 'pocket_access_token')->first();
        $setting->value = $access_token;
        $setting->save();

        return Redirect::to('settings');
    }

}
