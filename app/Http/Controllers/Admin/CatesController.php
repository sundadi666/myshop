<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cates;
use DB;
use Illuminate\Support\Facades\Redis;

class CatesController extends Controller
{   
    public static function getCateData($search_title='')
    {
         // 查询 所有 分类
        $cates = Cates::select('*',DB::raw("concat(path,',',id) as paths"))->where('cname','like','%'.$search_title.'%')->orderBy('paths','asc')->paginate(5);
        
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
    public function index(Request $request)
    {   
        // 接收要搜索的分类名称
        $search_cname = $request->input('search_title','');

        
        $cates = self::getCateData($search_cname);

        return view('admin.cates.index',['cates'=>$cates,'params'=>$request->all()]);
    }

    /**
     * 显示 添加分类 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        //  获取id
        $id = $request->input('id','');

        // 查询 分类 的所有数据
        $cates = Cates::select('*',DB::raw("concat(path,',',id) as paths"))->orderBy('paths','asc')->get();
        
        // 遍历 分类 的数据
        foreach ($cates as $key => $value) {
            $n = substr_count($value->path,',');

            $cates[$key]->cname = str_repeat('|---', $n).$value->cname;
        }

        // 显示页面
        return view('admin.cates.create',['cates'=>$cates,'id'=>$id]);
    }

    /**
     * 执行 添加分类
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //判断是否有栏目更新是否存在redis
        // if(Redis::exists('cates_redis_data')){
        //     Redis::del('cates_redis_data');
        // }
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
