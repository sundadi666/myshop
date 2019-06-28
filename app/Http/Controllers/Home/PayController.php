<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Addrs;
use App\Models\Carts;
use App\Models\Orders;
use DB;

class PayController extends Controller
{
    /**
     * 显示 支付页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // 判断 是否登录   
        if(!session('home_login')){
            return redirect('/home/login')->with('请先登录');
            exit;
        }

        // 获取 当前用户的id
        $uid = session('userinfo')->id;

        // 获取 用户 收货地址 信息
        $addrs_data = Addrs::where('uid',$uid)->get();

        // 获取 用户 购物车 信息
        $carts_data = Carts::where('uid',$uid)->get();
        
        foreach ($carts_data as $k => $v) {
            $_SESSION['cart'][$v->gid][$v->mid][$v->sid] = json_encode($v);    
        }

        foreach ($carts_data as $k => $v) {
            $carts_data_encode[$v->gid][$v->mid][$v->sid] = json_decode($_SESSION['cart'][$v->gid][$v->mid][$v->sid]);    
        }
        // 查询 用户的默认地址
        $addrs_default_data = DB::table('addrs')->where('uid',$uid)->where('default',1)->first();
            
        
        // 查询 模型 所有的数据
        $models_data = DB::table('models')->get();

        foreach ($models_data as $k => $v) {
            $models_data_id[$v->id]=$v->mname;
        }

        // 查询 大小 所有的数据
        $size_data = DB::table('sizes')->get();

        foreach ($size_data as $k => $v) {
            $size_data_id[$v->id]=$v->sname;
        }


        return view('home.pay.index',['size_data_id'=>$size_data_id,'addrs_data'=>$addrs_data,'carts_data'=> $carts_data_encode,'addrs_default_data'=>$addrs_default_data,'models_data_id'=>$models_data_id]);
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
     * 保存 订单
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        DB::beginTransaction();
        // 判断 是否登录   
        if(!session('home_login')){
            return redirect('/home/login')->with('请先登录');
            exit;
        }

        // 获取 当前用户的id
        $uid = session('userinfo')->id;

        // 查询 该用户的 余额
        $user_data = DB::table('users')->where('id',$uid)->first();
        
        // 用户的 金额 减去 购买的 商品的总价
        $user_money = $user_data->money;

        // 减去用户金额
        $user_money -= $_SESSION['carts']['user']['money']; 
        
        // dump(gettype($user_money));die;

        $user_money_res = DB::table('users')->where('id',$uid)->update(['money'=>$user_money]);

        // 判断 是否 支付成功
        if(!$user_money_res){
            echo "<script>alert('支付失败');location.href='/home/pay'</script>";
            exit;
        }


        // 接收 订单的全部信息
        
        $data['oid'] = time()+rand(123456789,987654321);
        $data['uid'] = $uid;
        $data['price'] = $_SESSION['carts']['user']['money'];
        $data['logistics'] =time()+rand(1234,9876);
        $data['aid'] =  $_SESSION['carts']['user']['addrs']->id;
        $data['time'] =  date('Y-m-d H:i:s');


        // 将数据 插入到 order 表中 返回的 是插入的id数值
        $res_orders_id = DB::table('orders')->insertGetId($data);  

        // 获取 用户 购物车 信息
        $carts_big_data = Carts::where('uid',$uid)->get();

        foreach ($carts_big_data as $k => $v) {
            $carts_data[$v->gid][$v->mid][$v->sid] = json_decode($_SESSION['cart'][$v->gid][$v->mid][$v->sid]);    
        }

        // 将 多条 数据 插入到 orders_info 表中
        foreach ($carts_data as $k => $v) {
            foreach ($v as $kk => $vv) {
                foreach ($vv as $kkk => $vvv) {
                    $orderinfo_data['oid'] = $res_orders_id;
                    $orderinfo_data['gid'] = $vvv->gid;
                    $orderinfo_data['mid'] = $vvv->mid;
                    $orderinfo_data['sid'] = $vvv->sid;
                    $orderinfo_data['xiaoji'] = $vvv->xiaoji;
                    $orderinfo_data['price'] = $vvv->price;
                    $orderinfo_data['nums'] = $vvv->nums;
                        
                    $orderinfo_res = DB::table('orders_info')->insert($orderinfo_data);
                }
            }
        }


        // 判断 是否 同时插入成功
        if($orderinfo_res && $res_orders_id){


            // 删除 该用户在 购物车表中的 数据
            foreach($carts_big_data as $k=>$v){
                DB::table('carts')->where('uid',$uid)->delete();
            }

            DB::commit();
            return redirect('home/paysuccess');
        } else {
            DB::rollBack();
        }

                   
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

    // 接收 该订单的总价
    public function zong(Request $request)
    {   
        // 判断 是否登录   
        if(!session('home_login')){
            return redirect('/home/login')->with('请先登录');
            exit;
        }

        // 获取 当前用户的id
        $uid = session('userinfo')->id;

        // 接收到 订单 总价格
        $money = $request->input('money');
        
        // 查到 收货地址
        $addrs_default_data = DB::table('addrs')->where('uid',$uid)->where('default',1)->first();

        // 保存到 session
        $_SESSION['carts']['user']['money'] = $money;
        $_SESSION['carts']['user']['addrs'] = $addrs_default_data;


        // echo json_decode($_SESSION['carts']);

    }
}
