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
		Route::resource('products', 'Apis\ProductsController');
		Route::get('categories', 'Apis\ProductsController@categories')->name('categories');
	});

});