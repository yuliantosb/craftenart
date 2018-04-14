<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function scopeGetSetting($query, $name) {

    	$return = $query->where('name', $name)
    					->first();

    	return !empty($return) ? json_decode($return->content_en) : json_decode('[]');

    }
}
