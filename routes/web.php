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
//上传图片路由
Route::post('/upload','UploadController@upload');
//登录路由
Route::get('login','LoginController@login')->name('login');
Route::post('login','LoginController@check')->name('login');
Route::delete('logout','LoginController@logout')->name('logout');
//管理员路由
Route::resource('admin','AdminController');
//修改密码路由
Route::get('editPwd/{admin}','AdminController@editPwd')->name('editPwd');
Route::post('editPwd/{admin}','AdminController@editPwd')->name('editPwd');
//店铺分类
Route::resource('shopCategory','CategoryController');
//店铺列表
Route::get('shopAccount','ShopAccountController@index')->name('shopAccount');
//添加商铺
Route::get('shopAccount/create','ShopAccountController@create')->name('shopAccount.create');
Route::post('shopAccount/store','ShopAccountController@store')->name('shopAccount.store');
//店铺详情
Route::get('show/{shopAccount}','ShopAccountController@show')->name('show');
//审核通过
Route::get('pass/{shopAccount}','ShopAccountController@pass')->name('pass');
//审核拒绝
Route::get('disabled/{shopAccount}','ShopAccountController@disabled')->name('disabled');


