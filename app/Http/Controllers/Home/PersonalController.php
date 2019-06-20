<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users; 
use App\Models\Navigates;
class PersonalController extends Controller
{
    // 个人 详情 方法
    public function personalInfo(Request $request,$id)
    {
        $navigates_data = Navigates::all();
       
        // 获取用户的个人详情 信息
        $user_data = Users::find($id);
        // dd($user_data->usersinfos);
        // 加载 个人详情 页面
        return view('home.personal.info',['navigates_data'=>$navigates_data,'user_data'=>$user_data]);
    }
    /**
     * 个人中心 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $navigates_data = Navigates::all();
        // 判断 用户是否登录
        if(!session('home_login')){
            return redirect('/home/login')->with('error','请先登录');
        }
        // 获取 用户id
        $id = session('userinfo')->id;
        // 通过id 查找用户 详细信息
        $user = Users::find($id);
        
        // 显示 模板 将$user 分配模板
        return view('home.personal.index',['navigates_data'=>$navigates_data,'user'=>$user]);
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
