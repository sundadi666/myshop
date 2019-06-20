<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use DB;
use Hash;
class LoginController extends Controller
{
    // 登陆 页面
   	public function login()
   	{ 
   		// 显示 登陆模板
   		return view('admin.login.login');
   	}
   	// 登陆 验证 方法
   	public function dologin(Request $request)
   	{
   		// 获取 参数
   		$uname = $request->input('uname');
   		$upass = $request->input('upass');
   		// 从数据库获取用户信息 
   		$user = DB::table('users')->where('uname',$uname)->first();
   		
    	//判断验证
    	if(empty($user->uname)){
    		 echo json_encode(['msg'=>'err','info'=>'用户名或密码错误']);
    		exit;
    	}

    	if (!Hash::check($upass, $user->upass)) {
    	// 密码对比...
     	    echo json_encode(['msg'=>'err','info'=>'用户名或密码错误']);
     	    exit;
		}
		//登陆
    	session(['admin_login'=>true]);
    	session(['userinfo'=>$user]);

	   echo json_encode(['msg'=>'ok','info'=>'登陆成功']);
   	}
}
