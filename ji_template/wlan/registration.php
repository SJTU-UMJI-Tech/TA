<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" /><!--禁止页面放大-->
<meta name="format-detection" content="telephone=no"/><!--使设备浏览网页时对数字不启用电话功能-->

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>JI OPEN Wireless</title>
<link type="text/css" rel="stylesheet" href="/ji_style/wlan.css" />
<script src="/ji_js/jquery-2.1.4.min.js" language="javascript" type="text/javascript"></script>
</head>

<body>
<div class="top">
<img src="/ji_style/image/JI-LOGO-2.png" />
</div>
<?php 
/* php Jaccount */
session_start();//启动session
/* php Jaccount end */
if(isset($_SESSION['jaccount'])){//登录成功后
if($_SESSION['jaccount']['dept']!='密西根学院'){
	echo '您不是密西根的学生';
	die;
}else{
	$check = $this->db->query("select * from ji_student where user_id='".$_SESSION['jaccount']['id']."'")->result();
	if(!empty($check)){
		echo '<div class="form go"><p>You already have an account</p><a href="http://www.baidu.com">Login</a>    <a href="/jaccount_logout.php">Log out</a>    <a href="forget">Forgot Password</a></div>';	
		die;
	}
}
?>


<div class="form">
<form action="save" method="post">
<b>Set a Password</b>
<input name="student_id" placeholder="Student ID" readonly value="<?=$_SESSION['jaccount']['id']?>" type="text">
<input id="password" name="password" placeholder="Password" type="password">
<input id="confirm_password"name="confirm_password" placeholder="Confirm Password" type="password">
<input id="passwordfail" readonly="readonly" value="Passwords don't match" type="text">
<input id="submit" name="submit" type="submit" value="Submit" />
<a href="http://ji.sjtu.edu.cn/home/help/139" target="_blank"><span>Help</span></a>
</form>
</div>
<?
}else{
echo '<div class="form go"><a href="/jaccount.php">Create Account</a></div>
<div class="form"><a href="http://ji.sjtu.edu.cn/home/help/139" target="_blank"><span>Help</span></a></div>

';	
}
?>
<script type="text/javascript">
	$(function(){
		$("#confirm_password").keyup(function(){
			if($(this).val()==$("#password").val()){
				$("#passwordfail").hide();
				$("#submit").show();
			} else {
				$("#passwordfail").show();
				$("#submit").hide();
			}
		})	
	})
</script>
<div style="display:none;"><?=tongji?></div>
</body>
</html>