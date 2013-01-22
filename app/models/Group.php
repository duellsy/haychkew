<?php

class Group extends Eloquent
{

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function bookmarks()
    {
        return $this->hasMany('Bookmark');
    }

}
