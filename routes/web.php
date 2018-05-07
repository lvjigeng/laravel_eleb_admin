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

Route::get('/','IndexController@welcome')->name('/');

Route::get('index','IndexController@index')->name('index');
//上传图片路由
Route::post('/upload','UploadController@upload');
//登录路由
Route::get('login','LoginController@login')->name('login');
Route::post('login','LoginController@check')->name('login');
Route::delete('logout','LoginController@logout')->name('logout');
//管理员路由
Route::resource('admin','AdminController')->middleware("role:admin_super");
//修改密码路由
Route::get('editPwd/{admin}','AdminController@editPwd')->name('editPwd');
Route::post('editPwd/{admin}','AdminController@editPwd')->name('editPwd');


//店铺分类
Route::resource('shopCategory','CategoryController')->middleware("role:admin_super");
//店铺列表
Route::get('shopAccount','ShopAccountController@index')->name('shopAccount')->middleware("permission:shopAccount");
//添加商铺
Route::get('shopAccount/create','ShopAccountController@create')->name('shopAccount.create')->middleware("permission:shopAccount.create");
Route::post('shopAccount/store','ShopAccountController@store')->name('shopAccount.store')->middleware("permission:shopAccount.create");
//店铺详情
Route::get('show/{shopAccount}','ShopAccountController@show')->name('shopAccount.show')->middleware("permission:shopAccount.show");
//审核通过
Route::get('pass/{shopAccount}','ShopAccountController@pass')->name('shopAccount.pass')->middleware("permission:shopAccount.pass");
//审核拒绝
Route::get('disabled/{shopAccount}','ShopAccountController@disabled')->name('shopAccount.disabled')->middleware("permission:shopAccount.disabled");


//活动路由
Route::resource('activity','ActivityController')->middleware("role:admin_super|admin_activity");
//奖品路由
Route::resource('activityPrize','ActivityPrizeController')->middleware("role:admin_super|admin_activity");
//活动开奖路由
Route::get('lottery','ActivityController@lottery')->name('activity.lottery')->middleware("permission:activity.lottery");
//活动中奖名单
Route::get('winning','ActivityController@winning')->name('activity.winning')->middleware("permission:activity.winning");


//订单数量排行路由
Route::get('count/orderIndex','CountController@orderIndex')->name('count.orderIndex')->middleware("permission:count.orderIndex");
//菜品数量排行
Route::get('count/foodsIndex','CountController@foodsIndex')->name('count.foodsIndex')->middleware("permission:count.foodsIndex");


//会员列表
Route::get('user','UserController@index')->name('user.index')->middleware("permission:user.index");
//会员详细信息
Route::get('user/{user}/show','UserController@show')->name('user.show')->middleware("permission:user.show");
//会员禁用
Route::get('user/{user}/disable','UserController@disable')->name('user.disable')->middleware("permission:user.disable");
//会员激活
Route::get('user/{user}/activating','UserController@activating')->name('user.activating')->middleware("permission:user.activating");


//权限路由
Route::resource('permission','PermissionController')->middleware("role:admin_super");
//角色路由
Route::resource('role','RoleController')->middleware("role:admin_super");

//菜单路由
Route::resource('menu','MenuController')->middleware("role:admin_super");

//测试路由
Route::get('/test',function (){
    dd(bcrypt(111111));
});