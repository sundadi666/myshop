<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class LoginController extends Controller
{
    /**
     * 前台 登陆 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 显示 登陆 模板
         return view('home.login.index');
    }

       //  登陆 验证 方法
    public function login(Request $request)
    {
     // dump($request->all());
     $data = $request->input('login');
     $upass = $request->input('upass');
     // 正则 匹配 用户名 邮箱 手机
     $uname = '/^[a-zA-Z]{1}[\w]{5,17}$/';
     $email = '/^[\w]+@[\w]+\.[\w]+$/';
     $phone = '/^1{1}[3-8]{1}[\d]{9}$/';


     // 判断输入框的内容
     if(preg_match($email, $data)){
        
        $user_data = DB::table('users')->where('email',$data)->first();        
          //判断用户名是否存在
        if(empty($user_data->email)){
            echo json_encode(['msg'=>'error','info'=>'邮箱不存在']);
            exit;
        }


        // 判断 密码是否一致
        if (!Hash::check($upass, $user_data->upass)) {
            echo json_encode(['msg'=>'err','info'=>'邮箱或密码不正确']);
             exit;
        }

     } else if(preg_match($phone, $data)){
         $user_data = DB::table('users')->where('phone',$data)->first();
           // 判断 手机是否存在
           if(empty($user_data->phone)){
            echo json_encode(['msg'=>'error','info'=>'手机号不存在']);
            exit;
        }

        // 判断 密码是否一致
        if (!Hash::check($upass, $user_data->upass)) {
            echo json_encode(['msg'=>'err','info'=>'手机号或密码不正确']);
             exit;
        }
     } else if(preg_match($uname, $data)){
        $user_data = DB::table('users')->where('uname',$data)->first();
        
         // 判断 手机是否存在
           if(empty($user_data->uname)){
            echo json_encode(['msg'=>'error','info'=>'用户名不存在']);
            exit;
        }

        // 判断 密码是否一致
        if (!Hash::check($upass, $user_data->upass)) {
            echo json_encode(['msg'=>'err','info'=>'用户名或密码不正确']);
            exit;
        }
     }

            //session 压入session
            session(['home_login'=>true]);
            session(['userinfo'=>$user_data]);
            echo json_encode(['msg'=>'ok','info'=>'登陆成功']);
    }


    // 前台 退出 方法
    public function logout()
    {
         // 将 session 值 设为null
        session(['home_login'=>false]);
        session(['userinfo'=>false]);
        return redirect('home');
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
