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

Route::get('/login', 'MainController@login_customer');

Route::get('/login', 'MainController@login_seller');

Route::get('/user','MainController@register_costomer');

Route::get('/seller','MainController@register_seller');

Route::get('/information', 'MainController@register_information');

Route::get('/register', 'RegisterController@registerview');

Route::post('/RegisterController', 'RegisterController@store');

Route::get('/find_id', 'FindController@find_id');

Route::get('/find_pw', 'FindController@find_pw');

Route::get('/find_pw_way', 'FindController@find_pw_way');

Route::get('/find_pw_reset', 'FindController@find_pw_reset');


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
