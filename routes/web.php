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
    return view('welcome');
});
//店铺分类
Route::resource('shopCategory','CategoryController');
//店铺列表
Route::get('shopAccount','ShopAccountController@index')->name('shopAccount');
//店铺详情
Route::get('show/{shopAccount}','ShopAccountController@show')->name('show');
//审核通过
Route::get('pass/{shopAccount}','ShopAccountController@pass')->name('pass');
//审核拒绝
Route::get('disabled/{shopAccount}','ShopAccountController@disabled')->name('disabled');


