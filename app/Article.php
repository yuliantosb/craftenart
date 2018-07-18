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

    public function getTitleAttribute()
    {
        if (app()->isLocale('en')) {
            
            if (empty($this->title_en)) {
                $title = $this->title_id;
            } else {
                $title = $this->title_en;
            }

        } else {

            if (empty($this->title_id)) {
                $title = $this->title_en;
            } else {
                $title = $this->title_id;
            }
        }

        return $title;
    }

    public function getContentAttribute()
    {
        if (app()->isLocale('en')) {
            
            if (empty($this->content_en)) {
                $content = $this->content_id;
            } else {
                $content = $this->content_en;
            }

        } else {

            if (empty($this->content_id)) {
                $content = $this->content_en;
            } else {
                $content = $this->content_id;
            }
        }

        return $content;
    }
}
