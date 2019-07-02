
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>地址管理</title>

		<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
		<link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">
		<link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.css" rel="stylesheet">

		<link href="/h/css/personal.css" rel="stylesheet" type="text/css">
		<link href="/h/css/addstyle.css" rel="stylesheet" type="text/css">
		<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
		<script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js"></script>
		<script src="\h\js\jsAddress.js"></script>
		<script src="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
								<div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
							</div>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="/home/personal" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="/home/carts" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">{{$num}}</strong></a></div>
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

					<div class="user-address">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">地址管理</strong> / <small>Address&nbsp;list</small></div>
						</div>
						<hr/>
						<ul class="am-avg-sm-1 am-avg-md-3 am-thumbnails">
							
							@foreach($addrs_data as $k=>$v)
							<li class="user-addresslist {{$v->default == '1' ? 'defaultAddr' : ''}}" name="{{$v->id}}">
								<span class="new-option-r" name="{{$v->id}}"><i class="am-icon-check-circle"></i>默认地址</span>
								<input type="hidden" name="id" value="{{$v->id}}">
								<p class="new-tit new-p-re">
									<span class="new-txt">{{$v->uname}}</span>
									<span class="new-txt-rd2">{{$v->phone}}</span>
								</p>
								<div class="new-mu_l2a new-p-re">
									<p class="new-mu_l2cw">
										<span class="title">地址：</span>
										<span class="province">{{$v->province}}</span>省
										<span class="city">{{$v->ctiy}}</span>市
										<span class="dist">{{$v->area}}</span>区
										<span class="street">{{$v->details}}</span></p>
								</div>
								<div class="new-addr-btn">
									<a href="javascript:;" onclick="edit({{$v->id}})"><i class="am-icon-edit"></i>编辑</a>
									<span class="new-addr-bar">|</span>
									<a href="javascript:;" onclick="destroy({{$v->id}},this)"><i class="am-icon-trash"></i>删除</a>
								</div>
							</li>
							@endforeach
							
						</ul>
						<script type="text/javascript">
							// 执行 删除 操作
							function destroy(id,obj)
							{	
								 $.ajaxSetup({
						            headers: {
						                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						            }
						        });

								console.log(id);
								 $.ajax(
						            {
						                url: "/home/addrs/" + id,
						                type : "DELETE",
						                success: function(res){
						                    if(res == 'ok') {
						                      $(obj).parent().parent().remove();
						                    }
						                },
						            });
							}

							// 执行 修改 操作
							function edit(id)
							{
								// console.log(id);
								$.get('/home/addrs/'+id+'/edit',function(res){
									$('#exampleModal').find('form #uname').val(res.uname);
									$('#exampleModal').find('form #phone').val(res.phone);
									$('#exampleModal #cmbProvince').find(`option[value="${res.province}"]`).attr('selected',true);
									$('#exampleModal').find('form #details').val(res.details);
									$('#exampleModal').find('form').attr('action','/home/addrs/'+res.id);
									$('#exampleModal').modal('show');
								},'json');
							}

						</script>
						<!-- 修改地址 模态框 开始  -->
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="exampleModalLabel">更改地址</h4>
						      </div>
						      <div class="modal-body">
						        <form action="/home/addrs" method="post">
						        	{{ csrf_field() }}
	        						{{ method_field('PUT') }}
						          <div class="form-group">
						            <label for="uname" class="control-label">收货人:</label>
						            <input type="text" name="uname" class="form-control" id="uname">
						          </div>

						          <div class="form-group">
						            <label for="phone" class="control-label">手机号码:</label>
						            <input type="text" name="phone" class="form-control" id="phone">
						          </div>
						          <div class="form-group">
						            <label for="details" class="control-label">详细地址:</label>
						            <textarea name="details" class="form-control" id="details"></textarea>
						          </div>
						          <div class="modal-footer">
							        <input type="submit" class="btn btn-primary" name="">
							      </div>
						        </form>
						      </div>
						      
						    </div>
						  </div>
						</div>
						<!-- 修改地址 模态框 结束  -->

						<div class="clear"></div>
						<a class="new-abtn-type" data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0}">添加新地址</a>
						<!--例子-->
						<div class="am-modal am-modal-no-btn" id="doc-modal-1">

							<div class="add-dress">

								<!--标题 -->
								<div class="am-cf am-padding">
									<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add&nbsp;address</small></div>
								</div>
								<hr/>

								<div class="am-u-md-12 am-u-lg-8" style="margin-top: 20px;">
									<form class="am-form am-form-horizontal" action="/home/addrs" method="post">
											{{csrf_field()}}
										<div class="am-form-group">
											<label for="user-name" class="am-form-label">收货人</label>
											<div class="am-form-content">
												<input type="text" name="uname" id="user-name" placeholder="收货人">
											</div>
										</div>
										<input type="hidden" name="uid" value="{{session('userinfo')->id}}">
										<div class="am-form-group">
											<label for="user-phone" class="am-form-label">手机号码</label>
											<div class="am-form-content">
												<input id="user-phone" name="phone" placeholder="手机号必填" type="text">
											</div>
										</div>
										<div class="am-form-group" >
											<label for="user-address" class="am-form-label">所在地</label>
											<div class="am-form-content address">
												<select name="province" id="cmbProvince" >
													
												</select>
												<select name="ctiy" id="cmbCity" >
													
												</select>
												<select name="area" id="cmbArea">
													
												</select>
											</div>
										</div>

										<div class="am-form-group">
											<label for="user-intro" class="am-form-label">详细地址</label>
											<div class="am-form-content">
												<textarea name="details" class="" rows="3" id="user-intro" placeholder="输入详细地址"></textarea>
												<small>100字以内写出你的详细地址...</small>
											</div>
										</div>

										<div class="am-form-group">
											<div class="am-u-sm-9 am-u-sm-push-3">
												<input type="submit" class="am-btn am-btn-danger" name="" value="保存地址">
											</div>
										</div>
									</form>
								</div>

							</div>

						</div>

					</div>
					<script type="text/javascript">
					    addressInit('cmbProvince', 'cmbCity', 'cmbArea', '陕西', '宝鸡市', '金台区');

					</script>

					<script type="text/javascript">
						$(document).ready(function() {							
							$(".new-option-r").click(function() {
								var oldid = $('.user-address').find('li.defaultAddr').attr('name');
								var newid = $(this).attr('name');
								$.get('/home/addrs/editaddrs',{oldid,newid},(res)=>{
									if (res.msg == "ok") {
										$(this).parent('.user-addresslist').addClass("defaultAddr").siblings().removeClass("defaultAddr");
									}
								},'json');
								
							});
							
							var $ww = $(window).width();
							if($ww>640) {
								$("#doc-modal-1").removeClass("am-modal am-modal-no-btn")
							}
							
						})
					</script>

					<div class="clear"></div>

				</div>
				<!--底部-->
				<div class="footer">
					<div class="footer-hd ">
						<p>
							@foreach($links_data as $k=>$v)
							<a href="{{$v->url}}">{{ $v->title}}</a>
							<b>|</b>
							@endforeach
						</p>
					</div>
					<div class="footer-bd ">
						
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
							<li> <a href="safety.html">安全设置</a></li>
							<li class="active"> <a href="/home/addrs">收货地址</a></li>
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
							<li> <a href="/home/collects/index">收藏</a></li>
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