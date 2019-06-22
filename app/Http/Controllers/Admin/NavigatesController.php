<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Navigates;

class NavigatesController extends Controller
{
    /**
     * 显示 导航栏
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        // 接收要 查询的数据
        $search_title = $request->input('search_title','');


        $navigates_data = Navigates::where('title','like','%'.$search_title.'%')->paginate(5);

        // 显示 导航栏
        return view('admin.navigates.index',['navigates_data'=>$navigates_data,'params'=>$request->all()]);
    }

    /**
     * 添加 导航栏
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 添加 导航栏
        return view('admin.navigates.create');
    }

    /**
     * 保存 导航栏的数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'title' => 'required|max:20',
            'url' => 'required',
        ],[
            //表单规格被触发
            'title.required'=>'标题必须填写',
            'title.max'=>'标题输入在20字以内',
            'url.required'=>'地址必须填写'
        ]);

        $navigates = new Navigates;

        // 接收 要保存的数据
        $navigates->title = $request->input('title');
        $navigates->url = $request->input('url');
        
        // 保存 要修改的数据
        $res = $navigates->save();

        if($res){
            return redirect('admin/navicates')->with('success','添加成功');
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
     * 查询 显示 要修改的数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查询要修改的数据
        $navigates_data = Navigates::find($id);

        echo json_encode($navigates_data);
        
    }

    /**
     * 保存要 修改的数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $navigates_data = Navigates::find($id);

        // 接收 要修改的数据
        $navigates_data->title = $request->input('title','');
        $navigates_data->url   = $request->input('url','');

        // 保存要修改的数据
        $res = $navigates_data->save();

        // 判断是否成功
        if($res){
            return redirect('admin/navicates')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }

    /**
     * 删除 导航
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 执行删除 命令
        $res = Navigates::destroy($id);

        if($res){
            echo "success";
        } else {
            echo "error";
        }

    }
}
