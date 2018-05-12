<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function details()
    {
    	return $this->hasMany('App\OrderDetails');
    }

    public function ship()
    {
    	return $this->hasOne('App\Ship');
    }
}
