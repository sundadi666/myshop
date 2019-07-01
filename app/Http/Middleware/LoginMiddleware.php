<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 判断 后台 登陆中间件 如果没登陆就跳转登陆页面
        if(session('admin_login')){
             return $next($request);
         }else{
            return redirect('admin/login');
         }
       
    }
}
