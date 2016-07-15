<!--
禁止任何人私自出售本程序，购买正版，联系Q 525562633
-->
<?php
//验证用户权限
$permit = $this->db->query("select * from ji_user_permission where user_id='".$_SESSION['user']."' and module='".$module."'")->result();
if($module=='home'){$permit =2; }
if($_SESSION['user']==master){$permit =1; }
if(!$permit){ echo $_SESSION['user']; echo ', you have no permissions to visit this page.'; die;}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学院信息管理系统管理中心 - 服务Q：525562633</title>
<link href="/ji_style/manage.css" type="text/css" rel="stylesheet" />
<script language="javascript" src="/ji_js/jquery-1.8.3.min.js"></script>
</head>

<body>
<div id="mhead">
	<div class="logo"><span>学院信息管理系统管理中心</span></div>
	<div class="userinfo">
		<li><a href="/login/logout">退出登录</a></li>
		<li><a href="/manage/user_password"><?=$_SESSION['user']?></a></li>
		<li><a href="http://www.xiaohuang.cc" target="_blank">技术支持</a></li>
		<li><a href="/" target="_blank">网站首页</a></li>
	</div>
</div>
<div id="control">
	<div id="mleft" class="mleft">
    	<li><a href="/manage/home" target="_self"><span>基本信息</span></a></li>
    	<?php if($permit=='1'){ //如果是管理员的话
		$allmodules = $this->Mmanage->get_allmodules();
		foreach($allmodules as $a){
		?>
    	<li><a href="/manage/<?=$a->module?>" target="_self"><span><?=$a->module_name?></span></a></li>
		<?php }}elseif($permit && $permit!='1'){//如果是普通用户登录
        $mymodules = $this->Mmanage->get_mymodules();
		foreach($mymodules as $m){
        ?>
        <li><a href="/manage/<?=$m->module?>" target="_self"><span><?=$m->module_name?></span></a></li>
        <?php }}?>
	</div>
<?php
function utf8_substr($str,$start=0) {//用来处理中文字数
    if(empty($str)){
        return false;
    }
    if (function_exists('mb_substr')){
        if(func_num_args() >= 3) {
            $end = func_get_arg(2);
            return mb_substr($str,$start,$end,'utf-8');
        }
        else {
            mb_internal_encoding("UTF-8");
            return mb_substr($str,$start);
        }       
 
    }
    else {
        $null = "";
        preg_match_all("/./u", $str, $ar);
        if(func_num_args() >= 3) {
            $end = func_get_arg(2);
            return join($null, array_slice($ar[0],$start,$end));
        }
        else {
            return join($null, array_slice($ar[0],$start));
        }
    }
}
?>