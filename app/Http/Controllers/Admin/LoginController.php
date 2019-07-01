<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\UsersInfos;
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
   		$user = DB::table('admin_users')->where('uname',$uname)->first();  		
    	//判断验证
    	if(empty($user->uname)){
    		 echo json_encode(['msg'=>'err','info'=>'用户名或密码错误']);
    		 exit;
    	}
        // 密码对比...
    	if (!Hash::check($upass, $user->upass)) {   	
     	    echo json_encode(['msg'=>'err','info'=>'用户名或密码错误']);
     	    exit;
		}
  
	    // 登陆 压入session 为 true
    	session(['admin_login'=>true]); 
      // 把 用户表里值压入 session1中
      session(['admin_userinfo'=>$user]);

      // 获取 当前 管理员 可以访问的每个权限
      $admin_nodes_data = DB::select('select n.cname, n.aname from nodes as n, adminuser_roles as ur, roles_nodes as rn where ur.uid='.$user->id.' and ur.rid=rn.rid and rn.nid=n.id;');
     
      // 将控制器和方法名转换格式
      $temp = [];
      foreach($admin_nodes_data as $k=>$v){
        // 把 控制器 当 下标
        $temp[$v->cname][] = $v->aname;
        // 如果 是列表 就 在压入 一个 show 方法
        if($v->aname == 'index'){
           $temp[$v->cname][] = 'show';
        }
        // 如果 是修改 就 在压入 一个 update 方法
         if($v->aname == 'edit'){
           $temp[$v->cname][] = 'update';
        } 
        // 如果 是添加 就 在压入 一个 store 方法
        if($v->aname == 'create'){
           $temp[$v->cname][] = 'store';
        }
      }

      // 将 数据 压入到 session 中
      session(['admin_nodes_data'=>$temp]);
      // 提示 登陆成功
	   echo json_encode(['msg'=>'ok','info'=>'登陆成功']);


   	}

    // 退出 后台方法
    public function logout()
    {
      session(['admin_login'=>false]);
      session(['admin_userinfo'=>false]);       
      return redirect('admin/login');
    }
}
