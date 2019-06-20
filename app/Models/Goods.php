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
}
