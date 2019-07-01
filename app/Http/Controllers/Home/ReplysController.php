<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Replys;
use App\Models\Users;
use App\Models\Goods;
use App\Models\Ordersinfo;
use App\Models\Footer;
class ReplysController extends Controller
{
    // 我的评论 列表页 显示
    public function index()
    {
        // 获取当前用户id
        $uid = session('userinfo')->id;

        // 查询当前用户信息
        $user = Users::find($uid);

        return view('home.replys.index',['user'=>$user]);
    }

    // 留言 表单 显示
    public function create($id,$oid)
    {
    	// 获取商品id
    	$gid = $id;

        // 接收订单详情id
        $oid = $oid;

        $orderinfo = Ordersinfo::find($oid);

         // 获取当前用户id
        $uid = session('userinfo')->id;

        // 查询当前用户信息
        $user = Users::find($uid);

         // 获取 网站底部 数据
        $footer_data = Footer::first();
    	return view('home.replys.create',['footer_data'=>$footer_data,'user'=>$user,'gid'=>$gid,'orderinfo'=>$orderinfo]);
    }

    // 执行 保存 留言 
    public function store(Request $request)
    {
    	// 执行添加评价
    	$reply = new Replys();
    	// 商品id
    	$reply->gid = $request->input('gid');
    	// 用户id
    	$reply->uid = session('userinfo')->id;
    	// 用户评论
    	$reply->content = $request->input('content');

    	$row = $reply->save();

    	if($row) {
    		return redirect('/home/order');
    	}

    }

}
