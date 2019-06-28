<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class RolesController extends Controller
{

    //封装  静态 控制器 名称 方法
    public static function conall()
    {
        return [
                'userscontroller'=>'用户管理',
                'catescontroller'=>'分类管理',
                'footercontroller'=>'网站底部管理',
                'bannerscontroller'=>'轮播图管理',
                'navicatescontroller'=>'导航栏管理',
                'linkscontroller'=>'友情链接管理',
                'newscontroller'=>'公告管理',
                'goodscontroller'=>'商品管理',
                'replyscontroller'=>'留言管理',
                'brandscontroller'=>'品牌管理',
                'orderscontroller'=>'订单管理',
                'adminusercontroller'=>'管理员',
                'rolescontroller'=>'角色管理',
                'nodescontroller'=>'权限管理',
                'indexcontroller'=>'后台首页',
                'sizescontroller'=>'后台商品大小',
                'attributescontroller'=>'后台商品值添加',

               ];
    }

    // 封装 权限 静态 方法
    public static function getnodes()
    {
         // 获取 权限 所有 数据
        $nodes_data = DB::table('nodes')->get();
        // 将数据转变格式 用控制器当下标 
        $lists = [];
        foreach($nodes_data as $k=>$v){
            $temp['id'] = $v->id;
            $temp['aname'] = $v->aname;
            $temp['desc'] = $v->desc;
            $lists[$v->cname][] = $temp;
        }
        return $lists;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取角色数据
        $roles_data = DB::table('roles')->get();
       
        // 加载 角色 列表 模板
        return view('admin.roles.index',['roles_data'=>$roles_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
           
        // 加载 角色 添加 模板 把权限 数据 和 权限名称 传到 模板中
        return view('admin.roles.create',['nodes_data'=>self::getnodes(),'conall'=>self::conall()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // 开启实务
        DB::beginTransaction();
        // 接收 角色 和 权限 参数值
        $rname = $request->input('rname');
        $nids = $request->input('nids');
        // 保存数据 到 角色 表里 并返回 角色id
        $rid = DB::table('roles')->insertGetId(['rname'=>$rname]);
        // 保存数据 到 角色关联 表里
        foreach($nids as $K=>$v){
             $res = DB::table('roles_nodes')->insert(['rid'=>$rid,'nid'=>$v]);
        }
            // 判断 是否成功
           if($rid && $res){
            // 成功 就 提交实务 并跳转到列表页
            DB::commit();
            return redirect('admin/roles')->with('success','添加成功');
           }else{
            // 不成功 就 回滚实务 并跳转到原来的页面
            DB::rollBack();
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
        // 获取 角色对应的所有 权限
        $role = DB::table('roles')->where('id',$id)->first();
        // 获取rid
        $rid = $role->id;
        $nodes = DB::table('roles_nodes')->where('rid',$rid)->get();
        $nid = [];
        foreach($nodes as $k=>$v){
            // 把每个nid 压入到数组中
            $nid[] = $v->nid;
        }
        // dd($nid);

        // 加载 修改 页面
        return view('admin.roles.edit',['role'=>$role,'nid'=>$nid,'nodes_data'=>self::getnodes(),'conall'=>self::conall()]);
       
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
        // 开启实务
        DB::beginTransaction();
       // 接收 角色参数    
       $rname = $request->input('rname','普通管理员');
       // 接收 权限参数
       $nids = $request->input('nids',0);       
       // 获取角色数据
       $rids = DB::table('roles')->where('id',$id)->first();
       // 获取 rid
       $rid = $rids->id; 
       // 先删除 原有的权限 在 进行插入
       $res = DB::table('roles_nodes')->where('rid',$id)->delete();

       // 判断和数据库的值是否相等
       if($rids->rname === $rname){
         $res1 = 1;
       } else {
         $res1=DB::table('roles')->where('id',$id)->update(['rname'=>$rname]);
       }

        // 保存数据 到 角色关联 表里
        foreach($nids as $K=>$v){          
             $res2 = DB::table('roles_nodes')->insert(['rid'=>$rid,'nid'=>$v]);
        }
            // 判断 是否成功
           if($res1 && $res2){
            // 成功 就 提交实务 并跳转到列表页
            DB::commit();
            return redirect('admin/roles')->with('success','修改成功');
           }else{
            // 不成功 就 回滚实务 并跳转到原来的页面
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
        //
    }
}
