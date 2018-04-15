<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// home
Route::get('/', 'HomeController@index');

// shop
Route::get('/shop', function () {
    return view('frontend.shop');
});

// currency
Route::get('currency/{type}', 'CurrencyController@set')->name('currency.set');

// auth
Auth::routes();

// cart
Route::post('cart', 'CartController@store')->name('cart.store');
Route::delete('cart/{id}', 'CartController@destroy')->name('cart.destroy');

Route::prefix('/admin')->as('admin.')/*->middleware(['auth', 'role:admin'])*/->group(function(){
	// dashboard
	Route::resource('/dashboard', 'DashboardController');
	// product
	Route::resource('product', 'ProductController');
	// media
	Route::prefix('media')->group(function(){
		Route::post('uploads', 'MediaController@uploads')->name('media.uploads');
		Route::get('get-data', 'MediaController@getData')->name('media.get-data');
		Route::get('select-data/{id}', 'MediaController@selectData')->name('media.get-data');
	});
	Route::resource('/media', 'MediaController');
	// category
	Route::resource('/category', 'CategoryController');
	// tag
	Route::resource('/tag', 'TagController');
});

// shop
Route::get('/{slug}', 'ShopController@show')->name('shop.show');