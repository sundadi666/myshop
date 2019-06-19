<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReplysController extends Controller
{
    /**
     * 显示 留言 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	return view('admin.replys.index');
    }
}
