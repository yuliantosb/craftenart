<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

	public function details()
	{
		return $this->hasMany('App\StockDetails');
	}

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace(',', '', $value);
    }
}
