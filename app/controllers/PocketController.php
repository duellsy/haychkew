<?php

class PocketController extends BaseController {

    public function connect()
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $request_token = Pockpack::connect($pocket_consumer_key->value);

        setcookie('gpcode', $request_token);

        header('Location: ' . Pockpack::getBaseUrl() . '/auth/authorize?request_token='.$request_token.'&redirect_uri='. URL::to('pocket/receiveToken'));
        exit;

    }


    public function receiveToken()
    {
        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $request_token = $_COOKIE['gpcode'];
        $access_token = Pockpack::receiveToken($pocket_consumer_key->value, $request_token);

        $setting = Setting::where('var', 'pocket_access_token')->first();
        $setting->value = $access_token;
        $setting->save();

        return Redirect::to('settings');
    }


    public function action($action, $item_id)
    {
        return $this->$action($item_id);
    }


    public function favorite($item_id)
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $response = Pockpack::favorite($pocket_consumer_key->value, $pocket_access_token->value, $item_id);

        return Redirect::to('/');

    }


    public function unfavorite($item_id)
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $response = Pockpack::unfavorite($pocket_consumer_key->value, $pocket_access_token->value, $item_id);

        return Redirect::to('/');

    }


    public function archive($item_id)
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $response = Pockpack::archive($pocket_consumer_key->value, $pocket_access_token->value, $item_id);

        return Redirect::to('/');

    }


    public function delete($item_id)
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $response = Pockpack::delete($pocket_consumer_key->value, $pocket_access_token->value, $item_id);

        return Redirect::to('/');

    }

}
