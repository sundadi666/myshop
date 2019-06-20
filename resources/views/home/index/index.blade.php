		@extends('home.layout.index')
			
		@section('banner')
			<div class="banner">
	                      <!--轮播 -->
							<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
								<ul class="am-slides">
									<li class="banner1"><a href="introduction.html"><img src="/h/images/ad1.jpg" /></a></li>
									<li class="banner2"><a><img src="/h/images/ad2.jpg" /></a></li>
									<li class="banner3"><a><img src="/h/images/ad3.jpg" /></a></li>
									<li class="banner4"><a><img src="/h/images/ad4.jpg" /></a></li>

								</ul>
							</div>
							<div class="clear"></div>	
				</div>
		@endsection


		<!-- 轮播图 -->
		@section('header')
			
        		<!--侧边导航 -->
				<div id="nav" class="navfull">
					<div class="area clearfix">
						<div class="category-content" id="guide_2">
							
							<div class="category">
								<ul class="category-list" id="js_climit_li">
									@foreach($cates_data as $k=>$v)
									<li class="appliance js_toggle relative first">
										<div class="category-info">
											<h3 class="category-name b-category-name"><i><img src="/h/images/cake.png"></i><a class="ml-22" title="点心">{{$v->cname}}</a></h3>
											<em>&gt;</em></div>
										<div class="menu-item menu-in top">
											<div class="area-in">
												<div class="area-bg">
													<div class="menu-srot">
														@foreach($v->sub as $kk=>$vv)
														<div class="sort-side">
															<dl class="dl-sort">
																<dt><span title="蛋糕">{{$vv->cname}}</span></dt>
																@foreach($vv->sub as $kkk=>$vvv)
																<dd><a title="{{$vvv->cname}}" href="#"><span>{{$vvv->cname}}</span></a></dd>
																@endforeach
															</dl>
														</div>
														@endforeach
													</div>
												</div>
											</div>
										</div>
									<b class="arrow"></b>	
									</li>
									@endforeach
									
									

											
											
											
										</ul>
									</div>
								</div>

							</div>
						</div>
						
						
						<!--轮播-->
						
						<script type="text/javascript">
							(function() {
								$('.am-slider').flexslider();
							});
							$(document).ready(function() {
								$("li").hover(function() {
									$(".category-content .category-list li.first .menu-in").css("display", "none");
									$(".category-content .category-list li.first").removeClass("hover");
									$(this).addClass("hover");
									$(this).children("div.menu-in").css("display", "block")
								}, function() {
									$(this).removeClass("hover")
									$(this).children("div.menu-in").css("display", "none")
								});
							})
						</script>



					<!--小导航 -->
					<div class="am-g am-g-fixed smallnav">
						<div class="am-u-sm-3">
							<a href="sort.html"><img src="/h/images/navsmall.jpg" />
								<div class="title">商品分类</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/h/images/huismall.jpg" />
								<div class="title">大聚惠</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/h/images/mansmall.jpg" />
								<div class="title">个人中心</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="/h/images/moneysmall.jpg" />
								<div class="title">投资理财</div>
							</a>
						</div>
					</div>

					<!--走马灯 -->

					<div class="marqueen">
						<span class="marqueen-title">商城头条</span>
						<div class="demo">

							<ul>
								<div class="mod-vip">
							<div class="m-baseinfo">
								<a href="person/index.html">
									<img src="/h/images/getAvatar.do.jpg">
								</a>
								<em>
									Hi,<span class="s-name">小叮当</span>
									<a href="#"><p>点击更多优惠活动</p></a>									
								</em>
							</div>
							<div class="member-logout">
								<a class="am-btn-warning btn" href="/home/login">登录</a>
								<a class="am-btn-warning btn" href="/home/register">注册</a>
							</div>
							<div class="member-login">
								<a href="#"><strong>0</strong>待收货</a>
								<a href="#"><strong>0</strong>待发货</a>
								<a href="#"><strong>0</strong>待付款</a>
								<a href="#"><strong>0</strong>待评价</a>
							</div>
							<div class="clear"></div>	
						</div>	


						
								<li class="title-first"><a target="_blank" href="#">
									<img src="/h/images/TJ2.jpg"></img>
									<span>[特惠]</span>商城爆品1分秒								
								</a></li>
								<li class="title-first"><a target="_blank" href="#">
									<span>[公告]</span>商城与广州市签署战略合作协议
								     <img src="/h/images/TJ.jpg"></img>
								     <p>XXXXXXXXXXXXXXXXXX</p>
							    </a></li>
							    
																						    
							    
								<li><a target="_blank" href="#"><span>[特惠]</span>洋河年末大促，低至两件五折</a></li>
								<li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>
								<li><a target="_blank" href="#"><span>[特惠]</span>家电狂欢千亿礼券 买1送1！</a></li>
								
							</ul>
                        <div class="advTip"><img src="/h/images/advTip.jpg"/></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}
				</script>
				</div>		
			</div>
		@endsection
		
		
		
		<!-- 内容 -->
		@section('content')
			
			<div class="shopMainbg">
				<div class="shopMain" id="shopmain">

					<!--今日推荐 -->

					<div class="am-g am-g-fixed recommendation">
				      @foreach($recommends as $k=>$v)     
				      	<div class="am-u-sm-4 am-u-lg-3 ">
				       		<div class="info ">
					        	<h3>{{ $v->goods_info_top }}</h3>
					        	<h4>{{ $v->goods_info_bottom }}</h4>
					       	</div>
					       	<div class="recommendationMain two">
					        	<img src="{{ $v->img }}">
					       	</div>
				      	</div>
				      @endforeach
				     </div>
				    <div class="clear "></div>
					<!--热门活动 -->

					<div class="am-container activity ">
						<div class="shopTitle ">
							<h4>活动</h4>
							<h3>每期活动 优惠享不停 </h3>
							<span class="more ">
                              <a href="# ">全部活动<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					  <div class="am-g am-g-fixed ">
						<div class="am-u-sm-3 ">
							<div class="icon-sale one "></div>	
								<h4>秒杀</h4>							
							<div class="activityMain ">
								<img src="/h/images/activity1.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>
							</div>														
						</div>
						
						<div class="am-u-sm-3 ">
						  <div class="icon-sale two "></div>	
							<h4>特惠</h4>
							<div class="activityMain ">
								<img src="/h/images/activity2.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>								
							</div>							
						</div>						
						
						<div class="am-u-sm-3 ">
							<div class="icon-sale three "></div>
							<h4>团购</h4>
							<div class="activityMain ">
								<img src="/h/images/activity3.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>
							</div>							
						</div>						

						<div class="am-u-sm-3 last ">
							<div class="icon-sale "></div>
							<h4>超值</h4>
							<div class="activityMain ">
								<img src="/h/images/activity.jpg "></img>
							</div>
							<div class="info ">
								<h3>春节送礼优选</h3>
							</div>													
						</div>

					  </div>
                   </div>
					<div class="clear "></div>
	


				@foreach($branks_data as $k=>$v)
                    <div id="f1">
					<!--甜点-->
					
					<div class="am-container ">
						<div class="shopTitle ">
							<h4>{{$v->bname}}</h4>
							<h3>{{$v->intro}}</h3>
							
							<span class="more ">
                    <a href="# ">更多美味<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					</div>
					
					<div class="am-g am-g-fixed floodFour">
						<div class="am-u-sm-5 am-u-md-4 text-one list ">
							<div class="word" style="position: relative;top:130px;">
								<img src="/uploads/{{$v->bimg}}">	
							</div>
							<a href="# ">
								<div class="outer-con ">
																	
								</div>
                                  <img src="/h/images/act1.png " />								
							</a>
							<div class="triangle-topright"></div>						
						</div>
						
							
			
						@foreach($v->goods_data as $k=>$v)
							<div class="am-u-sm-3 am-u-md-2 text-three big">
								<div class="outer-con ">
									<div class="title ">
										{{$v->title}}
									</div>
									<div class="sub-title ">
										
									</div>
									<i class="am-icon-shopping-basket am-icon-md  seprate"></i>
								</div>
								<a href="# "><img src="{{$v->img_big}}" /></a>
							</div>
						@endforeach

						

					</div>
                 <div class="clear "></div>  
                 </div>
                @endforeach
  
                  
   
		@endsection
					

