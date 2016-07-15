<!--*<?php
session_start();//启动session
print_r($_SESSION['user']);
?>*/-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tool</title>
<link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
<link href="/ji_style/tool.css" type="text/css" rel="stylesheet" />
</head>

<body id="home">
<div class="top notice" style="line-height:90px; background-color:#069; color:#fff; font-size:15px; text-align:center;">
	本站点正在开发中，敬请访问交大密西根学院官网 <a style="color:#fff;" href="http://umji.sjtu.edu.cn">http://umji.sjtu.edu.cn</a>
</div>
<div class="top">
	<?php include_once('top.php');?>
</div>

<div class="main tool">
	<div><a href="/tool/time/countup"><span style="background-color:#09C;">Count Up</span></a></div>
    <div><a href="/tool/time/countdown"><span style="background-color:#63F;">Count Down</span></a></div>
    <div><a href="/tool/lucky"><span style="background-color:#F63">Lucky Draw</span></a></div>
</div>
<div class="bottom"><span>本站为测试站点 beta 2.1</span><span>Address: 800 Dong Chuan Road,Shanghai, 200240, China</span><span><a href="http://umji.sjtu.edu.cn" target="_blank">© 2015 University of Michigan – Shanghai Jiao Tong University Joint Institute</a></span></div>
</body>
</html>