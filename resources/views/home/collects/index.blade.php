
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

		<title>我的收藏</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

		<link href="/h/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/h/css/colstyle.css" rel="stylesheet" type="text/css">

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
		                  <a href="#" target="_top" class="h">
		                  	你好!{{session('userinfo')->uname}}</a>
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
								@foreach($navigates_data as $k=>$v)
									<li class="index"><a href="{{$v->url}}">{{$v->title}}</a></li>
			                    @endforeach	
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

					<div class="user-collection">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">我的收藏</strong> / <small>My&nbsp;Collection</small></div>
						</div>
						<hr/>

						<div class="you-like">
							<div class="s-bar">
								我的收藏
								<a class="am-badge am-badge-danger am-round">降价</a>
								<a class="am-badge am-badge-danger am-round">下架</a>
							</div>
							<div class="s-content">
								@foreach($user->usergoods as $k=>$v)
								<div class="s-item-wrap">
									<div class="s-item">
										<div class="s-pic">
											<a href="#" class="s-pic-link">
												<!-- <a href="/home/goods/details?cid={{$v->cid}}&gid={{$v->id}}"></a> -->
												<img src="/{{ $v->img_big }}" class="s-pic-img s-guess-item-img">
											<!-- @if($v->goods_status == '0')
											<span class="tip-title">已下架</span>
											@endif -->
											</a>
										</div>
										<div class="s-info">
											<div class="s-title"><a href="/home/goods/details?cid={{$v->cid}}&gid={{$v->id}}" title="{{ $v->title }}">{{ $v->title }}</a></div>
											<div class="s-price-box">
												<span class="s-price"><em class="s-price-sign">¥</em><em class="s-value">{{ $v->goodsmodel[0]->modelsize[0]->money }}</em></span>
											</div>
											<div class="s-extra-box">
												<span class="s-sales">月销: 278</span>
											</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>

							<div class="s-more-btn i-load-more-item" data-screen="0"><i class="am-icon-refresh am-icon-fw"></i>更多</div>

						</div>

					</div>

				</div>
				<!--底部-->
				<div class="footer">
					<div class="footer-hd">
						<p>
							@foreach($links_data as $k=>$v)
							<a href="{{$v->url}}">{{ $v->title}}</a>
							<b>|</b>
							@endforeach
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于恒望</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>
							<em>© 2015-2025 Hengwang.com 版权所有</em>
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
							<li> <a href="safety.html">安全设置</a></li>
							<li> <a href="/home/addrs">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>
							<li><a href="/home/order">订单管理</a></li>
							<li> <a href="change.html">退款售后</a></li>
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
							<li class="active"> <a href="/home/collects/index">收藏</a></li>
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