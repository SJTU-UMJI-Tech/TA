<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if(isset($_SESSION['jaccount']) && $_SESSION['jaccount']['dept']!='密西根学院'){echo '系统检测到您不是密西根的学生，已停止对您授权访问该页面';die;}?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Advising Registration - UMSJTUJI</title>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" /><!--禁止页面放大-->
<meta name="format-detection" content="telephone=no"/><!--使设备浏览网页时对数字不启用电话功能-->
<link href="/ji_style/advising.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/ji_js/jquery-2.1.4.min.js"></script>
</head>

<body>
<div class="head">
	<div class="top">UNIVERSITY OF MICHIGAN - SHANGHAI JIAO TONG UNIVERSITY JOINT INSTITUTE</div>
    <div class="logo"><img src="/ji_style/image/umsjtu-logo.jpg" /></div>
</div>
<div class="line"></div>
<div class="note">
<?=$content['key']?>
</div>

<?php 
if($open['key']=='true' && $start['key'] <= today && today <= $end['key']){?>

<div class="form">
<?
if($student['advisor_id'] != NULL && $student['student_status']==0){?>
<p>
You have successfully chosen <?php echo $advisor['advisor_enname'];?>(<?php echo $advisor['advisor_cnname'];?>) as your advisor</p>
<p>You can change your advisor by resubmitting</p>
<?PHP }?>
<?php if(isset($_SESSION['jaccount'])){//登录成功后
	if($student && $student['student_status']==0){//如果有这个学生，并且允许学生选择老师?>
<form action="/advising/check" name="check" id="form" method="post">
<li><input name="student_name" value="<?=$_SESSION['jaccount']['chinesename']?>" readonly="readonly" type="text" /></li>
<li><input name="student_id" type="text" value="<?=$_SESSION['jaccount']['id']?>" readonly="readonly" /></li>
<li>
    <select name="advisor_id" <?php if($rs['student_status']==2){?> disabled="disabled"<?php }?>>
        <option value="0">Choose Advisor</option>
    <?php foreach($advisors as $a){?>
        <option <?php if($a->advisor_count >=$a->advisor_top){?>disabled="disabled"<?php  }?><?php if($a->advisor_id==$student['advisor_id']){?> style="color:#ff0000" selected="selected"<?php  }?> value="<?=$a->advisor_id?>">[<?=$a->advisor_major?>] <?=$a->advisor_enname?> <?=$a->advisor_cnname?> (<?=$a->advisor_top-$a->advisor_count?> left)</option>
    <?php }?>
    </select>
</li>
<li style="margin-top:20px;"><input name="submit" class="submit" type="submit" value="Submit" /></li></form>
<?php }elseif($student && $student['student_status']==1){
	echo '<p>Your advisor has been assigned</p>';//警告的
	echo '<p>Your advisor is '.$advisor['advisor_enname'].'</p>';
}else{
	echo '<li style="margin-top:20px;"><input name="" class="submit" type="submit" value="You are not able to choose any advisor" /></li>';	
}}else{?>
<li style="margin-top:20px;  width: 300px;  background-color: #485b7d;  color: #fff;  font-size: 16px;  cursor: pointer;  text-align: center;  line-height: 40px;  height: 40px;  border: 0;  float: left;  border-radius: 5px;"><a style="color:#fff;" href="/jaccount.php">Jaccount Login</a></li>
<?php }?>
</div>
<?php }else{?>
<div class="form"><li style="margin-top:20px;  width: 300px;  background-color:#C90;  color: #fff;  font-size: 16px;  cursor: pointer;  text-align: center;  line-height: 40px;  height: 40px;  border: 0;  float: left;  border-radius: 5px;"><a style="color:#fff;" href="">STOP SELECTION</a></li></div>
<?php }?>


<div class="qrcode"><img src="/ji_style/image/advising_qrcode.png" width="100%" /><br /><span>Scan QR Codes to Mobile</span></div>

<div class="line-b"></div>
<div class="foot">
<p>© 2014 <a href="http://umji.sjtu.edu.cn">University of Michigan – Shanghai Jiao Tong University Joint Institute</a> </p>
<p><a href="http://sakai.umji.sjtu.edu.cn">Sakai</a><a href="http://umji.sjtu.edu.cn/about/administrative-offices/academic-affairs-division/undergraduate-education-office/">Contact Us</a></p>
</div>
<div class="clear"></div>

<div class="fixed"><div class="error"><span></span></div></div>
<script type="text/javascript">
function callerror(err){
	$(".error span").text(err);
	$(".error").slideDown();
	setTimeout(function(){
		$(".error").slideUp();
	},8000);
}
</script>
<script type="text/javascript">
$(function () {
	<? if($student['advisor_id'] == NULL && isset($_SESSION['jaccount'])){?>
	err = 'You have not chosen an advisor, please submit it as soon as possible！'; callerror(err); return false;
	<?php }?>
	<? if($student['advisor_id'] != NULL && $student['student_status']==0){?>
	err = '
You have successfully chosen <?php echo $advisor['advisor_enname'];?>(<?php echo $advisor['advisor_cnname'];?>) as your advisor.
You can change your advisor by resubmitting'; callerror(err); return false;
	<?PHP }elseif($student['advisor_id'] != NULL && $student['student_status']==1){?>
		err = 'Your advisor has been assigned. Your advisor is <?=$advisor['advisor_enname']?>'; callerror(err); return false;
		
	<?php }?>
	
});
</script>
<div style="display:none;"><?=tongji?></div>
</body>
</html>