
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>购物车页面</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />
		<link href="/h/css/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="/h/css/optstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="/h/js/jquery.js"></script>
		<link rel="stylesheet" href="/layui/css/layui.css">
     	<script src="/layui/layui.js"></script>
     	<style type="text/css">
    #nav{
       width:750px;
    }
    
		#pull_right{
            text-align:center;
        }
        .pull-right {
            /*float: left!important;*/
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 0;
            border-radius: 4px;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > a,
        .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #428bca;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination > li:first-child > a,
        .pagination > li:first-child > span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .pagination > li:last-child > a,
        .pagination > li:last-child > span {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .pagination > li > a:focus,
        .pagination > li > span:focus {
            color: #2a6496;
            background-color: #eee;
            border-color: #ddd;
        }
        .pagination > .active > a,
        .pagination > .active > span,
        .pagination > .active > a:hover,
        .pagination > .active > span:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > span:hover,
        .pagination > .disabled > span:focus,
        .pagination > .disabled > a,
        .pagination > .disabled > a:hover,
        .pagination > .disabled > a:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .clear{
            clear: both;
        }
  </style>
	</head>
	<script>
//一般直接写在一个js文件中
    layui.use(['layer', 'form'], function(){
      var layer = layui.layer
    });
</script> 
	<body>

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
			                  <a href="/home/login/login" target="_top" class="h">亲，请登录</a>
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
					<div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span><a href="/home/carts">购物车</a></span><strong id="J_MiniCartNum" class="h">({{$num}})</strong></a></div>
				</div>
				<div class="topMessage favorite">
					<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
			</ul>
			</div>

			<!--悬浮搜索框-->

			<div class="nav white">
				<div class="logo"><img src="/h/images/logo.png" /></div>
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

			<!--购物车 -->
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
							@if(!$cart_data)
							<img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1561388835400&di=858ae2e96fbae501ae7903310fbb325f&imgtype=0&src=http%3A%2F%2Fhbimg.b0.upaiyun.com%2Fe1b1467beea0a9c7d6a56b32bac6d7e5dcd914f7c3e6-YTwUd6_fw658">
							<button><a href="/home/list">去逛逛吧</a></button>
							
							@else
							<div class="th th-item">
								<div class="td-inner">商品信息</div>
							</div>
							<div class="th th-price">
								<div class="td-inner">单价</div>
							</div>
							<div class="th th-amount">
								<div class="td-inner">数量</div>
							</div>
							<div class="th th-sum">
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>

					<div class="clear"></div>

					<tr class="item-list">
						@foreach($cart_data as $k=>$v)
						<div class="bundle  bundle-last ">
							<div class="bundle-hd">
								<div class="bd-promos">
									<div class="bd-has-promo">商品图片<span class="bd-has-promo-content"></span>&nbsp;&nbsp;</div>
									<div class="act-promo">
										<a href="" target="_blank">第二件8折<span class="gt">&gt;&gt;</span></a>
									</div>
									<span class="list-change theme-login">编辑</span>
								</div>
							</div>
							<div class="clear"></div>
							<div class="bundle-main">
								<ul class="item-content clearfix">
									<li class="td td-chk">
										
									</li>
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank" data-title="美康粉黛醉美东方唇膏口红正品 持久保湿滋润防水不掉色护唇彩妆" class="J_MakePoint" data-point="tbcart.8.12">
												<img style="width:79px;height:79px;" src="{{$v->imgs}}" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" target="_blank" title="{{$v->title}}" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->title}}</a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props ">
											
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<div class="price-line">
													<em class="price-original"></em>
												</div>
												<div class="price-line">
													<em id="price{{$v->id}}" class="J_Price price-now" tabindex="0">{{$v->price}}</em>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<div class="sl">
													<!-- <button><a href="/home/carts/jian/{{$v->id}}">-</a></button> -->

											<button><a href="javascript:;" onclick="jian({{$v->id}})">一</a></button>		
													
													
													<input class="text_box" id="numbers{{ $v->id }}" type="text" value="{{$v->nums}}" style="width:30px;" />
													
											<button><a href="javascript:;" onclick="jia({{$v->id}})">＋</a></button>												

												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" id="xiaoji{{$v->id}}" class="J_ItemSum number">{{$v->xiaoji}}</em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a title="移入收藏夹" class="btn-fav" href="#">
                  移入收藏夹</a>
											<a href="javascript:;" onclick="del({{$v->id}},this)" data-point-url="" class="delete">
                  删除</a>
										</div>
									</li>
								</ul>
							</div>
						</div>
						@endforeach
						@endif
					</tr>
				</div>
				<script type="text/javascript">
					function jian(id){
						$.get('/home/carts/jian',{id},function(res){
							if(res.msg == 'ok'){
								 $('#numbers'+id).val(parseInt($('#numbers'+id).val())-1)
							    let price = $('#price'+id).html()
						        let xiaoji = $('#xiaoji'+id).html()
						        // 将小计减去单价
						        let addprice = parseInt(xiaoji)-parseInt(price)
						        // 改变dom的值
						          $('#xiaoji'+id).html(addprice)
						          // 改变总价的dom值
						          $('#J_Total').html(res.zongjia)
						           // 改变总数量的dom值
						       	  $('#J_MiniCartNum').html(res.num)
								 layer.msg('-1');
							}
						},'json')
					}

					function jia(id){
						$.get('/home/carts/jia',{id},function(res){
							if(res.msg == 'ok'){
								 //获取dom节点 +1						          
						         $('#numbers'+id).val(parseInt($('#numbers'+id).val())+1)
						         // 获取单价的dom 节点
						        let price = $('#price'+id).html()
						         // 获取小计的dom节点
						        let xiaoji = $('#xiaoji'+id).html()
						        let jianprice = parseInt(xiaoji)+parseInt(price)
						        // 把结果重新赋值给小计 改变dom的值
						          $('#xiaoji'+id).html(jianprice)
						          // 把结果重新赋值给总价 改变dom的值
						          $('#J_Total').html(res.zongjia)
						          // 改变总数量的dom值
						       	  $('#J_MiniCartNum').html(res.num)
								layer.msg('+1')
							}
							
						},'json')
					}
					function del(id,obj)
					{
						// 提醒是否要删除
						if(!window.confirm('确定要删除商品吗')){
							return false;
						}

						$.get('/home/carts/del',{id},function(res){
							if(res=='ok'){
								$(obj).parent().parent().parent().parent().parent().remove();
								layer.msg('删除成功')
							}else{
								layer.msg('删除失败')
							}
							console.log(res)
						},'html')
					}
				</script>
				<div class="clear"></div>

				<div class="float-bar-wrapper">
					<div id="J_SelectAll2" class="select-all J_SelectAll">
						
					</div>
					<div class="operations">
						<a href="#" hidefocus="true" class="deleteAll">删除</a>
						<a href="#" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
					</div>
					<div class="float-bar-right">
						<div class="amount-sum">						
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<em id="J_Total">{{$zongjia}}</em></strong>
						</div>
						<div class="btn-area">
							<a href="pay.html" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></a>
						</div>
					</div>

				</div>

				<br>

				<!-- 分页 开始 -->                                                                      
			       <div id="pull_right">
			         <div class="pull-right">
			          {{$cart_data->links()}}
			         </div>
			       </div>                                                                                                                                             
      			 <!-- 分页 结束 -->
				
				

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

			<!--操作页面-->

			<div class="theme-popover-mask"></div>

			<div class="theme-popover">
				<div class="theme-span"></div>
				<div class="theme-poptit h-title">
					<a href="javascript:;" title="关闭" class="close">×</a>
				</div>
				<div class="theme-popbod dform">
					<form class="theme-signin" name="loginform" action="" method="post">

						<div class="theme-signin-left">

							<li class="theme-options">
								<div class="cart-title">颜色：</div>
								<ul>
									<li class="sku-line selected">12#川南玛瑙<i></i></li>
									<li class="sku-line">10#蜜橘色+17#樱花粉<i></i></li>
								</ul>
							</li>
							<li class="theme-options">
								<div class="cart-title">包装：</div>
								<ul>
									<li class="sku-line selected">包装：裸装<i></i></li>
									<li class="sku-line">两支手袋装（送彩带）<i></i></li>
								</ul>
							</li>
							<div class="theme-options">
								<div class="cart-title number">数量</div>
								<dd>
									<input class="min am-btn am-btn-default" name="" type="button" value="-" />
									<input class="text_box" name="" type="text" value="1" style="width:30px;" />
									<input class="add am-btn am-btn-default" name="" type="button" value="+" />
									<span  class="tb-hidden">库存<span class="stock">1000</span>件</span>
								</dd>

							</div>
							<div class="clear"></div>
							<div class="btn-op">
								<div class="btn am-btn am-btn-warning">确认</div>
								<div class="btn close am-btn am-btn-warning">取消</div>
							</div>

						</div>
						<div class="theme-signin-right">
							<div class="img-info">
								<img src="/h/images/kouhong.jpg_80x80.jpg" />
							</div>
							<div class="text-info">
								<span class="J_Price price-now">¥39.00</span>
								<span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
							</div>
						</div>

					</form>
				</div>
			</div>
		<!--引导 -->
		<div class="navCir">
			<li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li class="active"><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
	</body>

</html>