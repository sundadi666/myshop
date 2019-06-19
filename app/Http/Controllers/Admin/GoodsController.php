<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input as Input;
use DB;
use App\Models\Cates;
use App\Models\Brands;

class GoodsController extends Controller
{
    /**
     * 显示商品列表 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取所有分类
        $cates_data = Cates::all();
        
        $goods = new Goods();
        //获取所有商品数据
        $goods_data = $goods->all();

        //获取所有品牌数据
        $brands_data = Brands::all();

        return view('admin.goods.index',['goods_data'=>$goods_data,'cates_data'=>$cates_data,'brands_data'=>$brands_data]);
    }

    /**
     * 显示商品添加表面 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取所有分类数据
        $cates_data = Cates::all();
        //获取所有品牌数据
        $brands_data = Brands::all();
        return view('admin.goods.create',['cates_data'=>$cates_data,'brands_data'=>$brands_data]);
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

            if(!is_dir('/uploads/'.date('Ymd'))){
               $request->file('img')->store(date('Ymd'));
            }

            //上传原始大小图片
            $img = \Image::make($file)->save(public_path('/uploads/'.date('Ymd').'/'.$filename));
            // dd($img);    
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
        $goods->cid = $request->input('cid','');
        //保存商品品牌
        $goods->bid = $request->input('bid','');
        //自定义三个规格图片的路径
        $goods->img = date('Ymd').'/'.$filename;
       
        $goods->img_small = date('Ymd').'/'.'img_small_'.$filename;
        $goods->img_big = date('Ymd').'/'.'img_big_'.$filename;
        //执行添加数据
        $row = $goods->save();
        //返回受影响行数
        if($row) {
            return redirect('admin/goods')->with('success','添加数据成功');
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
     * 显示商品修改 表单 页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查询该id对应的数据
        $goods = Goods::find($id);

        echo json_encode(['goods'=>$goods]);
    }

    /**
     * 执行修改数据 操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $goods = Goods::find($id);
        //获取缩略图
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

            $goods->img = date('Ymd').'/'.$filename;
            $goods->img_small = date('Ymd').'/'.'img_small_'.$filename;
            $goods->img_big = date('Ymd').'/'.'img_big_'.$filename;
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
        //执行添加数据
        $row = $goods->save();
        if($row) {
            return redirect('admin/goods')->with('success','修改数据成功');
        } else {
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
        //
    }
}
