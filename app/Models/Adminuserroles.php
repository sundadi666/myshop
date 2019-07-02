<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adminuserroles extends Model
{
    // 创建 后台用户和角色关系表模型
    public $table = 'adminuser_roles';
    // 角色 属于 哪个 用户
    public function rolesdata()
    {
    	return $this->belongsTo('App\Models\Roles','rid');
    }
}
