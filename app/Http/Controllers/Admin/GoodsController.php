<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input as Input;
use DB;

class GoodsController extends Controller
{
    /**
     * 显示商品列表 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $goods = new Goods();
        $goods_data = $goods->all();
        return view('admin.goods.index',['goods_data'=>$goods_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.goods.create');
    }

    /**
     * 商品数据 添加
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
            'img' => 'required'
        ],[
            //表单规格被触发
            'title.required'=>'标题必须填写',
            'title.max'=>'标题不能超过35个字符',
            'desc.required'=>'商品描述必须填写',
            'img.required'=>'商品图片必须上传'
        ]);

        //接收商品数据
        $goods = new Goods();
        //执行 商品数据 添加
        //接收图片
        if($request->hasFile('img')) {
            //接收图片
            $file = $request->file('img');
            //获取文件原始名称
            $filename = time() . '_' .rand(1000000,9999999).'_'.$file->getClientOriginalName();
            //上传原始大小图片
            $img = \Image::make($file)->save(public_path('/uploads/'.date('Ymd').'/'.$filename));
            //上传mid规格图片
            $img = \Image::make($file)->resize(60, 60)->save(public_path('/uploads/'.date('Ymd').'/'.'img_small_'.$filename));
            //上传big规格图片
            $img = \Image::make($file)->resize(400, 400)->save(public_path('/uploads/'.date('Ymd').'/'.'img_big_'.$filename));
            } else {
                //如果接收图片不成功,给个空值
            $path = '';
        }

        //保存商品标题
        $goods->title = $request->input('title');
        //保存商品描述
        $goods->desc = $request->input('desc');
        //保存商品状态
        $goods->goods_status = $request->input('goods_status');
        //保存商品分类
        $goods->cid = $request->input('cid');
        //保存商品品牌
        $goods->bid = $request->input('bid');
        $goods->img = date('Ymd').'/'.$filename;
        $goods->img_small = date('Ymd').'/'.'img_small_'.$filename;
        $goods->img_big = date('Ymd').'/'.'img_big_'.$filename;
        //执行添加数据
        $row = $goods->save();
        //返回受影响行数
        if($row) {
            return redirect('admin/news')->with('success','添加数据成功');
        } else {
            //添加失败
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查询该id对应的数据
        $goods = Goods::find($id);
        //查询所有分类数据
        $cates = DB::table('cates')->get();
        $brands = DB::table('brands')->get();
        $goods_data = Goods::all();

        echo json_encode(['goods'=>$goods]);
        return view('admin.goods.index',['cates'=>$cates]);
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
        dd($request->all());
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
