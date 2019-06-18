<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brands;

class BrandsController extends Controller
{
    /**
     * 显示列表 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // 获取 要查询的数值
        $search_bname = $request->input('search_bname','');
        // 查询 所有 数据
        $brands_data = Brands::where('bname','like','%'.$search_bname.'%')->paginate(5);
        // 显示 页面
        return view('admin.brands.index',['brands_data'=>$brands_data,'params'=>$request->all()]);
    }

    /**
     * 显示 添加商品 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 显示 页面
        return view('admin.brands.create');
    }

    /**
     * 保存 要添加的数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 保存 要上传的图片
        if($request->file('bimg')){
            $path = $request->file('bimg')->store(date('Ymd'));
        }

        $brands = new Brands;
        $brands->bname = $request->input('bname','');
        $brands->intro = $request->input('intro','');
        $brands->bimg  = $path;

        // 保存数据
       $res = $brands->save();

       if($res){
            return redirect('admin/brands')->with('success','添加成功');
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
     * 显示 要修改的数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brands_data = Brands::find($id);

        echo json_encode($brands_data);
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
        $brands = Brands::find($id);

        // 判断 是否修改图片
        if($request->file('bimg')){
            $path = $request->file('bimg')->store(date('Ymd'));
            $brands->bimg = $path;
        }

        

        // 修改 参数
        $brands->bname = $request->input('bname','');
        $brands->intro = $request->input('intro','');
        
        // 保存到数据库
        $res = $brands->save();

        // 判断是否成功
        if($res){
            return redirect('admin/brands')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }

    }

    /**
     * 执行删除 操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // 执行 删除操作
        $res = Brands::destroy($id);

        // 判断 执行操作是否成功
        if($res){
            echo "success";
        } else {
            echo "error";
        }
    }
}
