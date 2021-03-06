<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['prefix' => 'user'], function () {

	Route::post('login', [
		'uses' => 'Apis\UsersControllers@login',
		'as' => 'login'
	]);

	Route::post('register-user', [
		'uses' => 'Apis\UsersControllers@register',
		'as' => 'register-user'
	]);

	Route::post('forgot-password', [
		'uses' => 'Apis\UsersControllers@forgot_password',
		'as' => 'forgot-password'
	]);

	Route::post('verify-code', [
		'uses' => 'Apis\UsersControllers@verify_code',
		'as' => 'verify-code'
	]);

	Route::post('update-user-password', [
		'uses' => 'Apis\UsersControllers@update_forgot_pass',
		'as' => 'update-user-password'
	]);
	Route::resource('settings', 'Apis\SettingsController', ['only' => ['store']]);
});

Route::group(['prefix' => 'product'], function () {
	Route::group(['middleware' => ['auth:api']], function () {
		Route::resource('home', 'Apis\HomeController', ['only' => ['index']]);
		Route::resource('categories', 'Apis\CategoriesController', ['only' => ['index']]);
		Route::resource('products', 'Apis\ProductsController',['only' => ['show']]);

		Route::get('low-to-high-products/{id}', 'Apis\ProductsController@low_to_high_products')
			->name('low-to-high-products');

		Route::get('high-to-low-products/{id}', 'Apis\ProductsController@high_to_low_products')
			->name('high-to-low-products');

		Route::get('best-rating-products/{id}', 'Apis\ProductsController@best_rating_products')
			->name('best-rating-products');

		Route::get('newly-added-products/{id}', 'Apis\ProductsController@newly_added_products')
			->name('newly-added-products');

		Route::post('Add-product-to-wish-LIst', 'Apis\ProductsController@add_product_to_wishList')
			->name('Add-product-to-wish-LIst');

		Route::get('get-product/{id}', 'Apis\ProductsController@get_product_details')
			->name('get-product');

		Route::get('view-all-reviews/{id}', 'Apis\ProductsController@view_all_reviews')
			->name('view-all-reviews');

		Route::get('user-wish-list-products/{id}', 'Apis\ProductsController@user_wish_list_products')
			->name('user-wish-list-products');
		
		Route::get('head-categories', 'Apis\CategoriesController@head_categories')
			->name('head-categories');
		
		Route::get('sub-categories/{id}', 'Apis\CategoriesController@sub_categories')
			->name('sub-categories');
	});
});

Route::group(['prefix' => 'cart'], function () {
	Route::group(['middleware' => ['auth:api']], function () {
		Route::resource('coupons', 'Apis\CouponsController', ['only' => ['store']]);
	});
});

Route::group(['prefix' => 'settings'], function () {
	Route::group(['middleware' => ['auth:api']], function () {
		Route::get('privacy-policy', 'Apis\SettingsController@privacy_policy')
		->name('privacy-policy');
		Route::get('terms-conditions', 'Apis\SettingsController@terms_conditions')
		->name('terms-conditions');
	});
});