<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Models;

class ModelsController extends Controller
{
    //
    public function store(Request $request)
    {
    	// $models = new Models();
    	//接收商品id
    	$id = $request->input('id');
    	//接收商品型号名称
    	$mnames = $request->input('mname');
    	//去除两边多余逗号
    	$mnames = trim($mnames, ',');
    	//把字符串转为数组
    	$mname_arr = explode(',', $mnames);
    	//循环插入数据库
    	// dd($mname_arr);
    	foreach($mname_arr as $k=>$v) {
    		//实例化模型
    		$models = new Models();
    		$models->gid = $id;
    		$models->mname = $v;
    		//添加数据
    		$models->save();
    	}

    	return redirect('admin/goods')->with('success','添加数据成功');
    }
}
