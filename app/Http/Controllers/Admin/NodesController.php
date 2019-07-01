<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class NodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 从数据库获取权限所有值
        $nodes_data = DB::table('nodes')->paginate(10); 

        // 权限 列表 模板
        return view('admin.nodes.index',['nodes_data'=>$nodes_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         // 权限 添加 模板
        return view('admin.nodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // 字段 验证
        $this->validate($request, [
            'desc' => 'required',
            'cname' => 'required|regex:/^[\w]{4,10}$/',
           'aname' => 'required|regex:/^[\w]{3,15}$/',         
            
        ],[
           'desc.required'=>'权限名必填',         
            'cname.regex'=>'控制器名格式错误',
            'cname.required'=>'控制器名必填',
            'aname.required'=>'方法名必填',
            'aname.regex'=>'方法名格式错误',
        ]);
        // 接收 描述 控制器 方法 参数
        $desc = $request->input('desc');
        $aname = $request->input('aname');
        $cname = $request->input('cname');
        $controller = $cname.'controller';
       $res = DB::table('nodes')->insert(['desc'=>$desc,'aname'=>$aname,'cname'=>$controller]);
       if($res){
         return redirect('admin/nodes')->with('success','添加成功');
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
        // 查询数据库里对应的数据
        $node = DB::table('nodes')->where('id',$id)->first();
        // 加载 修改权限 模板
        return view('admin.nodes.edit',['node'=>$node]);
      
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
        // 接收 描述 控制器 方法 参数
        $desc = $request->input('desc');
        $cname = $request->input('cname');
        $aname = $request->input('aname');
        $res = DB::table('nodes')->where('id',$id)->update(['desc'=>$desc,'cname'=>$cname,'aname'=>$aname]);
        if($res){
            return redirect('admin/nodes')->with('success','修改成功');
        }else{
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
