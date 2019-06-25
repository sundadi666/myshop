<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Addrs;

class AddrsController extends Controller
{
    /**
     * 显示 用户的 收货地址
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // 判断 用户 是否登录
        if (!session('home_login')) {
            return redirect('home/login');
        }

        $id = session('userinfo')->id;

        $addrs_data = Addrs::where('uid',$id)->get();

        // dd($addrs_data);

        return view('home.addrs.index',['addrs_data'=>$addrs_data]);
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
     * 保存要用户的 收货地址
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addrs = new Addrs;

        // 接收 数值
        $addrs->uname = $request->input('uname','');
        $addrs->uid   = $request->input('uid','');
        $addrs->phone = $request->input('phone','');
        $addrs->province = $request->input('province','');
        $addrs->ctiy  = $request->input('ctiy','');
        $addrs->area  = $request->input('area','');
        $addrs->details = $request->input('details','');

        // 执行插入
        $res = $addrs->save();

        if($res){
            return back()->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
     * 删除用户的地址
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // 执行 删除命令
        $res = Addrs::destroy($id);
        
        // 判断 是否 执行成功
        if ($res) {
            echo "ok";  
        } else {
            echo "error";
        }
    }
}
