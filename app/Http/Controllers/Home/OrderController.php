<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Users;
use App\Models\Footer;
use DB;
use App\Http\Controllers\Home\CartsController;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // 判断 用户 是否登录
        if (!session('home_login')) {
            return redirect('home/login');
        }

        $id = session('userinfo')->id;

         // 通过id 查找用户 详细信息
        $user = Users::find($id);

          // 获取 购物车 数量
        $num = CartsController::getNum();

        // 查询 订单表里面的数据
        $order_data = Orders::get();

          // 获取 网站底部 数据
        $footer_data = Footer::first();

        return view('home.orders.index',['order_data'=>$order_data,'user'=>$user,'num'=>$num,'footer_data'=>$footer_data]);
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
