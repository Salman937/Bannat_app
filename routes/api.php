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

	Route::post('register', [
		'uses' => 'Apis\UsersControllers@register',
		'as' => 'register'
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

});

Route::group(['prefix' => 'product'], function () {

	Route::group(['middleware' => ['auth:api']], function () {
		Route::resource('home', 'Apis\HomeController');
		Route::resource('categories', 'Apis\CategoriesController');
		Route::resource('products', 'Apis\ProductsController');

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
	});

});