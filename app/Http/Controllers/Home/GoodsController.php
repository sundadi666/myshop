<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Sizes;

class GoodsController extends Controller
{
    //获取商品详情 
    public function index(Request $request)
    {

    	// 获取商品分类id
    	$gid = $request->input('gid');
    	//
    	$goods = Goods::find($gid);
    	
    	// dd($goods);

    	return view('home.goods.details',['goods'=>$goods]);

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
}
