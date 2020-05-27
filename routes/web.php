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

//eojisu
Route::get('/', 'MainController@main');

Route::get('/login_customer', 'MainController@login_customer');

Route::get('/login_seller', 'MainController@login_seller');


Route::get('/register_customer','MainController@register_costomer');

Route::get('/register_seller','MainController@register_seller');

//중복 검사
Route::post('/seller_OverlapID', 'RegisterController@s_overlapID');

Route::post('/seller_OverlapPW', 'RegisterController@s_overlapPW');

Route::post('/customer_OverlapID', 'RegisterController@c_overlapID');

Route::post('/customer_OverlapPW', 'RegisterController@c_overlapPW');

Route::post('/register_InsertStore', 'RegisterController@store_information');

Route::get('/register', 'RegisterController@registerview');

Route::get('/terms_customers', 'MainController@register_terms_customers');

Route::get('/terms_sellers', 'MainController@register_terms_sellers');

Route::get('/information', 'MainController@register_information');



Route::post('/RegisterControllerSeller', 'RegisterController@seller_store');

Route::post('/RegisterControllerCustomer', 'RegisterController@customer_store');

Route::get('/find_id', 'FindController@find_id');

Route::get('/find_pw', 'FindController@find_pw');

Route::get('/find_pw_way', 'FindController@find_pw_way');

Route::get('/find_pw_reset', 'FindController@find_pw_reset');

Route::post('/login_s', 'RegisterController@login_s');

Route::post('/login_c', 'RegisterController@login_c');

Route::get('/logout', 'RegisterController@logout');



Route::get('/locate1', function () {
  return view('locate');
});
Route::get('/mypage1', function () {
  return view('mypage');
});

Route::get('/faq', function () {
  return view('FAQ');
});
Route::get('/myqna', function () {
  return view('myQnA');
});
Route::get('/postlist', function () {
  return view('post_list');
});
Route::get('/sellershoppost', function () {
  return view('seller_shoppost');
});
Route::get('/bi', function () {
  return view('Buy_information');
});
Route::post('index', 'postcontroller@post');

Route::get('/sellermyshop', function () {
  return view('gwang_jin.Seller_myshop2');
});
Route::get('/mypage2', function () {
  return view('mypage_customer');
});

//결제
Route::get('/order', function () {
  return view('payment.order');
});
Route::get('/complete', function(){
  return view('payment.complete');
});
Route::get('/order1', function(){
  return view('orderlist');
});
