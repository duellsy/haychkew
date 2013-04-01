<?php
use Duellsy\Pockpack\Pockpack;
use Duellsy\Pockpack\PockpackAuth;
use Duellsy\Pockpack\PockpackQueue;

class PocketController extends BaseController {

    public function connect()
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_auth = new PockpackAuth();
        $request_token = $pocket_auth->connect($pocket_consumer_key->value);

        setcookie('gpcode', $request_token);

        header('Location: ' . $pocket_auth->getBaseUrl()
            . '/auth/authorize?request_token='
            . $request_token
            . '&redirect_uri='
            . URL::to('pocket/receiveToken'));
        exit;

    }


    public function receiveToken()
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $request_token = $_COOKIE['gpcode'];

        $pockpack = new PockpackAuth();
        $access_token = $pockpack->receiveToken($pocket_consumer_key->value, $request_token);

        $setting = Setting::where('var', 'pocket_access_token')->first();
        $setting->value = $access_token;
        $setting->save();

        return Redirect::to('settings');

    }



    public function reading_list() {
        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        if( ! $pocket_consumer_key
            OR ! $pocket_access_token
            OR $pocket_consumer_key->value == ''
            OR $pocket_access_token->value == '') {

            return View::make('partials/reading_list', array(
                'connected'     => false
            ));

        } else {

            $options = array(
                'state'         => 'unread',
                'detailType'    => 'complete'
            );

            $pockpack = new Pockpack($pocket_consumer_key->value, $pocket_access_token->value);
            $list = $pockpack->retrieve($options);

            return View::make('partials/readinglist', array(
                'reading_list'  => $list->list,
                'connected'     => true
            ));

        }
    }


    public function action($action, $item_id)
    {
        return $this->$action($item_id);
    }


    public function favorite($item_id)
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $pockpack = new Pockpack($pocket_consumer_key->value, $pocket_access_token->value);
        $pockpack_q = new PockpackQueue();
        $pockpack_q->favorite($item_id);
        $pockpack->send($pockpack_q);

        // return Redirect::to('/');

    }


    public function unfavorite($item_id)
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $pockpack = new Pockpack($pocket_consumer_key->value, $pocket_access_token->value);
        $pockpack_q = new PockpackQueue();
        $pockpack_q->unfavorite($item_id);
        $pockpack->send($pockpack_q);

        // return Redirect::to('/');

    }


    public function archive($item_id)
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $pockpack = new Pockpack($pocket_consumer_key->value, $pocket_access_token->value);
        $pockpack_q = new PockpackQueue();
        $pockpack_q->archive($item_id);
        $pockpack->send($pockpack_q);

        // return Redirect::to('/');

    }


    public function delete($item_id)
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $pockpack = new Pockpack($pocket_consumer_key->value, $pocket_access_token->value);
        $pockpack_q = new PockpackQueue();
        $pockpack_q->delete($item_id);
        $pockpack->send($pockpack_q);

        // return Redirect::to('/');

    }




    public function add_link()
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        $pocket_access_token = Setting::where('var', 'pocket_access_token')->first();

        $input = Input::all();
        $link_info = array(
            'url'       => $input['url']
        );

        $pockpack = new Pockpack($pocket_consumer_key->value, $pocket_access_token->value);
        $pockpack_q = new PockpackQueue();

        $pockpack_q->add($link_info);
        $pockpack->send($pockpack_q);

        return Redirect::to('/');

    }

}
