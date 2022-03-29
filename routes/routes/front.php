<?php

use Illuminate\Support\Facades\Route;

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

/* Front Page */
Route::get('', 'Front\HomeController@index');
Route::get('pricing', 'Front\HomeController@pricing');
Route::get('category/{keyword}', 'Front\HomeController@category');
Route::get('tag/{keyword}', 'Front\HomeController@tag');
Route::get('search', 'Front\HomeController@search');
Route::get('embed/{type}/{category}', 'Front\HomeController@embed');
Route::get('video-detail/{keyword}', 'Front\HomeController@video_detail');
Route::get('video-detail-2', 'Front\HomeController@video_detail_2');

//Route::get('category/{id}', 'Front\HomeController@category');
//Route::get('video-detail/{id}', 'Front\HomeController@video_detail');

//user login
Route::group(['middleware'=>'authuser'], function(){
	Route::post('atc', 'Front\TransactionController@atc');
	Route::post('buyVideo', 'Front\TransactionController@buyVideo');
	Route::get('checkout', 'Front\TransactionController@checkout');
	Route::get('finish-checkout', 'Front\TransactionController@finish_checkout');
	Route::get('logout', 'Front\UserController@logout');
	Route::post('comment', 'Front\HomeController@comment');
	Route::post('favoriteVideo', 'Front\HomeController@favoriteVideo');
	
	
	Route::group(['prefix'=>'user'], function(){
		Route::get('/', 'Front\UserController@profile');
		Route::post('/', 'Front\UserController@profile_act');
		Route::get('/video', 'Front\UserController@video');
		Route::post('/video/rating', 'Front\UserController@video_rating');
		Route::get('/order', 'Front\UserController@order');
		Route::get('/order/detail/{id}', 'Front\UserController@order_detail');
		Route::get('/subscription', 'Front\UserController@subscription');
		Route::get('favorite_video', 'Front\UserController@favorite_video');
	});
});


//user
//login
Route::group(['prefix'=>'login'], function(){
	Route::get('', 'Front\UserController@login');
	Route::post('', 'Front\UserController@login_act');
});

//transaction
Route::group(['prefix'=>'payment'], function(){
	Route::post('', 'PaymentGateway\PaymentGatewayController@payment');
	Route::post('callback', 'PaymentGateway\CallbackController@callback');
});