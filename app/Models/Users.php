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
}
