<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Navigates;
use App\Models\Replys;

class ReplysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示添加留言表单
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $navigates_data = Navigates::all();
        return view('home.replys.create',['navigates_data'=>$navigates_data]);
    }

    /**
     * 保存前台用户 留言
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 前台用户uid
        $uid = 3;
        // 前台用户商品gid
        $gid = 10;

        $reply = new Replys;
        // 保存uid
        $reply->uid = 3;
        // 保存商品gid
        $reply->gid = 10;
        // 保存留言内容
        if(!$request->input('content')) {
            return back()->with('error')
        }
        $reply->content = $request->input('content');
        // 执行 保存
        $row = $reply->save();

        
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
    