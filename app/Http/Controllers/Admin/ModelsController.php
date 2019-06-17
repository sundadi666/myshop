<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModelsController extends Controller
{
    //
    public function store(Request $request)
    {
    	//接收商品型号名称
    	$models = new Models();
    	$models -> 
    	$request->input('mname');
    }
}
