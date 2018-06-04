<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Helper;
use App\User;

class Coupon extends Model
{
    public function setIsSingleUseAttribute($value)
    {
    	$this->attributes['is_single_use'] = !empty($value) ? $value : 0;
    }

    public function setIsSingleUserAttribute($value)
    {
    	$this->attributes['is_single_user'] = !empty($value) ? $value : 0;
    }

    public function setAmountAttribute($value)
    {

    	$this->attributes['amount'] = !empty($value) ? str_replace(',', '', $value) : null;
    }

    public function setMinAmountAttribute($value)
    {
    	$this->attributes['min_amount'] = !empty($value) ? str_replace(',', '', $value) : null;
    }

    public function setMaxAmountAttribute($value)
    {
    	$this->attributes['max_amount'] = !empty($value) ? str_replace(',', '', $value) : null;
    }

    public function getMinAmountValuesAttribute()
    {
        return Helper::currency(!empty($this->min_amount) ? $this->min_amount : 0);
    }

    public function getMaxAmountValuesAttribute()
    {
        return Helper::currency(!empty($this->max_amount) ? $this->max_amount : 0);
    }

    public function getIsSingleUseAttribute($value)
    {
        return $value ? 'Yes' : 'No';
    }

    public function getIncludeUserValuesAttribute()
    {
        if ($this->include_user != 'null') {
            
            $users = User::whereIn('id', json_decode($this->include_user, true))
                    ->get();

        }

        $user = null;

        return !is_null($user) ? $users->implode('name', ', ') : 'No Included users';

        // return $this->include_user;
    }
}
