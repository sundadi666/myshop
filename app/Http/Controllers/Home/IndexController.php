<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use App\Models\Navigates;
use App\Models\Links;
use App\Models\Brands;
use DB;

class IndexController extends Controller
{
   public static function getPidCatesData($pid = 0)
   {
        // 获取一级分类
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

        // 友情连接 的数据
        $links_data = Links::all();

        // 获取商品 的数据
        $branks_data = Brands::all();

        // dd($branks_data);

        foreach ($branks_data as $key => $value) {
            $branks_data[$key]['goods_data'] = DB::table('goods')->where('bid',$value->id)->paginate(4);  
        }

        // dd($branks_data);

        return view('home.index.index',['cates_data'=>$cates_data,'navigates_data'=>$navigates_data,'links_data'=>$links_data,'branks_data'=>$branks_data]);
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
