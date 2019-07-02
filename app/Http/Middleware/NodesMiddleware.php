<?php

namespace App\Http\Middleware;

use Closure;

class NodesMiddleware
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
        // 获取 session  获取可以操作的控制器 和 方法名
        $nodes = session('admin_nodes_data');
        // 获取 控制器 名
        $controller_all = array_keys($nodes);  
        // dump($nodes);
        // 获取正在操作的控制器 和 方法名
        $actions=explode('\\', \Route::current()->getActionName());
        //或$actions=explode('\\', \Route::currentRouteAction());
        $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
        $func=explode('@', $actions[count($actions)-1]);
        // 将 控制器大写字母转为小写
        $controllerName=strtolower($func[0]);
        // 将 方法名大写字母转为小写
        $actionName=strtolower($func[1]);
        
      
        // 判断 可以操作的控制器 是否在 正在 操作的 控制器中
        if(!in_array($controllerName,$controller_all)){
            // echo '没有权限---控制器';
            // exit;
            // 跳转 到 没有 权限 页面
            return redirect('admin/rbac');
            exit;
        }
        // 获取 可以 操作的方法名
        $action_all = $nodes[$controllerName];
         // 判断 可以操作的方法名 是否在 正在 操作的 方法名中
         if(!in_array($actionName,$action_all)){
            // echo '没有权限---方法名';
            // exit;
            // 跳转 到 没有 权限 页面
             return redirect('admin/rbac');
             exit;
        }
        // dump($controllerName);
        // dump($actionName);
        return $next($request);
    }
}
