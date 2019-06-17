
<!DOCTYPE html>
<html>

	<head lang="en">
		<meta name="csrf-token" content="{{ csrf_token() }}"> 
		<meta charset="UTF-8">
		<title>注册</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		<meta name="renderer" content="webkit">
		<meta http-equiv="Cache-Control" content="no-siteapp" />

		<link rel="stylesheet" href="/h/AmazeUI-2.4.2/assets/css/amazeui.min.css" />
		<link href="/h/css/dlstyle.css" rel="stylesheet" type="text/css">
		<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.min.js"></script>
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
			<a href="home/demo.html"><img alt="" src="/h/images/logobig.png" /></a>
		</div>

		<div class="res-banner">
			<div class="res-main">
				<div class="login-banner-bg"><span></span><img src="/h/images/big.jpg" /></div>
				<div class="login-box">				
						<div class="am-tabs" id="doc-my-tabs">
							<ul class="am-tabs-nav am-nav am-nav-tabs am-nav-justify">
								<li class="am-active"><a href="">邮箱注册</a></li>
								<li><a href="">手机号注册</a></li>
							</ul>

							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
							<form action="" method="post" id="one">
								{{ csrf_field() }}
								  
								  <div class="user-email">
								    <label for="email">
								      <i class="am-icon-envelope-o"></i>
								    </label>
								    <input type="email" name="email" id="email" placeholder="请输入邮箱账号"></div>
								  <div class="user-pass">
								    <label for="password">
								      <i class="am-icon-lock"></i>
								    </label>
								    <input type="password" name="upass" id="password1" placeholder="设置密码"></div>
								  <div class="user-pass">
								    <label for="passwordRepeat">
								      <i class="am-icon-lock"></i>
								    </label>
								    <input type="password" name=repass" id="passwordRepeat1" placeholder="确认密码"></div>
								    <div class="am-cf">
											<input type="submit"  value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
										</div>
							</form>
                 
								 <div class="login-links">
										<label for="reader-me">
											<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
										</label>
							  	</div>
										

								</div>

								<div class="am-tab-panel">
					<form action="" method="post" name="reg" id="two">
						{{ csrf_field() }}
							<div class="user-phone">
							<label for="phone">
							<i class="am-icon-mobile-phone am-icon-md"></i>
							</label>
							<input type="tel" name="uname" id="uname" placeholder="用户名"></div>
							<div class="user-phone">
							<label for="phone">
							<i class="am-icon-mobile-phone am-icon-md"></i>
							</label>
							<input type="tel" name="phone" id="phone" placeholder="请输入手机号"></div>
							<div class="verification">
							<label for="code">
							<i class="am-icon-code-fork"></i>
							</label>
							<input type="tel" name="code" id="code" placeholder="请输入验证码">
							<a class="btn" href="javascript:void(0);" onClick="sendMobileCode(this);" id="sendMobileCode">
							<span id="dyMobileButton">获取</span></a>
							</div>
							<div class="user-pass">
							<label for="password">
							<i class="am-icon-lock"></i>
							</label>
							<input type="password" name="upass" id="password2" placeholder="设置密码"></div>
							<div class="user-pass">
							<label for="passwordRepeat">
							<i class="am-icon-lock"></i>
							</label>
							<input type="password" name="repass" id="passwordRepeat2" placeholder="确认密码"></div>
							
								<input type="submit" value="注册" class="am-btn am-btn-primary am-btn-sm am-fl">
						
						</form>
								 <div class="login-links">
										<label for="reader-me">
											<input id="reader-me" type="checkbox"> 点击表示您同意商城《服务协议》
										</label>
							  	</div>
										
									<hr>
								</div>
								<!-- 替换 手机和邮箱form表单 开始 -->
								<script>
									$(function() {
									    $('#doc-my-tabs').tabs();
									  })									
								</script>
								<!-- 替换 手机和邮箱form表单 结束 -->

								<!-- 发送 ajax 开始  -->
								<script type="text/javascript">
									// 手机 注册
									$('#two').submit(function(){

										// 数据验证
										// var preg_uname = ''
										let uname= $('form input[name=uname]').val();
										let upass = $('#password2').val();
										let repass = $('#passwordRepeat2').val();
										let phone = $('form input[name=phone]').val();
										// 获取 输入
										let code = $('form input[name=code]').val();

										let ptn = /^[a-zA-Z]{1}[\w]{5,17}$/;
								        if(ptn.test(uname) == false){
								           layer.msg('用户名格式错误');
								            return false;          
								       	  }
										  // 正则验证 手机 格式
											let phone_preg = /^1{1}[3-9]{1}[\d]{9}$/;
											// 判断 如果不通过 就不发送 ajax
											if(!phone_preg.test(phone)){
												// 不往下执行
												layer.msg('手机号格式不正确')
												return false;
											}
											// 判断 验证码不能为空
											 if(code ==''){
								            layer.msg('验证码不能为空');
								            return false;
								       	   }

								       	  
								       	   // 判断 两次密码 不能为空
								        if(upass==''&& repass==''){
								            layer.msg('密码不能为空')
								            return false;
								        }


								       	   let upass_preg = /^\w{6,18}$/;
								       	   if(!upass_preg.test(upass)){
								       	   	layer.msg('密码格式错误')
								       	   	return false;
								       	   }
										
								       
								        if(upass != repass){
								            layer.msg('俩次密码不一致');
								           return false;
								        }
								       
								        if(uname==''){
								            layer.msg('用户名不能为空');
								            return false;
								        }
								      
								        	// 引入 ajax 插件
											 $.ajaxSetup({
										            headers: {
										                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										            }
										        });
										// 发送ajax
										$.post('/home/register',{uname,upass,code,phone},function(res){
											console.log(res);
											if(res.msg == 'ok') {
												layer.msg('注册成功');
											} else {
												layer.msg('验证码错误');
											}
										},'json')

										return false;
									})
								</script>
								<!-- 手机注册 发送 ajax 结束  -->
								<!-- 邮箱注册 发送 ajax 开始 -->
								<script type="text/javascript">
									// 邮箱 注册
									$('#one').submit(function(){
										let email = $('form input[name=email]').val();
										let upass = $('#password1').val();
										let repass = $('#passwordRepeat1').val();
										// 验证 邮箱 格式
										let email_preg = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
										if(!email_preg.test(email)){
											layer.msg('邮箱格式错误');
											return false;
										}
										   // 判断 两次密码 不能为空
								        if(upass==''&& repass==''){
								            layer.msg('密码不能为空')
								            return false;
								        }
								        // 判断 两次密码是否一致
								         if(upass != repass){
								            layer.msg('俩次密码不一致');
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
										$.post('/home/register/email',{email,upass},function(res){
										if(res.msg == 'ok') {
												layer.msg('注册成功');
											} else {
												layer.msg('验证码错误');
											}
										},'json')
										
										return false;
									})
								</script>
								<!-- 邮箱注册 发送 ajax 结束 -->
								<!-- 发送 ajax 获取手机验证码 开始-->
								<script type="text/javascript">
									function sendMobileCode(obj){
																			
										// 给 这个对象添加属性
										$(obj).attr('disabled',true);							
										// 给属性 颜色为 灰色
										$(obj).css('color','#ccc')
										// 给属性 添加 鼠标
										$(obj).css('cursor','no-drop')
										// 定义个 时间 变量
										  let time = null;
										// 判断 如果属性 disabled存在 开始 倒计时
										if($(obj).find('span').html()=='获取'){
											// 设置 倒计时 秒数
											let i=5;
											time = setInterval(function(){
												i--;
												$(obj).find('span').html('('+i+')s')
												// 判断 如果i小于1时 可以再次点击
												if(i<1){
													// 给 这个对象添加属性
													$(obj).attr('disabled',false);							
													// 给属性 颜色为 灰色
													$(obj).css('color','#ccc')
													$(obj).css('cursor','pointer')
													$(obj).find('span').html('获取')

												// 清除 倒计时
												clearInterval(time)

												}
											},1000);
											
											// 接收 phone 值 
											let phone = $('#phone').val();
											// 正则验证 手机 格式
											let phone_preg = /^1{1}[3-9]{1}[\d]{9}$/;
											// 判断 如果不通过 就不发送 ajax
											if(!phone_preg.test(phone)){
												// 不往下执行
												layer.msg('手机号格式不正确')
												return false;
											}
											// 引入 ajax 插件
											 $.ajaxSetup({
										            headers: {
										                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
										            }
										        });

											// 发送 ajax 发送验证码
										  $.post('/home/register/phone',{phone},function(res){
										  	if(res.error_code == 0){
										  		layer.msg('发送成功,有效时间10分种');
										  	}else{
										  		layer.msg('发送失败');
										  	}
										  },'json')
										}
										
										
									}
								</script>
							<!-- 发送 ajax 获取手机验证码 结束-->
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

</html>