<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //定义商品表
    public $table = 'goods';


    public function brands_data()
    {
    	return $this->belongsTo('App\Models\Brands','bid');
    }

    // 建立商品 和 型号 一对多
    public function goodsmodel()
    {
    	return $this->hasMany('App\Models\Models','gid');
    }

    // 建立商品 和 属性 一对多
    public function goodsattribute()
    {
    	return $this->hasMany('App\Models\Attributes','gid');
    }

    // 建立商品 和 订单详情 一对一关系
    public function goodsorderinfo()
    {
        return $this->hasOne('App\Models\Ordersinfo','gid');
    }

    // 建立 商品 和 型号 属于关系
}
