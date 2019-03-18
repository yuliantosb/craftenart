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
Route::post('cart/shipping', 'CartController@addFee')->name('cart.shipping');
Route::put('cart/update', 'CartController@updateCart')->name('cart.update');
Route::delete('cart/remove/{id}', 'CartController@removeCart')->name('cart.remove');
Route::resource('cart', 'CartController');

// checkout
Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('checkout', 'CheckoutController@store')->name('checkout.store');

// region, what you just rewrite existing code? 
Route::get('/region/city', 'RegionController@city');
Route::post('/region/cost', 'RegionController@cost');

// coupon
Route::post('coupon', 'CouponController@apply')->name('coupon.apply');
Route::delete('coupon/{code}', 'CouponController@remove')->name('coupon.remove');

// review
Route::post('review', 'ReviewController@store')->name('review.store');

// payment
Route::get('payment', 'PaymentController@index')->name('payment.index');
Route::post('payment/store', 'PaymentController@store')->name('payment.store');
Route::get('payment/complete/{type}', 'PaymentController@complete')->name('payment.complete');
Route::get('payment/paypal', 'PaymentController@paypal')->name('payment.paypal');

// post
Route::get('blog', 'BlogController@index')->name('blog.index');
Route::get('blog/{slug}', 'BlogController@show')->name('blog.show');
Route::post('blog/{post_id}', 'BlogController@comment')->name('blog.comment');

// page
Route::get('pages/{slug}', 'ArticleController@show')->name('page.show');

// subscribe
Route::post('subscribe', 'NewsLetterController@save')->name('subscribe.save');
Route::post('subscribe/check', 'NewsLetterController@check')->name('subscribe.check');

// language
Route::get('language', 'LanguageController@set')->name('language.set');

// wishlist
Route::post('wishlist', 'WishlistController@store')->name('wishlist.store');
Route::delete('wishlist/{id}', 'WishlistController@destroy')->name('wishlist.destroy');

// tes notification
Route::post('vt_notif', 'VtwebController@notification');

// user

Route::get('user', function(){
	return redirect()->route('user.dashboard.index');
});

Route::prefix('/user')->as('user.')->middleware(['auth', 'role:admin|user'])->group(function(){
	// dashboard
	Route::get('/dashboard', 'MyDashboardController@index')->name('dashboard.index');
	// profile
	Route::get('/profile', 'MyProfileController@index')->name('profile.index');
	Route::get('/profile/edit', 'MyProfileController@edit')->name('profile.edit');
	Route::put('/profile/edit', 'MyProfileController@update')->name('profile.update');
	Route::post('/profile/upload', 'MyProfileController@upload')->name('profile.upload');
	Route::get('/profile/password', 'MyProfileController@password')->name('password.edit');
	Route::post('/profile/check_password', 'MyProfileController@checkPassword')->name('password.check_password');
	Route::post('/password/change', 'MyProfileController@changePasswd')->name('password.change');
	// order
	Route::get('/order', 'MyOrderController@index')->name('order.index');
	// wishlist
	Route::get('/wishlist', 'MyWishlistController@index')->name('wishlist.index');
	// review
	Route::get('/review', 'MyReviewController@index')->name('review.index');
	// 
	Route::get('/testing', 'MyTestingController@index')->name('testing.index');

});

// admin

Route::get('admin', function(){
	return redirect()->route('admin.dashboard.index');
});

Route::prefix('/admin')->as('admin.')->middleware(['auth', 'role:admin'])->group(function(){
	// dashboard
	Route::get('/dashboard/get_data_payment', 'DashboardController@getDataPayment')->name('dashboard.get_data_payment');
	Route::get('/dashboard/get_data_top', 'DashboardController@getDataTop')->name('dashboard.get_data_top');
	Route::get('/dashboard/get_data_order_status', 'DashboardController@getDataOrderStatus')->name('dashboard.get_data_order_status');
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
	Route::post('/user/check', 'UserController@check');
	Route::resource('/user', 'UserController');
	// region
	Route::get('/region/city', 'RegionController@city');
	// review
	Route::resource('review', 'ReviewController');
	// order
	Route::resource('order', 'OrderController');
	// stock
	Route::resource('stock', 'StockController');
	// coupon
	Route::resource('coupon', 'CouponController');
	// menu
	Route::post('/menu/bulk_edit', 'MenuController@bulkEdit')->name('menu.bulk_edit');
	Route::resource('menu', 'MenuController');
	// widget
	Route::resource('widget', 'WidgetController');
	// settings
	Route::get('settings/get_widget', 'SettingController@getWidget')->name('settings.get_widget');
	Route::resource('settings', 'SettingController');
	// pages
	Route::resource('page', 'PageController');
	// post
	Route::resource('post', 'PostController');
});


// shop
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/{slug}', 'ShopController@show')->name('shop.show');
Auth::routes();
