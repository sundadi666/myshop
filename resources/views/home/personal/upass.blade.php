
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>修改密码</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/h/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/h/css/stepstyle.css" rel="stylesheet" type="text/css">

		<script type="text/javascript" src="/h/js/jquery-1.7.2.min.js"></script>
		<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<link rel="stylesheet" href="/layui/css/layui.css">
        <script src="/layui/layui.js"></script>
	</head>
	<script>
    //一般直接写在一个js文件中
        layui.use(['layer', 'form'], function(){
          var layer = layui.layer
        });
    </script> 
   
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
					                  <a href="#" target="_top" class="h">你好!{{session('userinfo')->uname}}</a>
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
								<div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span><a href="/home/carts">购物车</a></span><strong id="J_MiniCartNum" class="h">{{$num}}</strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
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
								<li class="index"><a href="#">首页</a></li>
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
			<div class="col-main">
				<div class="main-wrap">

					<div class="am-cf am-padding">
						<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">修改密码</strong> / <small>Password</small></div>
					</div>
					<hr/>
					
					<!--进度条-->
					<div class="m-progress">
						<div class="m-progress-list">
							<span class="step-1 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">1<em class="bg"></em></i>
                                <p class="stage-name">重置密码</p>
                            </span>
							<span class="step-2 step">
                                <em class="u-progress-stage-bg"></em>
                                <i class="u-stage-icon-inner">2<em class="bg"></em></i>
                                <p class="stage-name">完成</p>
                            </span>
							<span class="u-progress-placeholder"></span>
						</div>
						<div class="u-progress-bar total-steps-2">
							<div class="u-progress-bar-inner"></div>
						</div>
					</div>
					<form class="am-form am-form-horizontal" action="" method="" id="upass">
						{{ csrf_field() }}
						<div class="am-form-group">
							<label for="user-old-password" class="am-form-label">原密码</label>
							<div class="am-form-content">
								<input type="password" id="upass1" name="upass" placeholder="请输入原登录密码">
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-new-password" class="am-form-label">新密码</label>
							<div class="am-form-content">
								<input type="password" id="new_upass1" name="new_upass1" placeholder="由数字组合">
							</div>
						</div>
						<div class="am-form-group">
							<label for="user-confirm-password" class="am-form-label">确认密码</label>
							<div class="am-form-content">
								<input type="password" id="new_upass2" name="new_upass2" placeholder="请再次输入上面的密码">
								<input type="hidden" id="id" name="id" value="{{$user->id}}">
							</div>
						</div>
						<div class="info-btn">
							
							<input type="submit" class="am-btn am-btn-danger" value="保存修改">
						</div>

					</form>
					 <script type="text/javascript">
					 	$('#upass').submit(function(){
					 		let upass = $('#upass1').val();
					 		let new_upass1 = $('#new_upass1').val();
					 		let new_upass2 = $('#new_upass2').val();
					 		let id = $('#id').val();					 		
	         			 	 // 判断 两次密码 不能为空
					        if(new_upass1=='' && new_upass2==''){
					            layer.msg('密码不能为空')
					            return false;
					        }

					        // 判断 密码格式
				       	   let upass_preg = /^\w{6,18}$/;
				       	   if(!upass_preg.test(new_upass1,new_upass2)){
				       	   	layer.msg('密码格式错误')
				       	   	return false;
				       	   }
							
					        // 判断 俩次密码不一致
					        if(new_upass1 != new_upass2){
					            layer.msg('俩次密码不一致');
					           return false;
					        }
					        // 引入 ajax 插件
						 $.ajaxSetup({
					            headers: {
					                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					            }
					        });
						   // 发送 ajax 
					 		$.post('/home/personal/updata_upass/'+id,{upass,new_upass1},function(res){
					 			if(res.msg == 'ok') {
							 		 layer.msg(res.info);		
									} else {
							 		 layer.msg(res.info);
							 		}
					 		},'json')
					 		return false;
					 	})
    					
  				     </script>
				</div>
				<!--底部-->
				<div class="footer">
					<div class="footer-hd">
						<p>
							<a href="#">恒望科技</a>
							<b>|</b>
							<a href="#">商城首页</a>
							<b>|</b>
							<a href="#">支付宝</a>
							<b>|</b>
							<a href="#">物流</a>
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于恒望</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>
							<em>{{$footer_data->copy}} {{$footer_data->filing}}  {{$footer_data->company}}</em>
						</p>
					</div>
				</div>
			</div>

			<aside class="menu">
				<ul>
					<li class="person">
						<a href="/home/personal">个人中心</a>
					</li>
					<li class="person">
						<a href="/home/personal/info/{{$user->id}}">修改资料</a>
						<ul>
							<li> <a href="/home/personal/upass">修改密码</a></li>
							<li> <a href="">安全设置</a></li>
							<li> <a href="/home/addrs">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>
							<li><a href="/home/order">订单管理</a></li>
							<li> <a href="">退款售后</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的资产</a>
						<ul>
							<li> <a href="coupon.html">优惠券 </a></li>
							<li> <a href="bonus.html">红包</a></li>
							<li> <a href="bill.html">账单明细</a></li>
						</ul>
					</li>

					<li class="person">
						<a href="#">我的小窝</a>
						<ul>
							<li> <a href="collection.html">收藏</a></li>
							<li> <a href="foot.html">足迹</a></li>
							<li> <a href="/home/replys">评价</a></li>
							<li> <a href="news.html">消息</a></li>
						</ul>
					</li>

				</ul>

			</aside>
		</div>

	</body>

</html>