<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>订单管理</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/h/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/h/css/orstyle.css" rel="stylesheet" type="text/css">

		
		<link href="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

		<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js"></script>

		<link href="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="/layui/css/layui.css">
      	<script src="/layui/layui.js"></script>
		
		<script>
		//一般直接写在一个js文件中
		    layui.use(['layer', 'form'], function(){
		      var layer = layui.layer
		    });
		</script> 


	</head>

	@section('content')
			
	@show


		<script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js"></script>
		<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<link href="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
  		<script src="https://cdn.bootcss.com/twitter-bootstrap/3.3.2/js/bootstrap.min.js"></script>
	</head>

	<body>
		<!--头 -->
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">
						<ul class="message-l">
							<div class="topMessage">
						  @if(session('home_login'))
			              <div class="menu-hd">
			                
			                <a href="" target="_top" class="h">你好!{{session('userinfo')->uname}}</a>
			                 <a href="/home/logout">退出</a>
			              </div>
			              @else
			              <div class="menu-hd">
			              	<a href="/home/login" target="_top" class="h">亲，请登录</a>
			              	<a href="/home/register" target="_top">免费注册</a>
			              </div>
			              @endif
							</div>
						</ul>
						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="/home" target="_top" class="h">商城首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="/home/personal" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="/home/carts" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h"></strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="/home/collects/index" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
						</ul>
						</div>

						<!--悬浮搜索框-->

						<div class="nav white">
							<div class="logoBig">
								<li><img src="/h/images/logobig.png" /></li>
							</div>

							<div class="search-bar pr">
								<a name="index_none_header_sysc" href="#"></a>
								<form>
									<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
			</article>
		</header>
            <div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="/home">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
			</div>
			<b class="line"></b>
		<div class="center">
			@section('content')
			
			@show
		</div>

	</body>


</html>