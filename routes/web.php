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
	Route::get('/admin_coupons_edit/{id}',[
		'uses'	=> 'admin\GalleryController@coupons_edit',
		'as'	=> 'admin.coupons.edit'
	]);
	Route::post('/admin_coupons_update/{id}',[
		'uses'	=> 'admin\GalleryController@coupons_update',
		'as'	=> 'admin.coupons.update'
	]);
	Route::post('/get_cat_seller',[
		'uses' 	=> 'admin\ProductController@get_cat',
		'as'	=> 'get.cat.seller'
	]);
	Route::get('/thirdcategory_edit/{id}',[
		'uses' 	=> 'admin\CategoriesController@thirdcategory_edit',
		'as'	=> 'thirdcat.edit'
	]);
	Route::get('/thirdcategory_update/{id}',[
		'uses' 	=> 'admin\CategoriesController@thirdcategory_update',
		'as'	=> 'thirdcat.update'
	]);
	Route::get('/third_category_destroy/{id}',[
		'uses'	=> 'admin\CategoriesController@thirdcategory_destory',
		'as'	=> 'thirdcat.destroy'
	]);
	Route::post('/order_status_update',[
		'uses' 	=> 'admin\OrdersController@order_status_update',
		'as'	=> 'order.status.update'
	]);
	Route::post('/order_status_reject',[
		'uses' 	=> 'admin\OrdersController@order_status_reject',
		'as'	=> 'order.status.reject'
	]);
	Route::post('/order_status_accpect',[
		'uses' 	=> 'admin\OrdersController@order_status_accpect',
		'as'	=> 'order.status.accpect'
	]);
	Route::get('/completed_orders',[
		'uses' 	=> 'admin\OrdersController@completed_orders_list',
		'as'	=> 'completed.orders'
	]);
	Route::get('/lowstock_product',[
		'uses' 	=> 'admin\OrdersController@lowstock_product',
		'as'	=> 'lowstock.product'
	]);

	Route::get('/product_seller_index',[
		'uses' 	=> 'admin\ProductController@index',
		'as'	=> 'product.seller.index'
	]);
	Route::get('/product_seller_create',[
		'uses' 	=> 'admin\ProductController@create',
		'as'	=> 'product.seller.create'
	]);
	Route::post('/product_seller_store',[
		'uses' 	=> 'admin\ProductController@store',
		'as'	=> 'product.seller.store'
	]);
	Route::get('/product_seller_edit/{id}',[
		'uses' 	=> 'admin\ProductController@edit',
		'as'	=> 'product.seller.edit'
	]);
	Route::post('/product_seller_update/{id}',[
		'uses' 	=> 'admin\ProductController@update',
		'as'	=> 'product.seller.update'
	]);
	Route::get('/product_seller_destroy/{id}',[
		'uses' 	=> 'admin\ProductController@destroy',
		'as'	=> 'product.seller.destroy'
	]);

});
