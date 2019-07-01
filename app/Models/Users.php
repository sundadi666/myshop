<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    // 声明 用户 数据库 名称
    public $table = 'users';
    // 创建 用户和用户详情 一对一 关系
    public function usersinfos()
    {
    	return $this->hasOne('App\Models\UsersInfos','uid');
    }

    // 建立商品 和 用户 和 收藏表 属于关系
    public function usergoods()
    {
        return $this->belongsToMany('App\Models\Goods', 'collects', 'uid', 'gid');
    }

    // 建立 用户 和 订单 一对多关系
    public function userorders()
    {
        return $this->hasMany('App\Models\Orders','uid');
    }
}
