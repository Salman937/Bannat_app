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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
	Route::resource('category','admin\CategoriesController');
});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('subcategory','admin\SubcategoryController');
});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('product','admin\ProductController');
});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('gallery','admin\GalleryController');
});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('coupons','admin\CouponsController');
});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('user','admin\UsersController');
});

Route::get('/userdeactive', 'admin\UsersController@de_active_user')->name('user.deactive');
