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
    return view('auth.register');
});

Route::get('login/shopify', 'LoginShopifyController@redirectToProvider')->name('shopify');
Route::get('login/shopify/callback', 'LoginShopifyController@handleProviderCallback');
Route::get('home','HomeController@index')->name('home');
