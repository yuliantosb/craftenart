<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	public function children()
	{
		return $this->hasMany('App\Comment', 'parent_id');
	}

    public function setParentIdAttribute($value)
    {
         $this->attributes['parent_id'] = !empty($value) ?  $value : 0;
    }
}
