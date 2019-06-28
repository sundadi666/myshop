<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Goods;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Storage;
use App\Models\Cates;
use App\Models\Brands;
use App\Models\Models;
use App\Models\Sizes;
use App\Models\Attributes;
use DB;


class GoodsController extends Controller
{
    /**
     * 显示商品列表 
     *
     * @return \Illuminate\Http\Response
     */

    // 商品图片上传类
    public function doUpload(Request $request){

        $file = $request->file('img');
        $filePath =[];  // 定义空数组用来存放图片路径
        foreach ($file as $key => $value) {
          // 判断图片上传中是否出错
           if (!$value->isValid()) {
              exit("上传图片出错，请重试！");
           }
            if(!empty($value)){//此处防止没有多文件上传的情况
            $allowed_extensions = ["png", "jpg", "jpeg", "gif"];
            if ($value->getClientOriginalExtension() && !in_array($value->getClientOriginalExtension(), $allowed_extensions)) {
                exit('您只能上传PNG、JPG或GIF格式的图片！');
            }
            $destinationPath = '/uploads/'.date('Ymd'); // public文件夹下面uploads/xxxx-xx-xx 建文件夹
            $extension = $value->getClientOriginalExtension();   // 上传文件后缀
            $fileName = date('YmdHis').mt_rand(1000,9999).'.'.$extension; // 重命名

            $value->move(public_path().$destinationPath, $fileName); // 保存图片
            // dd($value);
            // //上传mid规格图片
            // $img = Image::make($value->getClientOriginalName())->resize(60, 60)->save(public_path('/uploads/'.date('Ymd').'/'.'img_small_'.$fileName));
            // $filePath[] = $destinationPath.'/'.$fileName; 
            $filePath = $destinationPath.'/'.$fileName; 
            $img = Image::make($value)->resize(60, 60)->save(public_path('/uploads/'.date('Ymd').'/'.'img_small_'.$fileName));
            // $img->resize(60,60);


            dd($img);

            

        }
    }
        // 返回上传图片路径，用于保存到数据库中
        return $filePath;
    }


    public function index(Request $request)
    {
        //获取所有分类
        $cates_data = Cates::all();
        
        

        //获取所有品牌数据
        $brands_data = Brands::all();

        //接收搜索关键词
        $keywords = $request->input('keywords','');

        //获取所有商品数据
        $goods_data =Goods::where('title','like',"%{$keywords}%")->paginate(4);
        
        

        return view('admin.goods.index',['goods_data'=>$goods_data,'cates_data'=>$cates_data,'brands_data'=>$brands_data,'params'=>$request->all()]);
    }

