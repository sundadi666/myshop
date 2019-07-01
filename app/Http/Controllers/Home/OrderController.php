<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use DB;
use App\Models\Links;
use App\Models\Footer;
use App\Models\Navigates;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // 查询 订单表里面的数据
        $order_data = Orders::get();

        // 友情连接 的数据
        $links_data = Links::all();

        // 获取 网站底部 数据
        $footer_data = Footer::first();

        // 获取 导航栏 数据
        $navigates_data = Navigates::all();


        return view('home.orders.index',['navigates_data'=>$navigates_data,'footer_data'=>$footer_data,'links_data'=>$links_data,'order_data'=>$order_data]);

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        DB::beginTransaction();

        $orders_info_res = DB::table('orders_info')->where('oid',$id)->delete();
    
        $orders_res = DB::table('orders')->where('id',$id)->delete();

        if($orders_info_res && $orders_res){

            echo "ok";
            DB::commit();
        }else {
            DB::rollBack();
        }

    }
}
