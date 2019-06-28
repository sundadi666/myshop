<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\StoreUsers;
use App\Models\Adminuser;
use App\Models\Adminuserroles;
use Illuminate\Support\Facades\Storage;
class AdminuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!session('admin_login')){
            return redirect('admin/login');
        }
        $uid = session('admin_userinfo')->id;
        // 获取 管理员 所有数据
        $adminuser = Adminuser::paginate(5);

        // 加载 后台列表 模板
        return view('admin.adminuser.index',['adminuser'=>$adminuser]);
       
    }

    /**
     *  管理员添加方法
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 获取角色 所有数据
        $roles_data = DB::table('roles')->get();

        // 管理员 添加 模板
        return view('admin.adminuser.create',['roles_data'=>$roles_data]);
        
    }

    /**
     *  执行管理员添加 并验证 保存到数据库 方法
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
            'upass' => 'required|regex:/^[\w]{6,18}$/',
            'repass' => 'required|same:upass',
            'profile' => 'required',
        ],[
            'upass.regex'=>'密码格式错误',
            'upass.required'=>'密码必填',
            'repass.required'=>'确认密码必填',
            'repass.same'=>'两次密码不一致',
            'profile.required'=>'头像必填',           
        ]);
         // 检测 是否 有 头像 上传
       if($request->hasFile('profile')){
        $file_path = $request->file('profile')->store(date('Ymd'));
       }else{
        // 默认 图片
        $file_path = '20190625/18GmSoKZNMdYZ7WycJQe1TknRnE8xsXqRTZaPBpC.jpeg';
       }
        $temp['uname'] = $request->input('uname');
        $temp['upass'] =  Hash::make($request->input('upass'));
        $temp['phone'] = $request->input('phone');
        $temp['sex'] = $request->input('sex');
        $temp['profile'] = $file_path;
        $rid = $request->input('rid');
        // 插入 后台用户表 返回 uid
        $uid = DB::table('admin_users')->insertGetId($temp);
        // 插入后台用户和角色关联表
        $res = DB::table('adminuser_roles')->insert(['uid'=>$uid,'rid'=>$rid]);
        // 判断 实务 
        if($uid && $res){
            // 确定 提交
            DB::commit();
            return redirect('admin/adminuser')->with('success','添加成功');
        }else{
            // 实务 回滚
            DB::rollBack();
            // 如果 失败 跳转到原先 的位置
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
        // 获取角色 所有数据
        $roles_data = DB::table('roles')->get();
       // 获取 管理员 信息
       $admin_user = Adminuser::find($id);
       // 加载 后台 修改 页面
       return view('admin.adminuser.edit',['admin_user'=>$admin_user,'roles_data'=>$roles_data]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUsers $request, $id)
    {
             // 开始 实务
              DB::beginTransaction();
             // 判断是否有文件上传
            if($request->hasFile('profile')){
                // 把原先的旧图删除
                Storage::delete($request->input('profile_path'));
                $profile = $request->file('profile')->store(date('Ymd'));
            }else{
              // 如果没传值就选择默认的
                $profile = $request->input('profile_path');
            }
            
            $rid = $request->input('rid');

            $user = Adminuser::find($id);
            $user->uname = $request->input('uname');
            $user->phone = $request->input('phone');
            $user->sex = $request->input('sex');
            $user->profile = $profile;
            $res1 = $user->save();
             // $res = DB::table('adminuser_roles')->insert(['uid'=>$uid,'rid'=>$rid]);
           $adminuser_roles =  Adminuserroles::where('uid',$id)->first();
           $adminuser_roles->rid = $rid;
           $res2 = $adminuser_roles->save();
           if($res1 && $res2){
            DB::commit();
                return redirect('admin/adminuser')->with('success','修改成功');
            }else{
                DB::rollBack();
                return back()->with('error','修改失败');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 开启 实务
         DB::beginTransaction();
         // 删除 指定的管理员用户
        $res1 = Adminuser::destroy($id);
        // 删除 指定的管理员角色
        $res2 = Adminuserroles::where('uid',$id)->delete();
        // 判断 两次删除同时 成功 就提交删除 并跳转
        if($res1 && $res2){
            DB::commit();
            return redirect('admin/adminuser')->with('success','删除成功');
        }else{
            DB::rollBack();
            return back()->with('error','删除失败');
        }
    }
}
