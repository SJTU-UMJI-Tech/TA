<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Count Down</title>
<script type="text/javascript" src="/ji_js/jquery-2.1.4.min.js"></script>
<style type="text/css">
body{ min-width:980px; font-family:Verdana, Geneva, sans-serif; background-color:#EE085C; background-image:url(/ji_style/image/happynewyear.jpg); background-position:top; background-repeat:no-repeat;}
#left{ width:100%; height:500px; border:1px solid #ccc; background-color:#FCFCFC; border-radius:15px;}
#left{ float:left;}
#right{ float:right;}
.box { max-width:960px; margin:0 auto; margin-top:100px;}
.box .time { width:100%; height:400px; line-height:400px; float:left; text-align:center;}
.box .time span{ font-size:140px; color:#18345C;}
.button{ width:100%; display:none; height:100px; float:left; text-align:center;}
.button span { width:100px; height:46px; float:left; margin-left:250px; border:1px solid #CCC; text-align:center; font-size:36px;border-radius: 10px; background-color:#A5C7FC; color:#fff; cursor:pointer;  line-height: 46px;}
.button span:hover { background-color:#00468C}
#startall { width:100%; margin-top:50px; height:100px; float:left; line-height:100px; color:#EE085C; text-align:center; font-size:60px;}
#startall:hover { background-color:#FF59AC; border-radius:10px; cursor:pointer}
input {  width: 200px;  float: left;  margin-left: 130px;  height: 40px;  border: 1px solid #eee;  text-align: center; font-size:30px; color:#ccc}

</style>
</head>

<body>

<div class="box" sroll="no">
    <!--min为分钟，sec为秒钟-->
    
    <div id="left"><input value="" placeholder='Time(Minute)' id="time" type="text" />
    <div class="time"><span id="left-min">00</span><span>:</span><span id="left-sec">00</span><span>:</span><span id="left-ms">00</span></div><div class="button"><span id="start">start</span><span id="stop">stop</span></div></div>
</div>

<script>
//左边的倒计时
    var globletime; //全局时间变量（秒数）
	var globleaction;
	var ms=100;
    function countdown(){ //加时函数
        if(globletime > 0){ //如果不到5分钟eval(document.getElementById('time')).value
            --globletime; //时间变量自增1
			if($("#left-min").text()<10){
				$("#left-min").html('0'+parseInt(globletime/60)); //写入分钟数
			}else{
				$("#left-min").html(parseInt(globletime/60)); //写入分钟数
			}
			
            $("#left-sec").html(Number(parseInt(globletime%60/10)).toString()+(globletime%10)); //写入秒数（两位）
			globleaction = setTimeout("countdown()", 1000); //设置1000毫秒以后执行一次本函数
        };
    };
	function msdown(){
		if($("#left-min").text()==0 && $("#left-sec").text()==0){
			clearTimeout(msaction);
			ms = 102;
			$("#left-ms").text('00');
		}
		if(ms>0 && ms<101){
			--ms;
			if(ms<10){
				$("#left-ms").html('0'+Number(parseInt(ms)).toString()); //写入毫米秒数（两位）
			}else{
				$("#left-ms").html(Number(parseInt(ms)).toString()); //写入毫米秒数（两位）
			}
			msaction = setTimeout("msdown()", 10);
		}else{
			ms=100;
			msaction = setTimeout("msdown()", 10);
		}
		
	}
	$('#start').click(function(){countdown();msdown();})
	$('#stop').click(function(){clearTimeout(globleaction);clearTimeout(msaction);})
		
</script>

<script>
var key=0;
$(document).keypress(function(event){ 
    //空格键的ascll码是32
    if(event.keyCode==32 && key <1){
		globletime = $("#time")[0].value*60;
        countdown();msdown();$('.button').show();
		++key;
    }
});
</script>
<div style="display:none;"><?=tongji?></div>
</body>
</html>
