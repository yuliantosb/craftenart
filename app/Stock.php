<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

	public function details()
	{
		return $this->hasMany('App\StockDetails')->latest();
	}

	public function product()
	{
		return $this->belongsTo('App\Product', 'product_id');
	}

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace(',', '', $value);
    }
}
