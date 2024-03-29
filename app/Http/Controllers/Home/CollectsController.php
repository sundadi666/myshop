<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collects;
use App\Models\Users;
use App\Models\Navigates;
use App\Models\Links;

class CollectsController extends Controller
{
    // 显示 收藏夹 页面
    public function index()
    {	
    	 // 判断 是否登录   
        if(!session('home_login')){
            return redirect('/home/login')->with('请先登录');
            exit;
        }
        
    	// 获取该用户id
    	$uid = session('userinfo')->id;
    	// 获取该用户信息
    	$user = Users::where('id',$uid)->first();

    	// 获取 导航栏 数据
        $navigates_data = Navigates::all();

         // 友情连接 的数据
        $links_data = Links::all();

    	return view('home.collects.index',['links_data'=>$links_data,'user'=>$user,'navigates_data'=>$navigates_data]);
    }
}
