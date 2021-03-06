<?php

namespace App\Helpers;
use DateTime;
use App\Currency;
use RajaOngkir;
use App\Category;
use App\Tag;
use App\Product;
use App\Article;

class Helper
{
    public static function bytesToHuman($bytes)
    {
        $units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public static function formatDate($type, $date)
    {
        return  date($type, strtotime($date));
    }

    public static function getStatusTransaction($status)
    {
        if ($status == 1) {

            $status = '<span class="badge bg-warning">Challange</span>';

        } else if ($status == 2) {

            $status = '<span class="badge bg-success">Success</span>';

        } else if ($status == 3) {

            $status = '<span class="badge bg-danger">Fraud</span>';

        } else {

            $status = '<span class="badge bg-info">In Process</span>';
        }

        return $status;

    }

    public static function getRate($rate, $option = [])
    {
        if (!empty($option)) {
            $result = '<ul class="'.$option['class'].'">';
        } else {
            $result = '<ul class="mt-stars">';
        }

        for($i = 1; $i <= round($rate); $i++){
            $result .= '<li style="margin-right: 2px"><i class="fa fa-star"></i></li>';
        }

        if (5 - round($rate) > 0) {

            for ($i = 1; $i <= 5 - round($rate); $i++) {
                $result .= '<li style="margin-right: 2px"><i class="fa fa-star-o"></i></li>';
            }

        }
        
        $result .= '</ul>';

        return $result;
    }

    public static function customRate($rate) {

        $result = '';
        
        for($i = 1; $i <= round($rate); $i++){
            $result .= '<li class="active" style="margin-right: 2px"><a><i class="fa fa-star"></i></a></li>';
        }

        if (5 - round($rate) > 0) {

            for ($i = 1; $i <= 5 - round($rate); $i++) {
                $result .= '<li style="margin-right: 2px"><a><i class="fa fa-star-o"></i></a></li>';
            }

        }

        return $result;
    }

    public static function currency($amount)
    {
        if (session()->has('currency')) {
            $curr = session()->get('currency');
        } else {
            $curr = 'usd';
        }

        $convert = Currency::where('alias', $curr)
                            ->first();

        return $convert->symbol.''.number_format(
                                    ($amount * $convert->convertion),
                                     2,
                                      $convert->decimal_separator,
                                      $convert->thousand_separator);

    }

    public static function setCurrency($amount, $curr = null)
    {
        if (empty($curr)){
            if (session()->has('currency')) {
                $curr = session()->get('currency');
            } else {
                $curr = 'usd';
            }
        }

        $convert = Currency::where('alias', $curr)
                            ->first();
                            
        return ($amount / $convert->convertion);
    }

    public static function getCurrency($amount, $curr = null)
    {
       if(empty($curr)){

            if (session()->has('currency')) {

                $curr = session()->get('currency');
            } else {
                $curr = 'usd';
            }
        }

        $convert = Currency::where('alias', $curr)
                            ->first();

        return $amount * $convert->convertion;

    }

    public static function takeCurrency()
    {
        if (session()->has('currency')) {

            $curr = session()->get('currency');
        } else {
            $curr = 'usd';
        }

        $convert = Currency::where('alias', $curr)
                    ->first();

        return $convert;
    }

    public static function getProvince($province_id)
    {   
        $province = RajaOngkir::Provinsi()->find($province_id);
        return $province['province'];
    }

    public static function getCity($city_id)
    {

        $city = RajaOngkir::Kota()->find($city_id);
        return $city['type'].' '.$city['city_name'];
    }

    public static function getStatus($status)
    {
        if ($status == 0) {

            $status = '<span class="badge bg-info">Waiting</span>';

        } else if ($status == 1) {

            $status = '<span class="badge bg-success">Approved</span>';

        } else if ($status == 2) {

            $status = '<span class="badge bg-danger">Unapproved</span>';

        } 

        return $status;

    }


    public static function createSlug($title, $type, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);
        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = Helper::getRelatedSlugs($slug, $type, $id);
        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }
        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }

    protected static function getRelatedSlugs($slug, $type, $id = 0)
    {
        if ($type == 'category') {
            return Category::select('slug')->where('slug', 'like', $slug.'%')
                ->where('id', '<>', $id)
                ->get();
        }

        if ($type == 'tag') {
            return Tag::select('slug')->where('slug', 'like', $slug.'%')
                ->where('id', '<>', $id)
                ->get();
        }

        if ($type == 'product') {
            return Product::select('slug')->where('slug', 'like', $slug.'%')
                ->where('id', '<>', $id)
                ->get();
        }

        if ($type == 'article') {
            return Article::select('slug')->where('slug', 'like', $slug.'%')
                ->where('id', '<>', $id)
                ->get();
        }
        
    
    }


}