<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adminuser extends Model
{
    // 指定后台用户模型表名
    public $table = 'admin_users';

    public function adminuserroles()
    {
    	return $this->hasOne('App\Models\adminuserroles','uid');
    
    }
}
