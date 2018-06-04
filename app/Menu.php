<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	public function child()
    {
    	return $this->hasMany('App\Menu', 'parent_id')
					->orderBy('order_number');
    }

    public function widget()
    {
    	return $this->belongsTo('App\Widget', 'widget_id');
    }

    public function scopeGetMenu($query)
    {
    	return $query->where('parent_id', 0)
    			->orderBy('order_number')
    			->get();
    }
}
