<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Replys;

class ReplysController extends Controller
{
    /**
     * 显示 留言 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //接收搜索关键字
        $keywords = $request->input('keywords','');

        $replys = Replys::paginate(4);

    	return view('admin.replys.index',['replys'=>$replys]);
    }

    /**
     * 显示 留言内容 详情
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 返回公告ajax数据
        if(Replys::find($id)) {
            // 请求成功
            // 该id用户留言内容
            $content = Replys::find($id)->content;
            // 该id用户名
            $uname = Replys::find($id)->replyuser->uname;
            // 该id用户购买商品名称
            $gname = Replys::find($id)->goodsuser->title;
            // 该用户留言时间
            $time = Replys::find($id)->time;

            echo json_encode(['msg'=>'ok','info'=>['content'=>$content,'uname'=>$uname,'gname'=>$gname,'time'=>$time]]);
        } else {
            // 请求失败
            echo json_encode(['msg'=>'err']);
        }
    }
}
