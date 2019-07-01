<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use App\Models\Users;
use App\Models\UserLogin;
use Hash;
use Mail;
use DB;

class RegisterController extends Controller
{
    /**
     * 手机和邮箱 注册 页面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 显示 手机和邮箱 注册页面
        return view('home.register.index');
    }

    /**
     * 手机 验证
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }
    
    /**
     * 手机号 注册
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // dd($request->token);
       
        // 接收 所有 值
        $phone = $request->input('phone');
        $code = $request->input('code');
         $k = $phone.'_code';
        $phone_code = session($k);
        if($code !=$phone_code){
           // echo "<script>alert('验证码错误');location.href='/home/register'</script>";
            echo json_encode(['msg'=>'err']);
            exit;
        }
       $data = $request->all();

       $user = new Users;
       // 获取 用户名 和 输入框的用户名 比较
        $users_data = Users::where('uname',$request->input('uname'))->first();

        // 检测 用户名 是否 存在
        if (!empty($users_data)) {
             echo json_encode(['msg'=>'error','info'=>'用户名已经存在~']);
             exit;
        }

       $user->uname = $request->input('uname','');

       // 给 token 随机50位字符
       $user->token = str_random(50);

       $user->phone =$request->input('phone','');
       // 给 密码 加密
       $user->upass = Hash::make($data['upass']);
        // 将数据 存入到 数据库
       $res1 = $user->save();

       if($res1){
       
         // echo "<script>alert('注册成功');location.href='/home'</script>";
         echo json_encode(['msg'=>'ok']);
         exit;
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     /**
     *  激活 用户 (邮箱)
     *
     * @param  激活 用户 (邮箱)
     * @return \Illuminate\Http\Response
     */
    public function chengeStatus($id,$token)
    {
        //获取 用户 信息
         $user = Users::find($id);
         if($user->token != $token){
            // 如果 token不一致 返回错误 图片
           return  view('home.register.error');
         }
         // 修改 激活状态
         $user->status = 1;
         // 重新 给 token 赋值
         $user->token = str_random(50);
         // 将 数据 保存 到数据库
         $res = $user->save();
         if($res){
            // 激活 成功 返回 成功图片
            return view('home.register.success');
         }else{
            // 激活 失败 返回 错误图片
            return  view('home.register.error');
         }       
    }
     /**
     * 邮箱 注册 方法
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function email(Request $request)
    {
        // 接收 邮箱 值        
        $email = $request->input('email','');
        $user = new Users;    

         // 获取 邮箱 和 输入框的邮箱 比较
        $users_data = Users::where('email',$email)->first();

        // 检测 邮箱名 是否 存在
        if (!empty($users_data)) {
             echo json_encode(['msg'=>'error','info'=>'邮箱已经存在~']);
             exit;
        }

        // 没有 uname的值 默认随机字符串
        $user->uname = str_random(10);
        $user->phone = $request->input('phone','');
        $user->email = $email;
        $user->token = str_random(50);
        $user->upass = Hash::make($request->input('upass',''));
        // 将数据 存入到 数据库
       $res = $user->save();
        // 判断 如果添加成功 再发送 邮件      
       if($res){
             //echo "<script>alert('注册成功');location.href='/home'</script>";
            // echo json_encode(['msg'=>'ok']);
              // 发送 邮箱
              
            Mail::send('home/register.mail', ['id' => $user->id,'token'=>$user->token], function ($m) use ($email) {
               // to 要发送 地址  subject 发送邮件的标题

               $s = $m->to($email)->subject('【MYSHOP】提醒邮件!');

               // 判断 是否发送成功
               if($s){
                   echo json_encode(['msg'=>'ok']);
                  
               }
            });
        }           
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  验证 手机验证码
     * @return \Illuminate\Http\Response
     */
    public function phone(Request $request)
    {
        $phone = $request->input('phone');
       
        // 验证码随机数
        $code = rand(1234,4321);
        // 将 验证码存入到session中
        $k = $phone.'_code';
         session([$k=>$code]);
        // 发送 获取 手机验证码
         $url = "http://v.juhe.cn/sms/send";
         $params = array(
            'key'   => '0aa424d347e3983869b9a56f375d9863', //您申请的APPKEY
            'mobile'    => $phone, //接受短信的用户手机号码
            'tpl_id'    => '166001', //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>'#code#='.$code, //您设置的模板变量，根据实际情况修改
            'dtype' => 'json'
         );

        $paramstring = http_build_query($params);
        $content = self::juheCurl($url, $paramstring);
        // 返回 json格式
        echo $content;
        // $result = json_decode($content, true);
        // if ($result) {
        //     var_dump($result);
        // } else {
        //     //请求异常
        // }


    }

            /**
         * 请求接口返回内容
         * @param  string $url [请求的URL地址]
         * @param  string $params [请求的参数]
         * @param  int $ipost [是否采用POST形式]
         * @return  string
         */
        public static function juheCurl($url, $params = false, $ispost = 0)
        {
            $httpInfo = array();
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            if ($ispost) {
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                curl_setopt($ch, CURLOPT_URL, $url);
            } else {
                if ($params) {
                    curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
                } else {
                    curl_setopt($ch, CURLOPT_URL, $url);
                }
            }
            $response = curl_exec($ch);
            if ($response === FALSE) {
                //echo "cURL Error: " . curl_error($ch);
                return false;
            }
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
            curl_close($ch);
            return $response;
        } 

}
