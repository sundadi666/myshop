<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>付款成功页面</title>
<link rel="stylesheet"  type="text/css" href="/h/AmazeUI-2.4.2/assets/css/amazeui.css"/>
<link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
<link href="/h/basic/css/demo.css" rel="stylesheet" type="text/css" />

<link href="/h/css/sustyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/h/basic/js/jquery-1.7.min.js"></script>

</head>

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
            <a href="/home/login" target="_top" class="h">亲，请登录</a>
            <a href="/home/register" target="_top">免费注册</a>
          </div>
      @endif
   </div>
  </ul>
  <ul class="message-r">
    <div class="topMessage home"><div class="menu-hd"><a href="/home" target="_top" class="h">商城首页</a></div></div>
    <div class="topMessage my-shangcheng"><div class="menu-hd MyShangcheng"><a href="/home/personal" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div></div>
    <div class="topMessage mini-cart"><div class="menu-hd"><a id="mc-menu-hd" href="/home/carts" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div></div>
    <div class="topMessage favorite"><div class="menu-hd"><a href="/home/collects/index" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
  </ul>
</div>

<!--悬浮搜索框-->

<div class="nav white">
	<div class="logo"><img src="images/logo.png" /></div>
    <div class="logoBig">
      <li><img src="/h/images/logobig.png" /></li>
    </div>
    
    <div class="search-bar pr">
        <a name="index_none_header_sysc" href="#"></a>       
        <form>
        <input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
        <input id="ai-topsearch" class="submit" value="搜索" index="1" type="submit"></form>
    </div>     
</div>

<div class="clear"></div>



<div class="take-delivery">
 <div class="status">
  <h1>页面自动跳转</h1>
   <h2>您已成功付款</h2>
   <div class="successInfo">
     <ul>
       <li>付款金额<em>{{$data['user']['money'] or '请到订单页面查看'}}</em></li>
       <div class="user-info">
         <p>收货人：{{$data['user']['addrs']->uname or '请到订单页面查看'}}</p>
         <p>联系电话：{{$data['user']['addrs']->phone or '请到订单页面查看'}}</p>
         <p>收货地址：{{$data['user']['addrs']->province or '请到订单页面查看'}} {{$data['user']['addrs']->ctiy or ''}} {{$data['user']['addrs']->area or ''}} {{$data['user']['addrs']->details or ''}}</p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服
                               
     </ul>
     <div class="option">
       <span class="info">您可以</span>
        <a href="/home/order" class="J_MakePoint">查看<span>已买到的宝贝</span></a>
        <a href="/home/order" class="J_MakePoint">查看<span>交易详情</span></a>
     </div>
    </div>
  </div>
</div>

  <script type="text/javascript">
  
    
      $(document).ready(function() {
        setTimeout(function(){
            $.get('/home/clearsession',function(res){
              console.log(res);
            },'json');
       },3000);

      })
      

  </script>


<div class="footer" >
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


</body>
</html>
