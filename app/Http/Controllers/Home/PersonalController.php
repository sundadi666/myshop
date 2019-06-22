<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Users; 
use App\Models\UsersInfos; 
use App\Models\Navigates;
use DB;
use Hash;
// use App\Http\Requests\StoreUsers;
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

        // 开始 实务
        DB::beginTransaction();
        // 字段 验证
        $this->validate($request, [
            'uname' => 'regex:/^[a-zA-Z]{1}[\w]{5,17}$/',          
           'phone' => 'regex:/^1{1}[3-8]{1}[\d]{9}$/',           
            'email' => 'email',
            
        ],[
           
           'uname.regex'=>'用户名格式错误',            
            'phone.regex'=>'手机号码格式错误',
            'email.email'=>'邮箱格式错误',                      
        ]);
         // 检测 是否 有 头像 上传
       if($request->hasFile('profile')){
        $file_path = $request->file('profile')->store(date('Ymd'));
       }else{
        $file_path = $request->input('profile_path');
       }

        // 接收 用户id
        $id = $request->input('id',0);
        $token = $request->input('token','');

       $user = Users::find($id);       
       $user->uname = $request->input('uname');
       $user->token = str_random(50);
       $user->phone = $request->input('phone');
       $user->email = $request->input('email');    
       // 将数据 存入到 数据库
       $res1 = $user->save();
       // 如果 插入成功 获取 uid
       if($res1){
        // 获取 uid
        $uid = $user->id;
       }

       // 将 头像 插入 到 用户详情表里
       $userinfo = UsersInfos::where('uid',$id)->first();     
       $userinfo->uid = $uid;
       $userinfo->profile = $file_path; 
       $userinfo->sex = $request->input('sex','');
      
       // 执行 插入 到数据库
       $res2 = $userinfo->save();
       // 判断 两个表 是否同部  添加 实务
       if($res1 && $res2){
       // 确定 提交
       DB::commit();
       // 提示 是否 添加成功 跳转到 列表页
       return back()->with('success','修改成功');
       }else{
        // 实务 回滚
        DB::rollBack();
        // 如果 失败 跳转到原先 的位置
        return back()->with('error','修改失败');
       }

    }

    // 修改密码 页面
    public function upass()
    {
         // 判断 用户是否登录
        if(!session('home_login')){
            return redirect('/home/login')->with('error','请先登录');
        }
        // 获取 用户id
        $id = session('userinfo')->id;
        // 通过id 查找用户 详细信息
        $user = Users::find($id);
       // 加载 修改密码 页面
       return view('home.personal.upass',['user'=>$user]);
    }
    // 修改 密码 方法
    public function updata_upass(Request $request,$id)
    {
      // 接收 参数 
       $upass = $request->input('upass');
       $new_upwd1 = $request->input('new_upass1');
      
       // 获取 用户信息
       $user = Users::find($id);
       // 判断 和数据库密码是否一致
       $res = password_verify($upass,$user->upass);
      if(!$res){
        echo json_encode(['msg'=>'error','info'=>'原始密码不正确']);
        exit;
      }
        $new_upwd1 = Hash::make($new_upwd1);
       $res = DB::table('users')->where('id',$id)->update(['upass'=>$new_upwd1]);
       if($res){
            
            echo json_encode(['msg'=>'ok','info'=>'修改密码成功']);
        } else {
            
            echo json_encode(['msg'=>'error','info'=>'修改密码失败']);
            exit;
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
