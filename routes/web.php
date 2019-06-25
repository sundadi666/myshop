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






























































































































// 前台用户留言表单 路由
Route::get('home/addmsg','Home\ReplysController@create');


// 前台用户提交留言 路由
Route::resource('home/replys','Home\ReplysController');










// 前台列表页 查询 数据 路由
Route::get('home/list','Home\ListController@index');

// 前台列表页 显示 数据 路由
Route::get('home/list/index','Home\ListController@index');

// 前台商品详情页 显示 路由
Route::get('home/goods/details','Home\GoodsController@index');

// 前台获取 商品 大小
Route::get('home/goods/getsize','Home\GoodsController@getsize');













// 前台 加入购物车 路由
Route::get('home/carts/addcart','Home\CartsController@addCart');
// 前台 购物车 加1路由
Route::get('home/carts/jia','Home\CartsController@addnum');
// 前台 购物车 减1 路由
Route::get('home/carts/jian','Home\CartsController@jiannum');
// 前台 购物车 删除 路由
Route::get('home/carts/del','Home\CartsController@delete');
 
// 前台 购物车路由
Route::resource('home/carts','Home\CartsController');

// 前台 修改密码页面 路由
Route::get('home/personal/upass','Home\PersonalController@upass');
// 前台 修改密码 方法
Route::post('home/personal/updata_upass/{id}','Home\PersonalController@updata_upass');
// 前台 个人资料 路由
Route::get('home/personal/info/{id}','Home\PersonalController@personalInfo');
// 前台 个人中心 路由
Route::resource('home/personal','Home\PersonalController');

// 前台列表页 查询 数据 路由
Route::get('home/list','Home\ListController@index');

// 前台列表页 显示 数据 路由
Route::get('home/list/index','Home\ListController@index');

// 前台商品详情页 显示 路由
Route::get('home/goods/details','Home\GoodsController@index');

// 前台 登陆 路由
Route::resource('home/login','Home\LoginController');

// 前台 退出 路由
Route::get('home/logout','Home\LoginController@logout');

// 前台 登陆验证路由
Route::post('home/login/login','Home\LoginController@login');

// 前台 激活 用户(邮箱) 路由
Route::get('home/register/chengeStatus/{id}/{token}','Home\RegisterController@chengeStatus');

// 前台 邮箱 注册 路由
Route::post('home/register/email','Home\RegisterController@email');

// 前台 手机验证码 路由
Route::post('home/register/phone','Home\RegisterController@phone');

// 前台 手机 邮箱 注册路由
Route::resource('home/register','Home\RegisterController');



// 后台 登陆 路由
Route::get('admin/login','Admin\LoginController@login');

// 后台 退 出 路由
Route::get('admin/logout','Admin\LoginController@logout');

// 后台 登陆验证路由
Route::post('admin/dologin','Admin\LoginController@dologin');


// 后台 登陆中间件
Route::group(['middleware'=>'login'],function(){

   // 进入 后台页面
   Route::get('admin','Admin\IndexController@index');

   // 商品推荐 路由
   Route::get('admin/goods/setRecommend/{id}','Admin\GoodsController@setRecommend');

   // 商品大小显示页面 路由
   Route::get('admin/sizes/create/{id}','Admin\SizesController@create');

   // 商品大小执行添加 路由
   Route::post('admin/sizes/store','Admin\SizesController@store');

   // 后台用户留言列表 显示 路由
   Route::get('admin/replys/index','Admin\ReplysController@index');

   // 后台查看用户留言详情 路由
   Route::get('admin/replys/{id}','Admin\ReplysController@show');

   // 后台查看用户留言详情 路由
   Route::get('admin/replys','Admin\ReplysController@index');

   // 后台 修改 管理员密码 路由
   Route::post('admin/users/update_upass/{id}','Admin\UsersController@update_upass');
   // 后台 修改 管理员 头像 路由
   Route::post('admin/users/update_profile/{id}','Admin\UsersController@update_profile');

   // 后台 修改 用户状态 路由
   Route::get('admin/users/status/{id}','Admin\UsersController@status');

   //  后台用户 路由
   Route::resource('admin/users','Admin\UsersController');

   // 后台 底部 路由
   Route::resource('admin/footer','Admin\FooterController');


   

   // 友情链接
   Route::resource('admin/links','Admin\LinksController');

   // 导航
   Route::resource('admin/navicates','Admin\NavigatesController');

   // 分类
   Route::resource('admin/cates','Admin\CatesController');

   // 品牌
   Route::resource('admin/brands','Admin\BrandsController');


   // 订单
   Route::resource('admin/orders','Admin\OrdersController');


   // 公告列表 路由
   Route::resource('admin/news','Admin\NewsController');

   // 商品列表 路由
   Route::resource('admin/goods','Admin\GoodsController');



   // 商品型号添加 路由
   Route::resource('admin/models','Admin\ModelsController');

   //轮播图 路由
   Route::resource('admin/banners','Admin\BannersController');


});









































Route::resource('/','Home\IndexController');

// 进入 前台页面
Route::resource('home','Home\IndexController');

