
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Color Admin | Login Page</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}"> 
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="/d/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="/d/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/d/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/d/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/d/assets/css/style.min.css" rel="stylesheet" />
	<link href="/d/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/d/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	<link rel="stylesheet" href="/layui/css/layui.css">
        <script src="/layui/layui.js"></script>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/d/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<script>
//一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
    });
</script> 
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<div class="login-cover">
	    <div class="login-cover-image"><img src="/d/assets/img/login-bg/bg-1.jpg" data-id="login-cover-image" alt="" /></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
	    <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> 后台 登陆
                    <small>responsive bootstrap 3 admin template</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
            </div>
            <!-- end brand -->
            <div class="login-content">
                <form action="" method="POST" class="margin-bottom-0" id="login">
                    <div class="form-group m-b-20">
                        <input type="text" name="uname" id="uname" class="form-control input-lg" placeholder="用户名" required />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" name="upass" id="upass" class="form-control input-lg" placeholder="密码" required />
                    </div>
                   
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">登陆</button>
                    </div>
                    <div class="m-t-20">
                        Not a member yet? Click <a href="#">here</a> to register.
                    </div>
                </form>
            </div>
        </div>
        <!-- end login -->
        
        <ul class="login-bg-list clearfix">
            <li class="active"><a href="#" data-click="change-bg"><img src="/d/assets/img/login-bg/bg-1.jpg" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="/d/assets/img/login-bg/bg-2.jpg" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="/d/assets/img/login-bg/bg-3.jpg" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="/d/assets/img/login-bg/bg-4.jpg" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="/d/assets/img/login-bg/bg-5.jpg" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="/d/assets/img/login-bg/bg-6.jpg" alt="" /></a></li>
        </ul>
        
       
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/d/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/d/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/d/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="/d/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="/d/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="/d/assets/crossbrowserjs/respond.min.js"></script>
		<script src="/d/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/d/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/d/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/d/assets/js/login-v2.demo.min.js"></script>
	<script src="/d/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
    <script type="text/javascript">
     $('#login').submit(function(){
                let uname = $('#uname').val();
                let upass = $('#upass').val();
                
               // 验证 输入框不能为空
                 if(uname==''){
                    layer.msg('输入框不能为空')
                    return false;
                }
                 // 验证 密码 的格式
                   let uname_preg = /^[a-zA-Z]{1}[\w]{5,17}$/;
                   if(!uname_preg.test(uname)){
                    layer.msg('用户名格式错误')
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
                $.post('/admin/dologin',{uname,upass},function(res){
                    console.log(res)
                    if(res.msg == 'err'){                       
                             layer.msg(res.info);
                            
                        }else{
                             layer.msg(res.info);
                             window.location.href = "/admin";
                        }       
                 },'json')
                
                return false;
            })
      

    </script>
	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53034621-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
