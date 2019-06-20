<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    // 
    public $table = "brands";

    public function goods_data()
    {
    	 return $this->hasMany('App\Models\Goods','bid');
    }

}
