<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use App\Models\Navigates;
use App\Models\Links;
use App\Models\Brands;
use App\Models\Banners;
use App\Models\Footer;
use App\Models\Seckill;
use App\Models\Goods;
use DB;
use App\Http\Controllers\Home\CartsController;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
   public static function getPidCatesData($pid = 0)
   {

        // 获取一级分类
        // $data = Cates::where('pid',$pid)->get();
        $data = DB::table('cates')->where('pid',$pid)->get();
        // dd($data);
        $data = Cates::where('pid',$pid)->get();

        foreach ($data as $k => $v) {

            $v->sub = self::getPidCatesData($v->id);
            
        }

        return $data;

   }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // 导航条 的数据
        $navigates_data = Navigates::all();

        // 获取 分类 的数据
        $cates_data = self::getPidCatesData(0);


      // //判断redis里是否有值
      // if(Redis::exists('cates_redis_data')){
      //   $cates_data = json_decode(Redis::get('cates_redis_data'));
      // }else{
      //         //栏目
      //    $cates_data = self::getPidCatesData(0);
      //    //把数组转为字符串
      //    $cates_data_str = json_encode($cates_data);
      //    //压入到redis中
      //    Redis::setex('cates_redis_data',600,$cates_data_str);

      // }


        // 友情连接 的数据
        $links_data = Links::all();

        // 获取商品 的数据
        $branks_data = Brands::all();

        foreach ($branks_data as $key => $value) {
            $branks_data[$key]['goods_data'] = DB::table('goods')->where('bid',$value->id)->paginate(4);  
        }

        // 轮播图数据
        $banners_data = Banners::all();

        // 今日推荐
        $recommends = DB::table('goods')->where('is_recommend','=','1')->select('id','cid','goods_info_top','goods_info_bottom','img')->get();
        // dd($recommends);
         // 获取 购物车 数量
        $num = CartsController::getNum();
         // 获取 网站底部 数据
        $footer_data = Footer::first();

        // 获取 秒杀信息
        $seckills_data = Seckill::get();

        // dd($seckills_data[0]->time);
        
        // 秒杀 信息 的id
        $seckill_id = $seckills_data[0]->id;


        $seckill_goods_data = Goods::where('sec_id',$seckill_id)->paginate(4);

        // dd($seckill_goods_data);
        
        return view('home.index.index',['seckill_goods_data'=>$seckill_goods_data,'seckills_data'=>$seckills_data[0]->time,'cates_data'=>$cates_data,'navigates_data'=>$navigates_data,'banners_data'=>$banners_data,'recommends'=>$recommends,'links_data'=>$links_data,'branks_data'=>$branks_data,'num'=>$num,'footer_data'=>$footer_data]);
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
