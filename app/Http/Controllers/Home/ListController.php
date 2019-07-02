<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Http\Controllers\Home\CartsController;
use App\Models\Footer;
use App\Models\Ordersinfo;
use App\Models\Navigates;
use App\Models\Links;
use DB;

class ListController extends Controller
{
    /**
     *  显示列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $cid = $request->input('cid','');

        $goods = Goods::where('cid',$cid)->get();

        $keywords = $request->input('keywords','');
        if($cid) {
            // 根据分类查询商品
            $goods = Goods::where('cid',$cid)->paginate(2);
        } else {
            // 根据 搜索关键字搜索商品
            $goods = Goods::where('title','like','%'.$keywords.'%')->paginate(2);
        }
        // 定义一个商品数据空数组
        $goods_data = [];
        foreach($goods as $k=>$v) {
            // 计算出每条商品的销量 赋值
            $v->nums = Ordersinfo::where('gid', $v->id)->sum('nums');
            // 保存到 新数组
            $goods_data[] = $goods[$k]; 
        }


         // 获取 购物车 数量
        $num = CartsController::getNum();
         // 获取 网站底部 数据
        $footer_data = Footer::first();

        // 获取 导航栏 数据
        $navigates_data = Navigates::all();

        // 友情连接 的数据
        $links_data = Links::all();
        
        return view('home.list.index',['links_data'=>$links_data,'navigates_data'=>$navigates_data,'goods'=>$goods,'goods_data'=>$goods_data,'num'=>$num,'footer_data'=>$footer_data,'cid'=>$cid,'keywords'=>$keywords]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
    