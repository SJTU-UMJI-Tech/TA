<!--*<?php
session_start();//启动session
print_r($_SESSION['user']);
?>*/-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Card</title>
<link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
<link href="/ji_style/home.css" type="text/css" rel="stylesheet" />
</head>

<body id="home">
<div class="top notice" style="line-height:90px; background-color:#069; color:#fff; font-size:15px; text-align:center;">
	本站点正在开发中，敬请访问交大密西根学院官网 <a style="color:#fff;" href="http://umji.sjtu.edu.cn">http://umji.sjtu.edu.cn</a>
</div>
<div class="top">
	<?php include_once('top.php');?>
</div>

<div class="main">
	<div class="list-left">
    	<p>IT Help</p>
    	<ol>
        	<li><a href="/home/help/"><?=$data?></a></li>
        </ol>
        <p>IT Download</p>
    	<ol>
        	<li><a href="/home/help/">aaa</a></li>
        </ol>
    </div>
    <div class="right-nav">
    	<a href="http://umji.sjtu.edu.cn" title="密西根学院官网" target="_blank"><span style="width:200px; background-color:#390; color:#eee;">UM-SJTU JI</span></a>
        <a href="http://sakai.umji.sjtu.edu.cn" title="SAKAI在线学习管理系统" target="_blank"><span style="width:200px; background-color:#09C; color:#fff;">SAKAI</span></a>
        <a href="http://umji.sjtu.edu.cn/bs" title="会议室预定系统" target="_blank"><span style="width:158px; background-color:#CC0; color:#fff;">MRBS</span></a>
        <a href="http://www.umich.edu" title="UM官网" target="_blank"><span style="width:312px; background-color:#39F; color:#fff;">University of Michigan</span></a>
        <a href="http://oias.umji.sjtu.edu.cn" title="在线国际招生系统" target="_blank"><span style="width:250px; background-color:#06C; color:#fff;">OIAS</span></a>
        <a href="http://en.sjtu.edu.cn" title="上海交通大学" target="_blank"><span style="width:162px; background-color:#C60; color:#fff;">SJTU</span></a>
        <a href="http://202.120.63.11:8888/" title="本科生选课系统" target="_blank"><span style="width:400px; background-color:#FCB21E; color:#fff;">Academic Information Service</span></a>
        <a href="/equivalence/index" title="转学分"><span style="width:304px; background-color:#FC81DA; color:#fff;">Course Equivalencies</span></a>
        <a href="/contactlist" title="通讯录" target="_blank"><span style="width:258px; background-color:#699; color:#fff;">Contact List</span></a>
        <a href="http://mail.sjtu.edu.cn" title="上海交通大学邮箱系统" target="_blank"><span style="width:120px; background-color:#9D78E5; color:#fff;">Email</span></a>
        <a href="/lab/index" title="实验室设备管理系统" target="_blank"><span style="width:120px; background-color:#3C6; color:#fff;">LEMS</span></a>
        <a href="/advising" title="本科生选课系统" target="_blank"><span style="width:318px; background-color:#3595F4; color:#fff;">Student Advising Registration</span></a>
        
        
    </div>
</div>
<div class="bottom"><span>本站为测试站点 beta 2.1</span><span>Address: 800 Dong Chuan Road,Shanghai, 200240, China</span><span><a href="http://umji.sjtu.edu.cn" target="_blank">© 2015 University of Michigan – Shanghai Jiao Tong University Joint Institute</a></span></div>
</body>
</html>