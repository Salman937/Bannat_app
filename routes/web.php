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

Route::group(['middleware' => 'auth'], function(){
	Route::resource('category','admin\CategoriesController');
});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('subcategory','admin\SubcategoryController');
});

Route::group(['middleware' => ['auth','admin']], function(){
	Route::resource('gallery','admin\GalleryController');
});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('coupons','admin\CouponsController');
});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('user','admin\UsersController');
});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('order','admin\OrdersController');
});

Route::get('/userdeactive', 'admin\UsersController@de_active_user')->name('user.deactive');

Route::group(['middleware' => 'auth'],function(){

	Route::get('/home', 'HomeController@index')->name('home');
	// Route::get('/seller_home', 'SellerController@index')->name('seller_home');

	Route::get('/thirdcategory',[
		'uses' => 'admin\CategoriesController@third_category_list',
		'as'   => 'third.category'
	]);
	Route::post('/get_cat',[
		'uses' 	=> 'admin\CategoriesController@get_cat',
		'as'	=> 'get.cat'
	]);
	Route::post('/store/thirdcategory',[
		'uses' 	=> 'admin\CategoriesController@thirdcategory_store',
		'as'	=> 'third_category.store'
	]);
	Route::get('/admin_404_error',[
		'uses'	=> 'admin\GalleryController@admin_404_error',
		'as'	=> 'admin.404.error'
	]);
	Route::get('/seller_404_error',[
		'uses'	=> 'admin\ProductController@seller_404_error',
		'as'	=> 'seller.404.error'
	]);
	Route::get('/admin/coupons/list',[
		'uses'	=> 'admin\GalleryController@coupons_list',
		'as'	=> 'admin.coupons.list'
	]);
	Route::get('/admin/coupons/create',[
		'uses'	=> 'admin\GalleryController@coupons_create',
		'as'	=> 'admin.coupons.create'
	]);
	Route::post('/admin/coupons/store',[
		'uses'	=> 'admin\GalleryController@coupons_store',
		'as'	=> 'admin.coupons.store'
	]);
	Route::get('/coupons/destroy/{id}',[
		'uses'	=> 'admin\GalleryController@coupons_destory',
		'as'	=> 'admin.coupons.destroy'
	]);
	Route::post('/get_cat_seller',[
		'uses' 	=> 'admin\ProductController@get_cat',
		'as'	=> 'get.cat.seller'
	]);
	Route::get('/admin/coupons/destroy/{id}',[
		'uses'	=> 'admin\CategoriesController@thirdcategory_destory',
		'as'	=> 'thirdcat.destroy'
	]);

});

Route::group(['middleware' => 'auth'], function(){
	Route::resource('product','admin\ProductController');
});