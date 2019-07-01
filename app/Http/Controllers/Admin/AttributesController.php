<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attributes;
use DB;

class AttributesController extends Controller
{
    // 商品属性添加 显示
    public function create(Request $request)
    {
    	// 获取商品id
    	$id = $request->input('id');
        //获取所有该id对应的属性数据
        $attributes_data = DB::table('attributes')->where('gid',$id)->get();
        //返回数据
        echo json_encode(['msg'=>'ok','attributes_data'=>$attributes_data]);
    }

    // 商品属性执行保存
    public function store(Request $request,$id)
    {
        // 接收 商品 型号 mid
        $mid = $request->input('mid');
    	// 接收商品id
    	$id = $id;
    	// 查找该商品id的属性
    	$attribute = Attributes::where('gid',$id)->where('id',$mid)->first();

    	// 接收商品id
    	$attribute->gid = $id;
    	// 接收商品属性值
    	$attribute->attr_val = $request->input('attr_val');
    	// 保存
    	$row = $attribute->save();

        if($row) {
            return redirect('admin/goods')->with('success','添加数据成功');
        } else {
            return back()->with('error','添加数据失败');
        }
    }
}
