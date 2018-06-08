<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Helper;

class Product extends Model
{
    protected $appends = ['price_amount'];

    public function stock()
    {
    	return $this->hasOne('App\Stock');
    }

    public function galleries()
    {
    	return $this->hasMany('App\ProductGalleries', 'product_id');
    }

    public function categories()
    {
    	return $this->belongsToMany('App\Category', 'product_category');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }

    public function reviews()
    {
    	return $this->hasMany('App\Review', 'product_id')->where('status', 1);
    }

    public function attributes()
    {
    	return $this->hasMany('App\ProductAttributes', 'product_id');
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = Helper::setCurrency(str_replace(',', '', $value), session()->get('currency'));
    }

    public function setSaleAttribute($value)
    {
        if ($value == 0) {
            $this->attributes['sale'] = NULL;
        } else {
            $this->attributes['sale'] = Helper::setCurrency(str_replace(',', '', $value), session()->get('currency'));
        }
    }

    public function setWeightAttribute($value)
    {
        $this->attributes['weight'] = str_replace(',', '', $value);
    }

    public function getPriceAmountAttribute()
    {
        if (!empty($this->sale)) {
            return '<sup style="color: #aaa"><s>'.Helper::currency($this->price).'</s></sup> '.Helper::currency($this->sale);
        } else {
            return Helper::currency($this->price);
        }
    }

    public function orders()
    {
       return $this->hasMany('App\OrderDetails', 'product_id');
    }

    public function scopeGetProduct($query, $category, $tag, $keyword, $price)
    {  

        if (!empty($category)) {
            $query->whereHas('categories', function($where) use ($category){
                $where->where('slug', $category);
            });
        }

        if (!empty($tag)) {
            $query->whereHas('tags', function($where) use ($tag){
                $where->whereIn('slug', $tag);
            });
        }

        if (!empty($keyword)) {
            $query->where('name', 'like', '%'.$keyword.'%');
        }

        if (!empty($price)) {

            $price = explode(',', $price);
            $min = Helper::setCurrency($price[0]);
            $max = Helper::setCurrency($price[1]);

            $query->whereBetween('price', [$min, $max]);
        }

        if (session()->has('sort') && session()->has('type')) {

            $query->orderBy(session()->get('sort'), session()->get('type'));

        } else {
            
            $query->orderBy('name', 'asc');
        }

        return $query;
    }

}
