<?php

class PocketController extends BaseController {

    public function connect()
    {

        $pocket_consumer_key = Setting::where('var', 'pocket_consumer_key')->first();
        Getpocket::connect($pocket_consumer_key->value);



    }

}