    /**
     * 显示商品添加表面 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 查询 分类 的所有数据
        $cates = Cates::select('*',DB::raw("concat(path,',',id) as paths"))->orderBy('paths','asc')->get();
        
        // 遍历 分类 的数据
        foreach ($cates as $key => $value) {
            $n = substr_count($value->path,',');

            $cates[$key]->cname = str_repeat('|---', $n).$value->cname;
        }


        //获取所有分类数据
        $cates_data = $cates;
        
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
            'img' => 'required',
            'goods_info_top' => 'required|max:10',
            'goods_info_bottom' => 'required|max:10',
            'content' => 'required',
            'attr_name' => 'required'
        ],[
            //表单规格被触发
            'title.required'=>'标题必须填写',
            'title.max'=>'标题不能超过35个字符',
            'desc.required'=>'商品描述必须填写',
            'img.required'=>'商品图片必须上传',
            'goods_info_top.required'=>'商品推荐信息(上)必须填写',
            'goods_info_bottom.required'=>'商品推荐信息(下)必须填写',
            'content.required'=>'商品内容不能为空',
            'attr_name.required'=>'商品属性不能为空'
        ]);

        //判断商品图片数量必须等于3个
        // if(count($request->file('img')) != 3) {
        //     return back()->with('error','商品图片必须上传3个');
        //     exit;
        // }

        $goods = new Goods();

        //接收图片
        if($request->hasFile('img')) {
                //接收图片
                $file = $request->file('img');

                foreach($file as $k=>$v) {
                    if(!is_dir('/uploads/'.date('Ymd'))){
                       $path = $v->store(date('Ymd'));
                    }
                    //获取文件原始名称
                    $filename = time() . '_' .rand(1000000,9999999).'_'.$v->getClientOriginalName();

                    //上传mid规格图片
                    $img = \Image::make($v)->resize(60, 60)->save(public_path('/uploads/'.date('Ymd').'/'.'img_small_'.$filename));
                    //上传big规格图片
                    $img = \Image::make($v)->resize(400, 400)->save(public_path('/uploads/'.date('Ymd').'/'.'img_big_'.$filename));
                }

            } else {
                //如果接收图片不成功,给个空值
            $path = '';
        }

        //把字符串转为数组
        $attr_name = explode(',', trim($request->input('attr_name'), ','));
        //循环插入数据库
        // dd($mname_arr);
        foreach($attr_name as $k=>$v) {
            //实例化模型
            $attributes = new Attributes();
            $attributes->gid = $request->input('id');
            $attributes->attr_name = $v;
            //添加数据
            $attributes->save();
        }

        // 保存商品标题
        $goods->title = $request->input('title');
        // 保存商品描述
        $goods->desc = $request->input('desc');
        // 保存商品状态
        $goods->goods_status = $request->input('goods_status');
        // 保存商品分类
        $goods->cid = $request->input('cid','');
        // 保存商品品牌
        $goods->bid = $request->input('bid','');
        // 自定义原图的路径
        $goods->img = 'uploads/'.$path;
        // 商品推荐信息上
        $goods->goods_info_top = $request->input('goods_info_top');
        // 商品推荐信息下
        $goods->goods_info_top = $request->input('goods_info_bottom');
        // 商品内容
        $goods->content = $request->input('content');
       
        $goods->img_small = 'uploads/'.date('Ymd').'/'.'img_small_'.$filename;
        $goods->img_big = 'uploads/'.date('Ymd').'/'.'img_big_'.$filename;
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
        //表单验证
        // $this->validate($request, [
        //     'title' => 'required|max:35',
        //     'desc' => 'required|max:20',
        //     'img' => 'required',
        //     'goods_info_top' => 'required|max:10',
        //     'goods_info_bottom' => 'required|max:10',
        //     'content' => 'required'
        // ],[
        //     //表单规格被触发
        //     'title.required'=>'标题必须填写',
        //     'title.max'=>'标题不能超过35个字符',
        //     'desc.required'=>'商品描述必须填写',
        //     'img.required'=>'商品图片必须上传',
        //     'goods_info_top.required'=>'商品推荐信息(上)必须填写',
        //     'goods_info_bottom.required'=>'商品推荐信息(下)必须填写',
        //     'content.required'=>'商品内容不能为空'
        // ]);


        $goods = Goods::find($id);

        //获取缩略图
        if($request->hasFile('img')) {
            //接收图片
            $file = $request->file('img');
            //获取文件原始名称
            $filename = time() . '_' .rand(1000000,9999999).'_'.$file->getClientOriginalName();

            if(!is_dir('/uploads/'.date('Ymd'))){
                //上传原始图片
               $path = $request->file('img')->store(date('Ymd'));
            } 
            //上传mid规格图片
            $img = \Image::make($file)->resize(60, 60)->save(public_path('/uploads/'.date('Ymd').'/'.'img_small_'.$filename));
            //上传big规格图片
            $img = \Image::make($file)->resize(400, 400)->save(public_path('/uploads/'.date('Ymd').'/'.'img_big_'.$filename));
            // 原图
            $goods->img = 'uploads/'.$path;
            // 小图
            $goods->img_small = 'uploads/'.date('Ymd').'/'.'img_small_'.$filename;
            // 中图
            $goods->img_big = 'uploads/'.date('Ymd').'/'.'img_big_'.$filename;
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
        // 商品内容
        $goods->content = $request->input('content');

        //执行添加数据
        $row = $goods->save();

        if($row) {
            return redirect('admin/goods')->with('success','修改数据成功');
        } else {
            return back()->with('error','修改数据失败');
        }
    }

    /**
     * 删除商品
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //接收id
        $row = Goods::destroy($id);

        // 根据商品gid删除型号
        $models_data = Models::where('gid','=',$id)->get();
        
        // 遍历该商品id的所有型号
        foreach($models_data as $k=>$v) {
            // 根据型号id删除所有型号
            Models::where('gid','=',$id)->delete();
            // 遍历该商品id的所有大小
            $sizes = Sizes::where('mid','=',$v->id)->get();
            foreach($sizes as $kk=>$vv) {
                // 根据型号id删除所有大小
                Sizes::where('mid','=',$vv->mid)->delete();
            }
         }

        if($row) {
            // 删除成功
            echo json_encode(['msg'=>'ok']);
        } else {
            // 删除失败
            echo json_encode(['msg'=>'err']);
        }
    }

    /**
     * 商品推荐
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setRecommend($id)
    {
        // 接收商品id
        $id = $id;
        // 修改商品推荐值
        $goods = Goods::find($id);

        if($goods->is_recommend) {
            // 设置为不推荐
            $goods->is_recommend = '0';
        } else {
            //设置为推荐
            $goods->is_recommend = '1';
        }
        // 返回受影响行数
        $row = $goods->save();


        if($row) {
            echo json_encode(['msg'=>'ok']);
        } else {
            echo json_encode(['msg'=>'err']);
        }
    }
}
    