<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;

class GoodsController extends Controller
{
    //获取商品详情 
    public function index(Request $request)
    {

    	// 获取商品分类id
    	$gid = $request->input('gid');
    	//
    	$goods = Goods::find($gid);

    	return view('home.goods.details',['goods'=>$goods]);

    }	
}
