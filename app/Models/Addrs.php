<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addrs extends Model
{
    //
    
   	// 查询users 表的信息
   	public function user_data()
   	{
   		return $this->belongsTo('App\Models\Users','uid');
   	}
}
