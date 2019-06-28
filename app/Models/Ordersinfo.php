<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordersinfo extends Model
{
    // 声明 一下是操作那个表的
    public $table = "orders_info";

   	// 查找 商品 名称
   	public function goods()
   	{
   		return $this->belongsTo('App\Models\Goods','gid');
   	}

   	// 查找 购买商品 的型号
   	public function models()
   	{
   		return $this->belongsTo('App\Models\Models','mid');
   	}

   	// 查找 购买商品 的大小
   	public function sizes()
   	{
   		return $this->belongsTo('App\Models\Sizes','sid');
   	}
}
