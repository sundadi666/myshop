<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsers;
use App\Models\Users;
use App\Models\UsersInfos;
use Hash;
use DB;
use Illuminate\Support\Facades\Storage;
class UsersController extends Controller
{
    /**
     *  用户 列表 显示
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 接收 搜索的 值
        $search_uname = $request->input('search_uname','');
        $search_phone = $request->input('search_phone','');

        // 获取 用户 全部 数据  加上 搜索 条件
        $users_data = Users::where('uname','like','%'.$search_uname.'%')->where('phone','like','%'.$search_phone.'%')->paginate(3); 
       

        // 显示 用户 列表
        return view('admin.users.index',['users_data'=>$users_data,'params'=>$request->all()]);
        
    }

    /**
     *  用户 添加 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 用户 添加 页面
        return view('admin.users.create');
    }

    /**
     *  用户 确定执行 添加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsers $request)
    {

        // 开始 实务
        DB::beginTransaction();
        // 字段 验证
        $this->validate($request, [
            //'uname' => 'required|regex:/^[a-zA-Z]{1}[\w]{5,17}$/',
            'upass' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:upass',
           // 'phone' => 'required|regex:/^1{1}[3-8]{1}[\d]{9}$/',
           'profile' => 'required',
            'email' => 'required|email',
            
        ],[
           // 'uname.required'=>'用户名必填',
           // 'uname.regex'=>'用户名格式错误',
            'upass.regex'=>'密码格式错误',
            'upass.required'=>'密码必填',
            'repass.required'=>'确认密码必填',
            'repass.same'=>'两次密码不一致',
            //'phone.required'=>'手机号码必填',
            //'phone.regex'=>'手机号码格式错误',
            'email.required'=>'邮箱必填',
            'email.email'=>'邮箱格式错误',            
           'profile.required'=>'头像必填',
        ]);

       // 检测 是否 有 头像 上传
       if($request->hasFile('profile')){
        $file_path = $request->file('profile')->store(date('Ymd'));
       }else{
        // 默认 图片
        $file_path = '20190625/18GmSoKZNMdYZ7WycJQe1TknRnE8xsXqRTZaPBpC.jpeg';
       }
       // 接收 所有的 值
       $data = $request->all();

       $user = new Users;
       $user->uname = $data['uname'];
       $user->token = $data['_token'];
       $user->phone = $data['phone'];
       $user->email = $data['email'];
       $user->upass = Hash::make($data['upass']);
       // 将数据 存入到 数据库
       $res1 = $user->save();
       // 如果 插入成功 获取 uid
       if($res1){
        // 获取 uid
        $uid = $user->id;
       }

       // 将 头像 插入 到 用户详情表里
       $userinfo = new UsersInfos;
       $userinfo->uid = $uid;
       $userinfo->profile = $file_path;     
      
       // 执行 插入 到数据库
       $res2 = $userinfo->save();
       // 判断 两个表 是否同部  添加 实务
       if($res1 && $res2){
       // 确定 提交
       DB::commit();
       // 提示 是否 添加成功 跳转到 列表页
       return redirect('admin/users')->with('success','添加成功');
       }else{
        // 实务 回滚
        DB::rollBack();
        // 如果 失败 跳转到原先 的位置
        return back()->with('error','添加失败');
       }


    }

    /**
     *  用户 显示 详情 页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 用户 显示 修改 页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
     
        
    }

    // 后台 管理员 修改 密码
     public function update_upass(Request $request,$id)
     {
       // 接收 参数 
       $upass = $request->input('upass');
       $new_upwd1 = $request->input('new_upwd1');
       $new_upwd2 = $request->input('new_upwd2');
       // 判断 密码不能为空
       if(empty($new_upwd1) || empty($new_upwd2)){
        return back()->with('error','密码不能为空');
       }
       // 判断 两次密码是否一致
       if($new_upwd1 != $new_upwd2){
        return back()->with('error','两次密码不正确');
       }
     
       // 获取 用户 的详情 信息
       $user = session('admin_userinfo');
       // 判断 和数据库的密码 进行判断是否一致
       $res = password_verify($upass,$user->upass);
      if(!$res){
        return back()->with('error','原始密码不正确');
      }
        $new_upwd1 = Hash::make($new_upwd1);
        $res = DB::table('admin_users')->where('id',$id)->update(['upass'=>$new_upwd1]);
         // 重新获取个人信息赋值给session
         $user = DB::table('admin_users')->where('id',$id)->first();
       if($res){
              session(['admin_userinfo'=>$user]);
            return redirect('admin')->with('success','修改密码成功');
        } else {
            return back()->with('error','修改密码失败');
        }

     }

     //  后台 管理员 修改头像
     public function update_profile(Request $request,$id)
     {
           // 判断是否有文件上传
        if($request->hasFile('profile')){
            // 把原先的旧图删除
            Storage::delete($request->input('uface_path'));
            $profile = $request->file('profile')->store(date('Ymd'));
        }else{
          // 如果没传值就选择默认的
            $profile = $request->input('uface_path');
        }
          // 确定 修改图片保存到数据库
         $res = DB::table('admin_users')->where('id',$id)->update(['profile'=>$profile]);
      
         // 重新获取个人信息
            $user = DB::table('admin_users')->where('id',$id)->first();

        if($res){
          // 将个人信息重新赋值给session
           session(['admin_userinfo'=>$user]);
          // dd(session('userinfo'));
            return redirect('admin')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
     }

    /**
     *  
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

       
    }

    /**
     * 删除 用户
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
       
    }


    /**
     * 修改 用户 权限
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function status(Request $request)
    {        
      // 接收状态值
      $status = $request->input('status');
      $id = $request->input('id');
     
      $res = DB::table('users')->where('id',$id)->update(['status'=>$status]);
      if($res){
        // 成功返回
        return redirect('admin/users')->with('success','修改状态成功');
      }else{
        // 失败返回
        return back()->with('error','修改状态失败');
      }
    }
}
