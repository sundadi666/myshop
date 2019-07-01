
<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=0">

    <title>个人资料</title>

    <link href="/h/AmazeUI-2.4.2/assets/css/admin.css" rel="stylesheet" type="text/css">
    <link href="/h/AmazeUI-2.4.2/assets/css/amazeui.css" rel="stylesheet" type="text/css">

    <link href="/h/css/personal.css" rel="stylesheet" type="text/css">
    <link href="/h/css/infstyle.css" rel="stylesheet" type="text/css">
    <script src="/h/AmazeUI-2.4.2/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="/h/AmazeUI-2.4.2/assets/js/amazeui.js" type="text/javascript"></script>
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
                <div class="menu-hd"><a id="mc-menu-hd" href="/home/carts" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">{{$num}}</strong></a></div>
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

          <div class="user-info">
            <!--标题 -->
            <div class="am-cf am-padding">
              <div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
            </div>
            <hr/>

            <!--头像 -->
            <div class="user-infoPic">

              <div class="filePic">
                <input type="file" class="inputPic" allowexts="gif,jpeg,jpg,png,bmp" accept="image/*">
                <img class="am-circle am-img-thumbnail" src="/uploads/{{$user_data->usersinfos->profile or ''}}" alt="" />
              </div>

              <p class="am-form-help">头像</p>

              <div class="info-m">
                <div><b>用户名：<i>{{$user_data->uname or ''}}</i></b></div>
                <div class="u-level">
                  <span class="rank r2">
                           <s class="vip1"></s><a class="classes" href="#">铜牌会员</a>
                        </span>
                </div>
                <div class="u-safety">
                  <a href="safety.html">
                   账户安全
                  <span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0">60分</i></span>
                  </a>
                </div>
              </div>
            </div>
            <!-- 读取 报错信息 -->
            <div style="background-color:pink;">
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
            </div>
            <!--个人信息 -->
            <div class="info-main">
              <form class="am-form am-form-horizontal" action="/home/personal?id={{$user_data->id or ''}}/token={{$user_data->token or ''}}" method="post" enctype="multipart/form-data">
                  {{ csrf_field() }}
                <div class="am-form-group">
                  <label for="user-name2" class="am-form-label">昵称</label>
                  <div class="am-form-content">
                    <input type="text" id="uname" name="uname" value="{{$user_data->uname or ''}}" placeholder="昵称">

                  </div>
                </div>
            
                <div class="am-form-group">
                  <label class="am-form-label">性别</label>
                  <div class="am-form-content sex">
                    <label class="am-radio-inline">
                      <input type="radio" value="m" name="sex" {{ $user_data->usersinfos->sex=='m' ? 'checked' : '' }} >男
                    </label>
                    <label class="am-radio-inline">
                      <input type="radio"  name="sex" value="w" {{ $user_data->usersinfos->sex=='w' ? 'checked' : '' }} >女
                    </label>
                    <label class="am-radio-inline">
                      <input type="radio"  name="sex" value="x" {{ $user_data->usersinfos->sex=='x' ? 'checked' : '' }} >保密
                    </label>
                  </div>
                </div>
             
                <div class="am-form-group">
                  <label for="user-phone" class="am-form-label">手机号</label>
                  <div class="am-form-content">
                    <input id="phone" name="phone" value="{{$user_data->phone}}" placeholder="手机号" type="text">

                  </div>
                </div>
                <div class="am-form-group">
                  <label for="user-email" class="am-form-label">电子邮件</label>
                  <div class="am-form-content">
                    <input id="user-email" name="email" value="{{$user_data->email}}" placeholder="电子邮件" type="text">

                  </div>
                </div>  
                <img class="am-circle am-img-thumbnail" style="width:50px;" src="/uploads/{{$user_data->usersinfos->profile or ''}}" alt="" />
                 <div class="am-form-group">

                  <label for="user-email" class="am-form-label">头像</label>
                  <div class="am-form-content">
                    <input id="profile" name="profile" value="" placeholder="头像" type="file">
                    <input type="hidden" name="profile_path" value="{{$user_data->usersinfos->profile}}">
                    

                  </div>
                </div>              
                
                <div class="info-btn">
                  <div class="am-btn am-btn-danger">
                    <input type="submit" class="am-btn am-btn-danger" value="保存修改">
                  </div>
                </div>

              </form>
              <div class="am-form-group safety">
                  <label for="user-safety" class="am-form-label">账号安全</label>
                  <div class="am-form-content safety">
                    <a href="safety.html">

                      <span class="am-icon-angle-right"></span>

                    </a>

                  </div>
                </div>
            </div>

          </div>

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
            <a href="/home/personal/info/{{$user_data->id}}">修改资料</a>
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
              <li> <a href="collection.html">收藏</a></li>
              <li> <a href="foot.html">足迹</a></li>
              <li> <a href="comment.html">评价</a></li>
              <li> <a href="news.html">消息</a></li>
            </ul>
          </li>

        </ul>

      </aside>
    </div>

  </body>

</html>