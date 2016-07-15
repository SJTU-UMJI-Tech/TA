<?php 
/* php Jaccount */
if($_SESSION['jaccount']){
	echo 'Please refresh this page !';
}
session_start();//启动session
if(!$_SESSION['HTTP_REFERER']){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
}
if(isset($_SESSION['jaccount'])){//登录成功后
	header("Location:".$_SESSION['HTTP_REFERER']);
}
include('jaccount/clsJAccount.php');

$jam = new JAccountManager;
$checkkey = $jam->JAccountManager('jaji20150623','/opt/ji.sjtu.edu.cn/jaccount');
$strReturnURL='/jaccount.php';
$ht = $jam->checkLogin($strReturnURL);
$_SESSION['jaccount']=array('id'=>$ht['id'],'uid'=>$ht['uid'],'chinesename'=>$ht['chinesename'],'student'=>$ht['student'],'dept'=>$ht['dept']);
//student	yes-学生/no-教职员工/team-集体帐号/outside-校外用户/postphd-博士后/alumni-校友
if (($ht !=NULL) && ($jam->hasTicketInURL)) {
	$jam->redirectWithoutTicket();
}
$DisplayForm=false;
if (isset($_POST['Random_iv']) && ($_POST['Random_iv']=='343243abdecf3a7e')) {
	$src=$_POST["Name"].'@'.$_POST["Domain"];
	$encrypted=$jam->encrypt($src);
	$decrypt_d=$jam->decrypt(urldecode($encrypted));
}else{
	$DisplayForm=true;
}

/* php Jaccount end */
?>