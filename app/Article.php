<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function comments()
    {
    	return $this->hasMany('App\Comment', 'article_id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function categories()
    {
    	return $this->belongsToMany('App\Category', 'article_category');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag', 'article_tag');
    }

    public function widget()
    {
        return $this->belongsTo('App\Widget', 'widget_id');
    }
}
