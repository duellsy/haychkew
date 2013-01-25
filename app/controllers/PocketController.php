<?php

class PocketController extends BaseController {

    public function connect()
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_auth = new Duellsy\Pockpack\PockpackAuth();
        $request_token = $pocket_auth->connect($pocket_consumer_key->value);
        // $request_token = Duellsy\Pockpack\PockpackAuth::connect($pocket_consumer_key->value);

        setcookie('gpcode', $request_token);

        header('Location: ' . $pocket_auth->getBaseUrl() . '/auth/authorize?request_token='.$request_token.'&redirect_uri='. URL::to('pocket/receiveToken'));
        exit;

    }


    public function receiveToken()
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $request_token = $_COOKIE['gpcode'];

        $pockpack = new Duellsy\Pockpack\PockpackAuth();
        $access_token = $pockpack->receiveToken($pocket_consumer_key->value, $request_token);

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

        $pockpack = new Duellsy\Pockpack\Pockpack($pocket_consumer_key->value, $pocket_access_token->value);
        $pockpack_q = new Duellsy\Pockpack\PockpackQueue();
        $pockpack_q->favorite($item_id);
        $pockpack->send($pockpack_q);

        return Redirect::to('/');

    }


    public function unfavorite($item_id)
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $pockpack = new Duellsy\Pockpack\Pockpack($pocket_consumer_key->value, $pocket_access_token->value);
        $pockpack_q = new Duellsy\Pockpack\PockpackQueue();
        $pockpack_q->unfavorite($item_id);
        $pockpack->send($pockpack_q);

        return Redirect::to('/');

    }


    public function archive($item_id)
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $pockpack = new Duellsy\Pockpack\Pockpack($pocket_consumer_key->value, $pocket_access_token->value);
        $pockpack_q = new Duellsy\Pockpack\PockpackQueue();
        $pockpack_q->archive($item_id);
        $pockpack->send($pockpack_q);

        return Redirect::to('/');

    }


    public function delete($item_id)
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $pockpack = new Duellsy\Pockpack\Pockpack($pocket_consumer_key->value, $pocket_access_token->value);
        $pockpack_q = new Duellsy\Pockpack\PockpackQueue();
        $pockpack_q->delete($item_id);
        $pockpack->send($pockpack_q);

        return Redirect::to('/');

    }

}
