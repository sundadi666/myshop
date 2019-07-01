<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Collects;
use App\Models\Users;

class CollectsController extends Controller
{
    // 显示 收藏夹 页面
    public function index()
    {
    	// 获取该用户id
    	$uid = session('userinfo')->id;
    	// 获取该用户信息
    	$user = Users::where('id',$uid)->first();

    	return view('home.collects.index',['user'=>$user]);
    }
}
