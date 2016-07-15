<?php
include('jaccount/clsJAccount.php');
session_start();//启动session
$jam = new JAccountManager;
$checkkey = $jam->JAccountManager('jaji20150623','/opt/ji.sjtu.edu.cn/jaccount');
session_unset();
session_destroy();
$jam->logout('/home');//注销

?>