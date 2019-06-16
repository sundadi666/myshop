<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use Image;

class GoodsController extends Controller
{
    /**
     * 显示商品列表 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.goods.create');
    }

    /**
     * 商品数据 添加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //接收商品数据
        $goods = new Goods();
        // $goods->title = $request->input('abc');
        //执行 商品数据 添加
        //接收图片
        // if($request->hasFile('img')) {
        //     $path = $request->file('img')->store('uploads');
        // }
        //压缩图片
        $img = Image::make('img')->resize(200, 200);
        dd($img);
        $goods->title = $request->input('title');
        $goods->desc = $request->input('desc');
        $goods->goods_status = $request->input('goods_status');
        $goods->cid = $request->input('cid');
        $goods->bid = $request->input('bid');
        $row = $goods->save();
        //返回受影响行数
        if($row) {
            return redirect('admin/news')->with('success','添加数据成功');
        } else {
            return back()->with('error','添加数据失败');
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
}
