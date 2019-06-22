<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
	//定义商品表
    public $table = 'models';

    // 建立型号 和 大小 一对多
    public function modelsize()
    {
    	return $this->hasMany('App\Models\Sizes','mid');
    }
}
