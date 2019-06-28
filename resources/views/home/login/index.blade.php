
<!DOCTYPE html>
<html>

	<head lang="en">
		<meta charset="UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}"> 
		<title>登录</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" />
		<link href="/h/css/dlstyle.css" rel="stylesheet" type="text/css">
		<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<link rel="stylesheet" href="/layui/css/layui.css">
     	<script src="/layui/layui.js"></script>
	</head>

	<body>
<script>
//一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
    });
</script> 
		<div class="login-boxtitle">
			<a href="home.html"><img alt="logo" src="/h/images/logobig.png" /></a>
		</div>

		<div class="login-banner">
			<div class="login-main">
				<div class="login-banner-bg"><span></span><img src="/h/images/big.jpg" /></div>
				<div class="login-box">

							<h3 class="title">登录商城</h3>

					<div class="clear"></div>
						
						<div class="login-form">
						<form action="" method="post" id="one">
							{{csrf_field()}}
						  <div class="user-name">
						    <label for="user">
						      <i class="am-icon-user"></i>
						    </label>
						    <input type="text" name="login" id="login" placeholder="用户名/手机号/邮箱"></div>
						     
						    
						    
						  <div class="user-pass">
						    <label for="password">
						      <i class="am-icon-lock"></i>
						    </label>
						    <input type="password" name="upass" id="password" placeholder="请输入密码"></div>
						  <div class="am-cf">
						    <input type="submit" value="登 录" class="am-btn am-btn-primary am-btn-sm"></div>
						</form>
         		  </div>
            
           		 <div class="login-links">
              	  <label for="remember-me"><input id="remember-me" type="checkbox">记住密码</label>
							<a href="#" class="am-fr">忘记密码</a>
							<a href="/home/register" class="zcnext am-fr am-btn-default">注册</a>
								<br />
           		 </div>
						<div class="partner">		
								<h3>合作账号</h3>
							<div class="am-btn-group">
								<li><a href="#"><i class="am-icon-qq am-icon-sm"></i><span>QQ登录</span></a></li>
								<li><a href="#"><i class="am-icon-weibo am-icon-sm"></i><span>微博登录</span> </a></li>
								<li><a href="#"><i class="am-icon-weixin am-icon-sm"></i><span>微信登录</span> </a></li>
							</div>
						</div>	

				</div>
			</div>
		</div>


					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="# ">商城首页</a>
								<b>|</b>
								<a href="# ">支付宝</a>
								<b>|</b>
								<a href="# ">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="# ">关于恒望</a>
								<a href="# ">合作伙伴</a>
								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>© 2015-2025 Hengwang.com 版权所有</em>
							</p>
						</div>
					</div>
			</body>
			<script type="text/javascript">
				
			// 登陆 前台 ajax
			$('#one').submit(function(){
				let login = $('#login').val();
				let upass = $('#password').val();
				
				// // 验证 输入框不能为空
				 if(login==''){
		            layer.msg('输入框不能为空')
		            return false;
		        }
				   // 判断 两次密码 不能为空
		        if(upass==''){
		            layer.msg('密码不能为空')
		            return false;
		        }
		        
		        // 验证 密码 的格式
		       	   let upass_preg = /^\w{6,18}$/;
		       	   if(!upass_preg.test(upass)){
		       	   	layer.msg('密码格式错误')
		       	   	return false;
		       	   }
		       	   // 引入 ajax 插件
					 $.ajaxSetup({
			            headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			             }
				        });
				// 发送 ajax 
				$.post('/home/login/login',{login,upass},function(res){
					if(res.msg == 'err' || res.msg == 'error'){	

					   		 layer.msg('账号或密码不正确');
					   		 // 等 2秒钟之后 再 跳转
								setTimeout(function(){	    
			                	 window.location.href = '/home/login';
			               		 },1500);					   							   		 
					   	}else{
					   		
					   		 layer.msg(res.info);
					   		 window.location.href = "/home";
					   	}		
				 },'json')
				
				return false;
			})
		</script>

</html>


<!-- 
<script>
	
	var login = ;

	
var patt = /\d/;
var patt2 = /\d/;
var patt3 = /\d/;
	if(patt.test(login) || patt2.test(login)  || patt3.test(login) ){
	
		//发送ajax .login
		//
		
	}else{
		//tankuang
	}

</script> -->