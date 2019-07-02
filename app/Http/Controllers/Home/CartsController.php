<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use App\Models\Models;
use App\Models\Sizes;
use App\Models\Footer;
use App\Models\Links;
use DB;
class CartsController extends Controller
{
    /**
     * 购物车 列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!session('home_login')){
            return redirect('/home/login')->with('请先登录');
            exit;
        }
        $uid = session('userinfo')->id;
        // dd($uid);
        // 获取 购物车数据 
        $cart_data = DB::table('carts')->where('uid',$uid)->orderBy('created_at','desc')->paginate(5);
        // 获取 网站底部 数据
        $footer_data = Footer::first();

         // 友情连接 的数据
        $links_data = Links::all();

        // 显示 购物车页面
        return view('home.carts.index',['links_data'=>$links_data,'cart_data'=>$cart_data,'num'=>self::getNum(),'zongjia'=>self::getZongjia(),'footer_data'=>$footer_data]);
 
      
        
    }

    // 商品+1 方法
    public function addnum(Request $request)
    {
        // 接收购物车id
        $id = $request->input('id');
       // 获取 购物车数据库 数量
       $cart_num = DB::table('carts')->where('id',$id)->select('nums','price','xiaoji')->first();
         // 判断 购物车是否有值,空 就返回
        if(empty($cart_num)){
            echo 'err';
            exit;
        }else{
             // 将数量加1 在赋值给数量
            $cart_num->nums = $cart_num->nums+1;
             // 将新的数量乘上单价赋值给小计
            $cart_num->xiaoji = ($cart_num->nums*$cart_num->price);

            // 把最后修改的数据保存到数据库
           $res = DB::table('carts')->where('id',$id)->update(['nums'=>$cart_num->nums,'xiaoji'=>$cart_num->xiaoji]);
           if($res){
             echo json_encode(['msg'=>'ok', 'zongjia'=>self::getZongjia(),'num'=>self::getNum()]);
             
         }else{
            echo 'err';
            exit;
         }
         
          
        }
    }
    // 商品减 1 方法
    public function jiannum(Request $request)
    {
        // 接收购物车id
        $id = $request->input('id');
        // 获取 购物车数据库 数量
       $cart_num = DB::table('carts')->where('id',$id)->select('nums','price','xiaoji')->first();
        // 判断 购物车是否有值,空 就返回
        if(empty($cart_num)){
             echo 'err';
             exit;
        }else{
            // 如果购物车数量<1 就不让减1 直接返回
            if($cart_num->nums<=1){
             echo 'err';
             exit;
            }
            // 将数量减1 在赋值给数量
            $cart_num->nums = $cart_num->nums-1;
            // 将减去的数量乘上单价赋值给小计
            $cart_num->xiaoji = ($cart_num->nums*$cart_num->price);
            // 把最后修改的数据保存到数据库
            DB::table('carts')->where('id',$id)->update(['nums'=>$cart_num->nums,'xiaoji'=>$cart_num->xiaoji]);
            echo json_encode(['msg'=>'ok', 'zongjia'=>self::getZongjia(),'num'=>self::getNum()]);
          
        }
    }
    // 购物车 删除商品
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $res = DB::table('carts')->where('id',$id)->delete();
        if($res){
            echo 'ok';
        }else{
            echo 'err';
        }
    }
    // 封装 静态 总数量
    public static function getNum()
    {
        // 判断 是否登录 获取uid
        if(!session('home_login')){
            return redirect('/home/login')->with('请先登录');
            exit;
        }
        $uid = session('userinfo')->id;
        // dd($uid);
        // 获取 购物车数据 goods
        $cart_data = DB::table('carts')->where('uid',$uid)->get();
        $num = 0;
      
       foreach($cart_data as $k=>$v){
        $num += $v->nums;
      
       }
       return $num;
    }
     // 封装 静态 总价
     public static function getZongjia()
    {
        // 判断 是否登录 获取uid
        if(!session('home_login')){
            return redirect('/home/login')->with('请先登录');
            exit;
        }
        $uid = session('userinfo')->id;
        // dd($uid);
        // 获取 购物车数据 goods
        $cart_data = DB::table('carts')->where('uid',$uid)->get();
       
        $zongjia = 0;
       foreach($cart_data as $k=>$v){

        $zongjia += $v->xiaoji;
       
       }
       return $zongjia;
    }

    // 加入 购物车 方法
    public function addCart(Request $request)
     {
           
            // 获取当前登录 用户uid
            if(!session('home_login')) {
                echo json_encode(['msg'=>'err','info'=>'!亲!~~您还未登录~']);
                exit;
            }
            // 获取uid
            $uid = session('userinfo')->id;
            // 获取商品 id
            $id = $request->input('id');
            $mid = $request->input('mid');
            $sid = $request->input('sid');
            $price = $request->input('price');
            $nums = $request->input('nums');
            $xiaoji = $request->input('xiaoji');
            $imgs = $request->input('imgs');
            $title = $request->input('title');
            $created_at = date('Y-m-d H:i:s',time());
            // $_SESSION['cart'] = NULL;
            // exit;
            // $_SESSION['cart'][$id] = $request->all();
            // dump($_SESSION);exit;
           // 将接收的数据 添加到 数据库中
        
                     
            // $data = DB::table('carts')->insert(['gid'=>$id,'uid'=>$uid,'mid'=>$mid,'sid'=>$sid,'price'=>$price,'nums'=>$nums,'xiaoji'=>$xiaoji,'imgs'=>$imgs,'title'=>$title]);
        
            $data = DB::table('carts')->insert(['gid'=>$id,'uid'=>$uid,'mid'=>$mid,'sid'=>$sid,'price'=>$price,'nums'=>$nums,'xiaoji'=>$xiaoji,'imgs'=>$imgs,'title'=>$title,'created_at'=>$created_at]);
           
           // 判断 是否成功
          if($data){
            echo json_encode(['msg'=>'ok','info'=>'加入购物车成功']);
          }else{
            echo json_encode(['msg'=>'err','info'=>'加入购物车失败']);
          }
        
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
}
