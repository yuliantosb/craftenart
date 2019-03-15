<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $fillable = ['name', 'content_en', 'content_id'];
    public function scopeGetSetting($query, $name) {

    	$return = $query->where('name', $name)
    					->first();

		if (!empty($return)) {
			if (app()->getLocale() == 'en') {
				$result = $return->content_en;
			} else {
				$result = $return->content_id;
			}
		}

    	return !empty($return) ? json_decode($result) : json_decode('{}');

    }
}
