<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Sizes;
use App\Models\Collects;
use App\Models\Footer;

class GoodsController extends Controller
{
    //获取商品详情 
    public function index(Request $request)
    {
    	// dd(session(['home_login'=>true]));
    	// 获取商品分类id
    	$gid = $request->input('gid');
    	
    	$goods = Goods::find($gid);
    	
    	//    


            if(session('home_login')) {
                $_SESSION['user_id'] = session('userinfo')->id;

                // dd($_SESSION['user_id']);

                // 查询该用户是否收藏过该商品
                $user_collect = Collects::where('uid',$_SESSION['user_id'])->where('gid',$gid)->first();

                // dd($user_collect);

                if(!$user_collect) {
                    $_SESSION['is_collect'] = null;

                    // dd($_SESSION['is_collect']);
                } else if($_SESSION['user_id'] == $user_collect->uid) { // 判断当前登录用户id 和 收藏表用户的id是否 一致
                    // 压入session
                    // session(['is_collect'=>true]);
                    $_SESSION['is_collect'] = true;
                } 
            }

        // 获取 网站底部 数据
        $footer_data = Footer::first();

    	return view('home.goods.details',['goods'=>$goods,'footer_data'=>$footer_data]);

    }	

    // 前台 商品 大小
    public function getSize(Request $request)
    {
    	// 接收 型号 id
    	$id = $request->input('id');
    	// 所有商品 大小
    	$sizes = Sizes::where('mid',$id)->get();

    	if($sizes) {
    		echo json_encode($sizes);
    	} else {
    		echo json_encode(['msg'=>'该商品没有大小']);
    	}
    }

    // 前台 商品 收藏
    public function addLike(Request $request)
    {
        // session('is_collect',null);
        // die;
        // dd($request->session()->has('is_collect'));

    	// 获取当前登录 用户id
    	if(!session('home_login')) {
    		echo json_encode(['msg'=>'err','info'=>'您还未登录~']);
    		exit;
    	}

    	// // 获取 商品 标题
    	// $title = $request->input('title');

    	// // 获取 商品 价格
    	// $price = $request->input('');

        // 获取商品id
        $gid = $request->input('id');

        // 获取用户 id
        $uid = session('userinfo')->id;

        // dd($uid);

        // 查询该用户id 和 已收藏过该商品的id
    	$collect = Collects::where('uid',$uid)->where('gid',$gid)->first();

        // dd($collect);
        if(!$collect) {
            // 该用户未收藏该商品
            $collect = new Collects();
            $collect->gid = $request->input('id');
            $collect->uid = session('userinfo')->id;

            $_SESSION['is_collect'] = true;

            // dd($_SESSION['is_collect']);

            // 把当前用户id压入session
            $_SESSION['user_id'] = $uid;

            // dd($_SESSION['user_id']);

            $row = $collect->save();
            // dd($row);
            echo json_encode(['msg'=>'ok','info'=>'已收藏']);
        }
    }

    public function cancelLike(Request $request)
    {
        // // 获取 商品 标题
        // $title = $request->input('title');

        // // 获取 商品 价格
        // $price = $request->input('');

        // 获取商品id
        $gid = $request->input('id');

        // 获取用户 id
        $uid = session('userinfo')->id;

        // 查询该用户id 和 已收藏过该商品的id
        $collect = Collects::where('uid',$uid)->where('gid',$gid)->first();

        if($collect) {
            // 该用户已收藏该商品
            $_SESSION['is_collect'] = null;

            // dd($_SESSION['is_collect']);

            Collects::where('uid','=',$uid)->where('gid','=',$gid)->delete();

            echo json_encode(['msg'=>'ok','info'=>'已取消收藏']);
        }
    }

    // 根据 所选商品大小设置对应价格
    public function getMoney(Request $request)
    {
        // 获取该商品大小id
        $id = $request->input('id');
        // 根据大小id 查询 价格
        $money = Sizes::find($id);

        if($money) {
            // 获取价格 成功
            echo json_encode(['msg'=>'ok','val'=>$money]);
        }
    }
}
