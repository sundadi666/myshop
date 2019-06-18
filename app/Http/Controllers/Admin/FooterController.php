<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Footer;
class FooterController extends Controller
{
    /**
     * 网站 底部 列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取 网站底部 所有 数据  每页 3 条 数据
        $footer_data = Footer::paginate(3);

        // 网站 底部 列表
        return view('admin.footer.index',['footer_data'=>$footer_data]);
       
    }

    /**
     * 网站 底部 添加
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 网站 底部 添加
        return view('admin.footer.create');
        
    }

    /**
     * 网站 底部 执行 添加
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 网站 底部 执行 添加
        
        // 字段 验证
        $this->validate($request, [
            'copy' => 'required|regex:/^(.*?){5,30}$/',
            'filing' => 'required|regex:/^(.*?){5,30}$/',
            'company' => 'required|regex:/^(.*?){5,30}$/',
            
        ],[
            'copy.required'=>'版权必填',
            'copy.regex'=>'版权格式错误',
            'filing.regex'=>'备案号错误',
            'filing.required'=>'备案号必填',
            'company.required'=>'公司名称必填',
            'company.regex'=>'公司名称格式错误',
            
        ]);
       // 获取 所有字段
       $data = $request->except('_token');
       //实例化 数据库对象
       $footer = new Footer;
       $footer->copy = $data['copy'];
       $footer->filing = $data['filing'];
       $footer->company = $data['company'];
       // 执行 添加 保存到 数据库
       $res = $footer->save();
       // 判断 是否 添加 成功
       if($res){
          return redirect('admin/footer')->with('success','添加成功');
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
     * 网站 底部 执行 添加
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 网站 底部 执行 添加
        $data = Footer::find($id);
        // 显示 修改 视图
        return view('admin.footer.edit',['data'=>$data]);
    }

    /**
     * 确定 要修改 内容
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 确定 要修改 内容
        $data = Footer::find($id);
        $data->copy = $request->input('copy');
        $data->filing = $request->input('filing');
        $data->company = $request->input('company');
        // 将数据添加到 数据库
        $res = $data->save();
        // 判断 是否 修改 成功
        if($res){
          return redirect('admin/footer')->with('success','修改成功');
       }else{
         return back()->with('error','修改失败');
       }
    }

    /**
     * 执行 要删除 的 内容
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // 执行 要删除 的 内容
        $res = Footer::destroy($id);
        // 判断 是否 删除 成功
           if($res){
          return redirect('admin/footer')->with('success','删除成功');
       }else{
         return back()->with('error','删除失败');
       }
    }
}
