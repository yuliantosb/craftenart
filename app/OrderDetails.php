<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public function product()
    {
    	return $this->belongsTo('App\Product', 'product_id');
    }

    public function attributes()
    {
        return $this->hasMany('App\OrderAttribute', 'order_detail_id');
    }
}
