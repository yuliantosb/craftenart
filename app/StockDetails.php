<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockDetails extends Model
{
    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = str_replace(',', '', $value);
    }
}
