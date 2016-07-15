<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lucky Draw</title>

<script type="text/javascript" src="/ji_js/jquery-2.1.4.min.js"></script>
<script>
// JavaScript Document
(function($){
	$.fn.topScroll = function(options){
	//默认配置
	var defaults = {
		speed:1,  //滚动速度,值越大速度越慢
		rowHeight:24, //每行的高度
		marginTop : '-=1' //-=往上，+=往下
		
	};
	
	var opts = $.extend({}, defaults, options),intId = [];
	
	function marquee(obj, step){
	
		obj.find("ul").animate({
			marginTop: opts["marginTop"]
		},0,function(){
				var s = Math.abs(parseInt($(this).css("margin-top")));
				if(s >= step){
					$(this).find("li").slice(0, 1).appendTo($(this));
					$(this).css("margin-top", 0);
				}
			});
		}
		
		this.each(function(i){
			var sh = opts["rowHeight"],speed = opts["speed"],_this = $(this);
			intId[i] = setInterval(function(){
				if(_this.find("ul").height()<=_this.height()){
					clearInterval(intId[i]);
				}else{
					marquee(_this, sh);
				}
			}, speed);

			_this.hover(function(){
				clearInterval(intId[i]);
			},function(){
				intId[i] = setInterval(function(){
					if(_this.find("ul").height()<=_this.height()){
						clearInterval(intId[i]);
					}else{
						marquee(_this, sh);
					}
				}, speed);
			});
		
		});

	}

})(jQuery);
//执行操作
$(function(){
	$('.scroll').topScroll({
		speed: 1, //数值越大，速度越慢
		rowHeight: 190, //li的高度
		marginTop : '-=2'
	});
	$(".start").click(function(){
		$('.scroll').topScroll({
			speed: 1, //数值越大，速度越慢
			rowHeight: 190, //li的高度
			marginTop : '-=89'
		});
		$('.start').hide();
		$('.stop').show();
	})
	$(".stop").click(function(){
		$('.scroll').topScroll({
			speed: 1, //数值越大，速度越慢
			rowHeight: 190, //li的高度
			marginTop : '+=89'
		});
		$('#winner').show();
		$('.number').hide();
		$('.stop').hide();$('.scroll').hide();
		getmember(eval(document.getElementById('number')).value);
	})
	function getmember(number){//调用排序的课程
		var xmlhttp;
		if (window.XMLHttpRequest){
			xmlhttp=new XMLHttpRequest();
		}
		for (var i=0;i<number;i++){
			xmlhttp.onreadystatechange=function(){
				if(xmlhttp.readyState==4 && xmlhttp.status==200){
					document.getElementById("list").innerHTML=document.getElementById("list").innerHTML + xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET","/tool/lucky/getmember/"+number,true);
			xmlhttp.send();
		}
	}
});
</script>
<style>
* { margin: 0; padding: 0; font-family:Verdana, Geneva, sans-serif}
body{background-color:#EE085C; background-image:url(/ji_style/image/happynewyear.jpg); background-position:top; background-repeat:no-repeat;}
.scroll { width: 150px; height: 570px; margin-top:150px; float:left; border: 1px solid #ccc; line-height: 26px; font-size: 12px; overflow: hidden;}
.scroll li { height: 190px; max-width:200px; overflow: hidden;}
.scroll img { border: 0 none; width:150px; height:190px;}
.left { float:left;}
.right { float:right;}
.stop { display:none;}
#box { margin:0 auto; max-width:960px;}
#winner { width:100%; display:none; float:left;}
.button { width:150px; height:150px; background-color:#F00;  margin-top: 300px;  position: absolute;  margin-left: 400px; border:1px solid #eee; border-radius:75px; text-align:center; line-height:150px; font-size:30px; color:#fff; cursor:pointer}
#list img { width:150px; height:190px; float:left; margin:20px;}
#winner h1 { width:100%; text-align:center; height:100px; line-height:100px; color:#06F}
.number { width:100px; height:40px; border-radius:30px; text-align:center; position:absolute;   margin-top: 500px;  margin-left: 275px;  background-color: #FC4061;  border: 0;font-size: 30px;  color: #fff;}
</style>
</head>

<body sroll="no">

<div id="box">
<div id="winner">
<h1>Lucky Guys</h1>
<div id="list"></div>
</div>
<div class="scroll left">
	<ul>
    <?php foreach($asc as $a){?>
    <li><a href="#"><img src="/ji_upload/tool/lucky/<?=$a->image?>.jpg" alt=""></a></li>
    <?php }?>
	</ul>
</div>
<div class="start button">Start</div>
<div class="stop button">Stop</div>
<?php if(isset($_SESSION['jaccuont']) && $_SESSION['jaccount']['id']==master){?><input name="number" id="number" class="number" type="text" /><?php }else{echo '<input value=\'未登陆\' class=\'number\' />';}?>
<div class="scroll right">
	<ul>
	<?php foreach($desc as $d){?>
    <li><a href="#"><img src="/ji_upload/tool/lucky/<?=$d->image?>.jpg" alt=""></a></li>
    <?php }?>
	</ul>
</div>
</div>
<div style="display:none;"><?=tongji?></div>
</body>
</html>
