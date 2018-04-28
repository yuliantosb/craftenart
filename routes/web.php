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
Route::get('/', 'HomeController@index')->name('home');


// currency
Route::get('currency/{type}', 'CurrencyController@set')->name('currency.set');

// auth

Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.provider_callback');
Route::post('/login/check', 'Auth\LoginController@check')->name('login.check');
Auth::routes();

// cart
Route::post('cart', 'CartController@store')->name('cart.store');
Route::delete('cart/{id}', 'CartController@destroy')->name('cart.destroy');

// coupon
Route::post('coupon', 'CouponController@apply')->name('coupon.apply');
Route::get('coupon', 'CouponController@index')->name('coupon.index');
Route::delete('coupon/{code}', 'CouponController@destroy')->name('coupon.destroy');

// admin
Route::prefix('/admin')->as('admin.')->middleware(['auth', 'role:admin'])->group(function(){
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
	// user
	Route::resource('/user', 'UserController');
	// region
	Route::get('/region/city', 'RegionController@city');
});

// shop
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/{slug}', 'ShopController@show')->name('shop.show');
Auth::routes();
