<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Models;
use App\Models\Sizes;

class SizesController extends Controller
{
    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
  	public function index(Request $request)
  	{
  		// $id = $request->input('id');
    //       //获取所有型号数据
    //       $models_data = new Models();
    //       $models_data->where('gid',$id)->get();
    //       dd($models_data);
  	}


    /**
       * 显示商品列表 
       *
       * @return \Illuminate\Http\Response
       */
    public function create(Request $request)
    {
      //获取商品id
    	$id = $request->input('id');
      //获取所有该id对应的型号数据
      $models_data = Models::where('gid',$id)->get();
      //返回数据
      echo json_encode(['msg'=>'ok','models_data'=>$models_data]);
    }

    /**
       * 商品大小 执行添加
       *
       * @return \Illuminate\Http\Response
       */
    public function store(Request $request,$id)
    {      
      // dd($request->all());
      //实例化商品大小 模型
      // $sizes = Sizes::find($id);
      $sizes = new Sizes();
      //商品id
      // $sizes->id = $id;
      //商品模型mid
      $sizes->mid = $request->input('mid');
      //商品大小名称sname
      $sizes->sname = $request->input('sname');
      //商品单价money
      $sizes->money = $request->input('money');
      //商品库存
      $sizes->inventory = $request->input('inventory');
      //保存
      $row = $sizes->save();

      if($row) {
        return redirect('admin/goods/index')->with('success','添加数据成功');
      } else {
        return back()->with('error','添加数据失败');
      }

    }
}
