<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Count Up</title>
<script type="text/javascript" src="/ji_js/jquery-2.1.4.min.js"></script>
<style type="text/css">
body{ min-width:980px; font-family:Verdana, Geneva, sans-serif; background-color:#EE085C; background-image:url(/ji_style/image/happynewyear.jpg); background-position:top; background-repeat:no-repeat;}
#left,#right{ width:460px; height:500px; border:1px solid #ccc; background-color:#FCFCFC; border-radius:15px;}
#left{ float:left;}
#right{ float:right;}
.box { max-width:960px; margin:0 auto; margin-top:100px;}
.box .time { width:100%; height:400px; line-height:400px; float:left; text-align:center;}
.box .time span{ font-size:140px; color:#18345C;}
.button{ width:100%; display:none; height:100px; float:left; text-align:center;}
.button span { width:100px; height:46px; float:left; margin-left:90px; border:1px solid #CCC; text-align:center; font-size:36px;border-radius: 10px; background-color:#A5C7FC; color:#fff; cursor:pointer;  line-height: 46px;}
.button span:hover { background-color:#00468C}
#startall { width:100%; margin-top:50px; height:100px; float:left; line-height:100px; color:#EE085C; text-align:center; font-size:60px;}
#startall:hover { background-color:#FF59AC; border-radius:10px; cursor:pointer}
input {  width: 200px;  float: left;  margin-left: 130px;  height: 40px;  border: 1px solid #eee;  text-align: center; font-size:30px; color:#00468C}

</style>
</head>

<body>
<div class="box" sroll="no">
    <!--min为分钟，sec为秒钟-->
    <div id="left">
    <input value="" placeholder='Team A' type="text" />
    <div class="time"><span id="left-min">00</span><span>:</span><span id="left-sec">00</span></div><div class="button"><span id="left-start">start</span><span id="left-stop">stop</span></div></div>
    
    <div id="right">
    <input value="" placeholder='Team B' type="text" />
    <div class="time"><span id="right-min">00</span><span>:</span><span id="right-sec">00</span></div><div class="button"><span id="right-start">start</span><span id="right-stop">stop</span></div></div>
    
    <div id="startall">Start All</div>
</div>
<script>
//左边的倒计时
    var left_time=0; //全局时间变量（秒数）
	var left_action;
    function left_up(){ //加时函数
        if(left_time < 1000000){ //如果不到5分钟
            ++left_time; //时间变量自增1
			if(parseInt(left_time/60)<10){
				$("#left-min").html('0'+parseInt(left_time/60)); //写入分钟数
			}else{
				$("#left-min").html(parseInt(left_time/60)); //写入分钟数
			}
            
            $("#left-sec").html(Number(parseInt(left_time%60/10)).toString()+(left_time%10)); //写入秒数（两位）
			left_action = setTimeout("left_up()", 1000); //设置1000毫秒以后执行一次本函数
        };
    };
	$('#left-start').click(function(){left_up();})
	$('#left-stop').click(function(){clearTimeout(left_action);})
		
</script>

<script>
//右边的倒计时
    var right_time=0; //全局时间变量（秒数）
	var right_action;
    function right_up(){ //加时函数
        if(right_time < 1000000){ //秒数
            ++right_time; //时间变量自增1
            if(parseInt(right_time/60)<10){
				$("#right-min").html('0'+parseInt(right_time/60)); //写入分钟数
			}else{
				$("#right-min").html(parseInt(right_time/60)); //写入分钟数
			}
            $("#right-sec").html(Number(parseInt(right_time%60/10)).toString()+(right_time%10)); //写入秒数（两位）
			right_action = setTimeout("right_up()", 1000); //设置1000毫秒以后执行一次本函数
        };
    };
	$('#right-start').click(function(){right_up();})
	$('#right-stop').click(function(){clearTimeout(right_action);})
		
</script>
<script>
$("#startall").click(function(){left_up();right_up();$("#startall").hide();$('.button').show();})
</script>
<script>
var key=0;
$(document).keypress(function(event){ 
    //空格键的ascll码是32
    if(event.keyCode==32 && key <1){
        left_up();right_up();$("#startall").hide();$('.button').show();
		++key;
    }
});
</script>
<div style="display:none;"><?=tongji?></div>
</body>
</html>
