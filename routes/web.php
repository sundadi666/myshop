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





























































































































































// 进入 后台页面
Route::resource('admin','Admin\IndexController');

// 进入 前台页面
Route::resource('home','Home\IndexController');

