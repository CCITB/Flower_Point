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

Route::get('/login', 'MainController@login');

Route::get('/register', 'RegisterController@registerview');

Route::post('/RegisterController', 'RegisterController@store');

Route::get('/find_id', 'LoginController@find_id';

Route::get('/find_password', 'LoginController@find_pw');

// jisu ---- Incomplete.
Route::get('/find_pw_way', function () {
    return view('find_pw_way');
});

Route::get('/pw_reset', function () {
    return view('pw_reset');
});
Route::get('/locate1', function () {
    return view('locate');
});
Route::get('/mypage1', function () {
    return view('mypage');
});
Route::get('/index', function () {
    return view('index');
});
