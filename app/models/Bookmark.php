<?php

class Bookmark extends Eloquent
{

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function group()
    {
        return $this->belongsTo('Group');
    }

}
