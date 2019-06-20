<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{	
	
    // 查找用户名称的名称
    public function users()
    {
    	 return $this->belongsTo('App\Models\Users','uid');
    }
   	
  

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
