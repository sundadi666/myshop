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

/*
   路由使用的位置
   			开始行 - 结束行
   公共路由:
   			25 - 75
   孙:
			   76 - 126
   刘:
   			127 - 177
   彭:
   			178 - 228		
 */

Route::get('/', function () {
    return view('welcome');
});
















































// 友情链接
Route::resource('admin/links','Admin\LinksController');

// 导航
Route::resource('admin/navicates','Admin\NavigatesController');









































































// 公告列表 路由
Route::resource('admin/news','Admin\NewsController');

// 商品列表 路由
Route::resource('admin/goods','Admin\GoodsController');


























































// 前台 激活 用户(邮箱) 路由
Route::get('home/register/chengeStatus/{id}/{token}','Home\RegisterController@chengeStatus');

// 前台 邮箱 注册 路由
Route::post('home/register/email','Home\RegisterController@email');
// 前台 手机验证码 路由
Route::post('home/register/phone','Home\RegisterController@phone');
// 前台 手机 邮箱 注册路由
Route::resource('home/register','Home\RegisterController');



//修改激活
Route::get('admin/users/status','Admin\UsersController@status');

//  后台用户 路由
Route::resource('admin/users','Admin\UsersController');

// 后台 底部 路由
Route::resource('admin/footer','Admin\FooterController');









































// 进入 后台页面
Route::resource('admin','Admin\IndexController');

// 进入 前台页面
Route::resource('home','Home\IndexController');

