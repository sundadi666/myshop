 <!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Admin</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="/d/assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="/d/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/d/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/d/assets/css/animate.min.css" rel="stylesheet" />
	<link href="/d/assets/css/style.min.css" rel="stylesheet" />
	<link href="/d/assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="/d/assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="/d/assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="/d/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <!-- <link href="/d/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" /> -->
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/d/assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- header 开始 -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- 手机端侧边栏 开始/ 伸缩建  -->
				<div class="navbar-header">
					<a href="/admin" class="navbar-brand"><span class="navbar-logo"></span> Color Admin</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- 手机端侧边栏 结束/ 伸缩建 -->
				
				<!-- 导航栏右侧部分 开始 -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form class="navbar-form full-width">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="搜索" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>

					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<!-- 如果 登陆成功 显示管理员信息 -->
							@if(session('admin_login'))

							<img src="/uploads/{{session('admin_userinfo')->profile ? session('admin_userinfo')->profile : ''}}"  alt="" /> 							
							<span class="hidden-xs">{{session('admin_userinfo')->uname}}</span> <b class="caret"></b>
							@endif
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="javascript:;" onclick="update_profile()">修改头像</a></li>
							<li><a href="javascript:;" onclick="update_upass()">修改密码</a></li>
							<li class="divider"></li>
							<li><a href="/admin/logout">退出</a></li>
						</ul>
					</li>
				</ul>
				<!-- 导航栏右侧部分 结束 -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- header 结束 -->
		
		<!-- 侧边栏 开始 -->
		<div id="sidebar" class="sidebar">
			<div data-scrollbar="true" data-height="100%">
				


				<!-- 侧边栏用户头像 开始 -->
				<ul class="nav">
					<li class="nav-profile">
				<!-- 如果 登陆成功 显示信息 -->
					@if(session('admin_userinfo'))	
						<div class="info">
							管理员:{{session('admin_userinfo')->uname}}
							
						</div>
					@endif	
					</li>
				</ul>
				<!-- 侧边栏用户头像 结束 -->
				
				<!-- 侧边栏导航 开始 -->
				<ul class="nav">
					<li class="nav-header">导航</li>
					<li class="has-sub active">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						   <i class="fa fa-2x fa-user"></i>
						    <span>用户管理</span>
					    </a>
						<ul class="sub-menu">
						    <li class="active"><a href="/admin/users">用户列表</a></li>
						    <li><a href="/admin/users/create">用户添加</a></li>
						</ul>
					</li>
					
					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-suitcase"></i>
						    <span>友情链接管理</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/links">查看友情链接</a></li>
							<li><a href="/admin/links/create">添加友情链接</a></li>
						</ul>
					</li>
					
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-2x fa-bookmark"></i>
						    <span>秒杀管理 <span class="label label-theme m-l-5">NEW</span></span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/seckill">秒杀列表</a></li>
							<li><a href="/admin/seckill/create">秒杀添加</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-2x fa-bookmark"></i>
						    <span>公告管理 <span class="label label-theme m-l-5">NEW</span></span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/news">公告列表</a></li>
							<li><a href="/admin/news/create">公告添加</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-2x fa-users"></i>
						    <span>网站底部管理</span>
					    </a>
						<ul class="sub-menu">
						    <li class="active"><a href="/admin/footer">网站底部列表</a></li>
						    <li><a href="/admin/footer/create">网站底部添加</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
						    <i class="fa fa-suitcase"></i>
						    <span>导航管理</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/navicates">查看导航</a></li>
							<li><a href="/admin/navicates/create">添加导航</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
							<i class="fa fa-2x fa-gift"></i>
						    <span>分类管理</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/cates">分类列表</a></li>
							<li><a href="/admin/cates/create">分类添加</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
							<i class="fa fa-2x fa-gift"></i>
						    <span>轮播图管理</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/banners">轮播图列表</a></li>
							<li><a href="/admin/banners/create">轮播图添加</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
							<i class="fa fa-2x fa-gift"></i>
						    <span>商品管理</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/goods">商品列表</a></li>
							<li><a href="/admin/goods/create">商品添加</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
							<i class="fa fa-2x fa-gift"></i>
						    <span>留言管理</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/replys/index">留言列表</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
							<i class="fa fa-2x fa-database"></i>
						    <span>品牌管理</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/brands">品牌列表</a></li>
							<li><a href="/admin/brands/create">品牌添加</a></li>
						</ul>
					</li>
					
					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
							<i class="fa fa-2x fa-database"></i>
						    <span>订单管理</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/orders">查看订单</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
							<i class="fa fa-2x fa-male"></i>
						    <span>管理员</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/adminuser">管理员列表</a></li>
							<li><a href="/admin/adminuser/create">管理员添加</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
							<i class="fa fa-2x fa-sitemap"></i>
						    <span>角色管理</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/roles">角色列表</a></li>
							<li><a href="/admin/roles/create">角色添加</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
						    <b class="caret pull-right"></b>
							<i class="fa fa-2x fa-sitemap"></i>
						    <span>权限管理</span> 
						</a>
						<ul class="sub-menu">
							<li><a href="/admin/nodes">权限列表</a></li>
							<li><a href="/admin/nodes/create">权限添加</a></li>
						</ul>
					</li>


					<!-- 侧边栏 缩放按钮 开始 -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					<!-- 侧边栏 缩放按钮 结束 -->
				</ul>
				<!-- 侧边栏导航 结束 -->
			</div>
		</div>
		<div class="sidebar-bg"></div>
		<!-- 侧边栏 结束 -->
		
		<div id="content" class="content">
			

			<!-- 内容 开始 -->
			@if(session('success'))
			     <div class="alert alert-success fade in m-b-15">
			      <strong>Success!</strong>
			      {{ session('success') }}
			      <span class="close" data-dismiss="alert">×</span>
			     </div>
			    @endif

			    @if(session('error'))
			    <div class="bs-example" data-example-id="dismissible-alert-css">
			        <div class="alert alert-danger fade in m-b-15">
			      <strong>Error!</strong>
			      {{ session('error') }}
			      <span class="close" data-dismiss="alert">×</span>
			     </div>
		   		@endif

			
				@section('content')
					


				@show
			</div>
			<!-- 内容 结束 -->
			
		</div>		
	</div>
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/d/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="/d/assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="/d/assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="/d/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/d/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/d/assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<!-- <script src="/d/assets/plugins/gritter/js/jquery.gritter.js"></script> -->
	<script src="/d/assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="/d/assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="/d/assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="/d/assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="/d/assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="/d/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="/d/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="/d/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="/d/assets/js/dashboard.min.js"></script>
	<script src="/d/assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script type="text/javascript">
			function update_profile()
			{
				$('#myModal1').modal('show');
			}
			function update_upass()
			{
				$('#myModal').modal('show');
			}
	</script>
	<script>
		$(document).ready(function() {
			App.init();
			Dashboard.init();
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
<!-- 如果 登陆 可以操控修改头像 -->
@if(session('admin_userinfo'))
	<!-- 修改头像的模态框开始 -->
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">修改头像</h4></div>
		      <div class="modal-body">
		        <div class="form-grids row widget-shadow" data-example-id="basic-forms">
		          <div class="form-body">
		            <form action="/admin/users/update_profile/{{session('admin_userinfo')->id}}" method="post" enctype="multipart/form-data">{{ csrf_field() }}
		              <div class="form-group">
		                <img style="width:100px;" src="/uploads/{{session('admin_userinfo')->profile}}">
		                <label for="uface">上传头像</label>
		                <input type="file" class="form-control" name="profile" value="" placeholder="修改头像">
		                <input type="hidden" name="uface_path" value="{{session('admin_userinfo')->profile}}"></div>
		              <input type="submit" class="btn btn-info" value="提交"></form>
		          </div>
		        </div>
		      </div>
		      <div class="modal-footer"></div>
		    </div>
		  </div>
		</div>
	@endif
	 <!-- 修改头像的模态框 结束 -->

	
	 <!-- 如果 登陆 可以操作修改密码 -->
	 @if(session('admin_userinfo'))
	  <!-- 修改密码的模态框开始 -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">修改密码</h4></div>
		      <div class="modal-body">
		        <div class="form-grids row widget-shadow" data-example-id="basic-forms">
		          <div class="form-title"></div>
		          <div class="form-body">
		            <form action="/admin/users/update_upass/{{session('admin_userinfo')->id}}" method="post" enctype="multipart/form-data">{{ csrf_field() }}
		              <div class="form-group">
		                <label for="upass">原始密码</label>
		                <input type="password" class="form-control" name="upass" value="" placeholder="原始密码"></div>
		              <div class="form-group">
		                <label for="new_upwd1">新密码</label>
		                <input type="password" class="form-control" name="new_upwd1" value="" placeholder="新密码"></div>
		              <div class="form-group">
		                <label for="new_upwd2">确认密码</label>
		                <input type="password" class="form-control" name="new_upwd2" value="" placeholder="确认密码"></div>
		              <button type="submit" class="btn btn-info">提交</button></form>
		          </div>
		        </div>
		      </div>
		      <div class="modal-footer"></div>
		    </div>
		  </div>
		</div>
	  </div>
   </div>
	@endif
</body>

</html>
