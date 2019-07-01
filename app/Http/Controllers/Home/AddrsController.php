<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Addrs;
use DB;
use App\Models\Links;
use App\Models\Footer;
use App\Models\Navigates;


class AddrsController extends Controller
{
    /**
     * 显示 用户的 收货地址
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // 判断 用户 是否登录
        if (!session('home_login')) {
            return redirect('home/login');
        }

        $id = session('userinfo')->id;

        $addrs_data = Addrs::where('uid',$id)->get();

        // dd($addrs_data);
        
        // 友情连接 的数据
        $links_data = Links::all();

        // 获取 网站底部 数据
        $footer_data = Footer::first();

        // 获取 导航栏 数据
        $navigates_data = Navigates::all();

        return view('home.addrs.index',['navigates_data'=>$navigates_data,'footer_data'=>$footer_data,'links_data'=>$links_data,'addrs_data'=>$addrs_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存要用户的 收货地址
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addrs = new Addrs;

        // 接收 数值
        $addrs->uname = $request->input('uname','');
        $addrs->uid   = $request->input('uid','');
        $addrs->phone = $request->input('phone','');
        $addrs->province = $request->input('province','');
        $addrs->ctiy  = $request->input('ctiy','');
        $addrs->area  = $request->input('area','');
        $addrs->details = $request->input('details','');

        // 执行插入
        $res = $addrs->save();

        if($res){
            return back()->with('success','添加成功');
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
     * 查询 要修改的 参数
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $addrs_edit = Addrs::where('id',$id)->first();

        // 判断 是否 查询到数值
        if($addrs_edit){
            echo json_encode($addrs_edit);
        }

    }

    /**
     * 保存 要修改的 数据
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
        $addrs_data = Addrs::find($id);

        // 保存 数据
        $addrs_data->uname = $request->input('uname','');
        $addrs_data->phone = $request->input('phone','');
        $addrs_data->details = $request->input('details','');

        // 保存
        $res = $addrs_data->save();

        // 判断是否成功
        if($res){
            return back()->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
        //
    }

    /**
     * 删除用户的地址
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // 执行 删除命令
        $res = Addrs::destroy($id);
        
        // 判断 是否 执行成功
        if ($res) {
            echo "ok";  
        } else {
            echo "error";
        }
    }

    /* 修改用户的默认收货地址
     *
     */
    public function editaddrs(Request $request)
    {
        DB::beginTransaction();

        // 接收 要修改的数据
        $oldid = $request->input('oldid');
        $newid = $request->input('newid');

        // 修改 要保存的数据
        $oldres = DB::table('addrs')->where('id',$oldid)->update(['default' => '0']);
        $newres = DB::table('addrs')->where('id',$newid)->update(['default' => '1']);
        
        // 判断是否成功
        if ($oldres && $newres) {
            DB::commit();
            echo json_encode(['msg'=>'ok']);
        } else {
            DB::rollBack();
        }

    }

}
