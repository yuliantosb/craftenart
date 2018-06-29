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
}
