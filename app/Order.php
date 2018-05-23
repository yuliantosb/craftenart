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

    public function getFullNameAttribute()
	{
	    return "{$this->first_name} {$this->last_name}";
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function scopeCountOrder($query)
	{
		return $query->where('status', 0)
						->count();
	}
}
