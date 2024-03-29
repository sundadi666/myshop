
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>404 Not Found </title>

<style>
	@keyframes move_wave{0%{transform: translateX(0) translateZ(0) scaleY(1)}
	50%{transform: translateX(-25%) translateZ(0) scaleY(0.55)}
	100%{transform: translateX(-50%) translateZ(0) scaleY(1)}}
	.waveWrapper{overflow: hidden;position: absolute;left: 0;right: 0;bottom: 0;top: 0;margin: auto;}
	.waveWrapperInner{position: absolute;width: 100%;overflow: hidden;height: 100%;bottom: -1px;background-image: url(/errors/images/404bg.svg);background-repeat: no-repeat;background-size:100%;}
	.bgTop{z-index: 15;opacity: 0.5;}
	.bgMiddle{z-index: 10;opacity: 0.75;}
	.bgBottom{z-index: 5;}
	.wave{position: absolute;left: 0;width: 200%;height: 100%;background-repeat: repeat no-repeat;background-position: 0 bottom;transform-origin: center bottom;}
	.waveTop{background-size: 50% 150px;}
	.waveAnimation .waveTop{animation: move-wave 3s;-webkit-animation: move-wave 3s;-webkit-animation-delay: 1s;animation-delay: 1s;}
	.waveMiddle{background-size: 50% 190px;}
	.waveAnimation .waveMiddle{animation: move_wave 10s linear infinite;}
	.waveBottom{background-size: 50% 200px;}
	.waveAnimation .waveBottom{animation: move_wave 15s linear infinite;}
	.wavetext{position: absolute;z-index: 99999999;width: 40%;right: 10%;top:25%;}
	.wavetop{margin-bottom: 3%;}
	.wavelx{width: 32%;float: left;}
	.wavets{float: left;font-size: 280%;width: 62%;padding-top: 10%;padding-left: 5%;padding-bottom: 2%;}
	.wavecz{width: 100%;font-size: 150%;padding-left: 5%;}
	.waveqcz{clear: left;}
	.wavegohome{margin-top: 5%;float: left;margin-left: 7%;}
	.waveclose{margin-top: 5%;float: left;margin-left: 7%;}
	.wavegohome a,.waveclose a{margin: 2px;color: #ffb957;text-decoration: none;font-size: 170%;}
	.waveinput{border: 2px solid #ffb957;padding: 0.2em 1em 0.3em 1em;border-radius: 8em;}
</style>
</head>
<body>
<div class="wavetext">
	<div class="wavetop">
		<div class="wavelx">
			<img src="/errors/images/404.svg">
		</div>
		<div class="wavets">
			em~ 此路不通！
		</div>
	</div>
	<span class="wavecz">你可以回到网站主页或关闭本页~</span>
	<div class="waveqcz">
	</div>
	<div class="wavegohome waveinput">
		<a href="/home">回到商城首页</a>
	</div>
	<div class="waveclose waveinput">
		<a href="javascript:void(0);" onclick="window.opener=null; window.open('','_self');window.close();">关闭这个页面</a>
	</div>
	<div class="waveqcz">
	</div>
	<div class="waveqczfd">
	</div>
</div>
<div class="waveWrapper waveAnimation">
	<div class="waveWrapperInner bgTop">
		<div class="wave waveTop" style="background-image: url('/errors/images/wave-top.png')">
		</div>
	</div>
	<div class="waveWrapperInner bgMiddle">
		<div class="wave waveMiddle" style="background-image: url('/errors/images/wave-mid.png')">
		</div>
	</div>
	<div class="waveWrapperInner bgBottom">
		<div class="wave waveBottom" style="background-image: url('/errors/images/wave-bot.png')">
		</div>
	</div>
</div>
</body>
</html>
