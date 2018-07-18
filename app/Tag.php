<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['id', 'name', 'slug', 'description', 'type'];

    public function products()
    {
    	return $this->belongsToMany('App\Product', 'product_tag');
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

    public function getDescriptionAttribute()
    {
        if (app()->isLocale('en')) {
            
            if (empty($this->description_en)) {
                $description = $this->description_id;
            } else {
                $description = $this->description_en;
            }

        } else {

            if (empty($this->description_id)) {
                $description = $this->description_en;
            } else {
                $description = $this->description_id;
            }
        }

        return $description;
    }
}
