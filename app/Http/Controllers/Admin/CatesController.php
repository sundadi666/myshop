<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;

class CatesController extends Controller
{   
    public static function getCateData()
    {
         // 查询 所有 分类
        $cates = Cates::select('*',DB::raw("concat(path,',',id) as paths"))->orderBy('paths','asc')->paginate(5);
        
        foreach ($cates as $key => $value) {
            $n = substr_count($value->path,',');

            $cates[$key]->cname = str_repeat('|---', $n).$value->cname;
        }
        return $cates;
    }

    /**
     * 显示 分类 表格
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       

        return view('admin.cates.index',['cates'=>self::getCateData()]);
    }

    /**
     * 显示 添加分类 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $id = $request->input('id','');

        // 显示页面
        return view('admin.cates.create',['cates'=>self::getCateData(),'id'=>$id]);
    }

    /**
     * 执行 添加分类
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 获取pid值
        $pid = $request->input('pid',0);

        if($pid == 0){
            $path = 0;
        } else {
            $cates_data = Cates::find($pid);
            $path = $cates_data->path.','.$cates_data->id;
        }

        // 将数据 压入数据库
        $cates = new Cates;
        $cates->cname = $request->input('cname','');
        $cates->pid   = $pid;
        $cates->path  = $path;

        // 保存数据 到数据库
        $res = $cates->save();

        if($res){
            return redirect('admin/cates')->with('success','添加成功');
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
