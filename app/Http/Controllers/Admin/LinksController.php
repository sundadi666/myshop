<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Links;

class LinksController extends Controller
{
    /**
     * 友情链接 页面数据 显示
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        // 获取 要查询的title 
        $search_title = $request->input('search_title','');

        $links_data = Links::where("title",'like','%'.$search_title.'%')->paginate(5);


        // 友情链接 显示
        return view('admin.links.index',['links_data'=>$links_data,'params'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 友情 链接 添加
        return view('admin.links.create');
    }

    /**
     * 执行 添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $links = new Links;

        // 接收 数据
        $links->title = $request->input('title','');
        $links->url  = $request->input('url','');

        // 保存 数据
        $res = $links->save();

        if($res){
            return redirect('admin/links')->with('success','添加成功');
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
     * 显示 要需要的数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查询要 修改的数据
        $edit_data = Links::find($id);
    
        echo json_encode($edit_data);
    }

    /**
     * 保存 要修改的数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        // 查找 要修改的数据
        $links = links::find($id);

        $links->title = $request->input('title','');
        $links->url   = $request->input('url','');

        // 保存要修改的数据
        $res = $links->save();

        // 判断是否成功
        if($res){
            return redirect('admin/links')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }

    }

    /**
     * 执行 删除命令
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 查找 要删除的 数据
        $links = links::find($id);
    
        // 执行 删除命令
        $res = $links->delete();

        // 判断是否成功
        if($res){
            echo "success";
        }else{
            echo "error";
        }
    }
}
