<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Footer;
class PaysuccessController extends Controller
{
    /**
     * 订单支付 成功 跳到这里
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        
        $data = $_SESSION['carts'];

        // // 清除 购物车的session
        // $_SESSION['cart'] = NULL;

        // // 清除 用户 的session
        // $_SESSION['carts'] = NULL;

        // dump($data['user']['addrs']->uname);die;


          // 获取 网站底部 数据
        $footer_data = Footer::first();

        return view('home.pay.success',['data'=>$data,'footer_data'=>$footer_data]);
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
        //
    }

    public function clearsession()
    {
         // 清除 购物车的session
        $_SESSION['cart'] = NULL;

        // 清除 用户 的session
        $_SESSION['carts'] = NULL;
    }


}
