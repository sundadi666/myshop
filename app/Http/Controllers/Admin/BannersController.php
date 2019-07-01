<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banners;

class BannersController extends Controller
{
    /**
     * 显示轮播图列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $keywords = $request->input('keywords');
        $banners_data = Banners::where('title','like','%'.$keywords.'%')->paginate(4);

        return view('admin.banners.index',['banners_data'=>$banners_data,'params'=>$request->all()]);
    }

    /**
     * 添加轮播表单 显示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.banners.create');
    }

    /**
     * 执行保存 操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'title' => 'required|max:35',
            'desc' => 'required|max:20',
            'url' => 'required'
        ],[
            //表单规格被触发
            'title.required'=>'标题必须填写',
            'title.max'=>'标题不能超过35个字符',
            'desc.required'=>'轮播图描述必须填写',
            'url.required'=>'轮播图片必须上传'
        ]);

        if($request->hasFile('url')) {
            //新图片
            $path = $request->file('url')->store(date('Ymd'));
        } else {
            $path = '';
        }
        //实例化轮播图模型
        $banner = new Banners();
        //轮播图标题
        $banner->title = $request->input('title');
        //轮播图描述
        $banner->desc = $request->input('desc');
        //轮播图状态
        $banner->status = $request->input('status');


        //轮播图
        $banner->url = $path;
        //保存
        $row = $banner->save();

        //返回受影响行数
        if($row) {
            return redirect('admin/banners')->with('success','添加数据成功');
        } else {
            return back()->with('error','添加数据失败');
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
     * 轮播图修改表单页面 显示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查询该id对应的数据
        $banner = Banners::find($id);

        echo json_encode($banner);
    }

    /**
     * 执行修改轮播图数据 操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //表单验证
        $this->validate($request, [
            'title' => 'required|max:35',
            'desc' => 'required|max:20',
        ],[
            //表单规格被触发
            'title.required'=>'标题必须填写',
            'title.max'=>'标题不能超过35个字符',
            'desc.max'=>'标题不能超过20个字符',
            'desc.required'=>'轮播图描述必须填写',
        ]);


        if($request->hasFile('url')) {
            //新图片
            $path = $request->file('url')->store(date('Ymd'));
        } else {
            $path = $request->input('url_path');
        }

        //接收该id数据
        $banner = Banners::find($id);
        
        $banner->title = $request->input('title');
        $banner->desc = $request->input('desc');
        $banner->status = $request->input('status');
        $banner->url = $path;

        //保存数据
        $row = $banner->save();
        if($row) {
            //修改数据成功
            return redirect('/admin/banners')->with('success','修改数据成功');
        } else {
            //修改数据失败
            return back()->with('error','修改数据失败');
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
        //接收id
        $row = Banners::destroy($id);

        if($row) {
            //删除成功
            echo json_encode(['msg'=>'ok']);
        } else {
            //删除数据失败
            echo json_encode(['msg'=>'err']);
        }
    }
}
