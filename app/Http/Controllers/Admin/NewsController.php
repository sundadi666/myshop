<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * 公告列表 显示
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //接收keywords
        $keywords = $request->input('keywords','');
        $news_data = News::where('title','like',"%{$keywords}%")->paginate(4);
        return view('admin.news.index',['news_data'=>$news_data,'params'=>$request->all()]);
    }

    /**
     * 公告添加也面 显示
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.news.create');
    }

    /**
     * 保存公告数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //表单验证
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
        ],[
            //表单规格被触发
            'title.required'=>'标题必须填写',
            'content.required'=>'内容必须填写'
        ]);


        //获取公告数据
        $news = new News();
        //执行 公告数据 添加
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $row = $news->save();
        //返回受影响行数
        if($row) {
            return redirect('admin/news')->with('success','添加数据成功');
        } else {
            return back()->with('error','添加数据失败');
        }
    }

    /**
     * 显示 公告内容 详情
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //返回公告ajax数据
        if(News::find($id)) {
            //请求成功
            echo json_encode(['msg'=>'ok','info'=>News::find($id)]);
        } else {
            //请求失败
            echo json_encode(['msg'=>'err']);
        }
    }

    /**
     * 公告修改页面 显示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //查询该id对应的数据
        $news = News::find($id);

        echo json_encode($news);
    }

    /**
     * 执行 公告修改
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //表单验证
        $this->validate($request, [
            'title' => 'required|max:20',
            'content' => 'required',
        ],[
            //表单规格被触发
            'title.required'=>'标题必须填写',
            'title.max'=>'标题输入在20字以内',
            'content.required'=>'内容必须填写'
        ]);

        //接收该id数据
        $news = News::find($id);
        
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        //保存数据
        $row = $news->save();
        if($row) {
            //修改数据成功
            return redirect('/admin/news')->with('success','修改数据成功');
        } else {
            //修改数据失败
            return back()->with('error','修改数据失败');
        }
    }

    /**
     * 删除 公告
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //接收id
        $row = News::destroy($id);
        if($row) {
            //删除成功
            echo json_encode(['msg'=>'ok']);
        } else {
            //删除数据失败
            echo json_encode(['msg'=>'err']);
        }
    }
}
