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

    public function getNameAttribute()
    {
        if (app()->isLocale('en')) {
            
            if (empty($this->name_en)) {
                $name = $this->name_id;
            } else {
                $name = $this->name_en;
            }

        } else {

            if (empty($this->name_id)) {
                $name = $this->name_en;
            } else {
                $name = $this->name_id;
            }
        }

        return $name;
    }
}
