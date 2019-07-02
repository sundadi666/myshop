<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Seckill;

class SeckillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $seckill_data = Seckill::all();


        // 显示 秒杀 商品
        return view('admin.seckill.index',['seckill_data'=>$seckill_data]);
    }

    /**
     * 显示 秒杀页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.seckill.create');
    }

    /**
     * 添加 秒杀活动
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $time=$request->input('time','');

        $time=str_replace("T"," ",$time);

        $seckill = new Seckill();

        $seckill->time = $time;
        
        // 保存到 数据库
        $res = $seckill->save();

        // 判断是否 添加成功
        if($res){
            return redirect('/admin/seckill')->with('success','添加成功');
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
        $res = Seckill::destroy($id);

        if($res){
            echo "ok";
        }

    }
}
