<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Replys extends Model
{
    // 创建 用户和留言内容 属于关系
    public function replyuser()
    {
    	return $this->belongsTo('App\Models\users','uid');
    }

    // 创建 商品和留言内容 属于关系
    // public function goodsuser()
    // {
    // 	return $this->belongsTo('App\Models\goods','gid');
    // }

    // 创建 评论 和 商品 属于关系
    public function replygoods()
    {
        return $this->belongsTo('App\Models\goods','gid');
    }
}
