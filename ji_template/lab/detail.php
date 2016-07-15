<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!--equivalence index-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$equipment['equipment_name']?> - UM-SJTU JI</title>
<link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
<link href="/ji_style/lab.css" type="text/css" rel="stylesheet" />
<script src="/ji_js/jquery-2.1.4.min.js" language="javascript" type="text/javascript"></script>
</head>

<body id="lab-detail">
<div class="top">
	<?php include_once('top.php');?>
</div>
<div class="main">
	<div class="title"><h1>Lab Equipment Management System</h1><form action="/lab/search" method="post"><span id="search">SEARCH</span><input name="search" placeholder="输入任意关键词"  type="text" /></form></div>
    <div class="lab">
    	<div class="category">
        	<?php foreach($lanmu as $l){?><h1>在<?=$l->lm_name;?>中检索</h1>
			<?php $sublanmu = $this->db->query("select * from ji_lanmu where lm_pid=".$l->id."")->result();?>
			<?php foreach($sublanmu as $s){?>
            <a href="/lab/category/lists/<?=$s->id;?>"><span><?=$s->lm_name;?></span></a>
			<?php }}?>
            
            <h1>按地点查询</h1>
            <?php foreach($places as $p){?>
			<a href="/lab/category/place/<?=$p->lab_place_id?>"><span><?=$p->lab_place_name?></span></a>
			<?php }?>
        </div>
        <div class="equipment">
        	<div class="img"><a target="_blank" title="点击查看大图" href="/ji_upload/lab/<?=$equipment['equipment_pic']?>"><img src="/ji_upload/lab/small/<?=$equipment['equipment_pic']?>" /></a></div>
            <div class="list">
            	<table width="100%" bgcolor="#CCCCCC" border="0" cellpadding="5" cellspacing="1">
                  <tr>
                    <td width="100" height="40" bgcolor="#FFFFFF">设备名称</td>
                    <td height="40" bgcolor="#FFFFFF"><b><?=$equipment['equipment_name']?></b></td>
                  </tr>
                  <tr>
                    <td width="100" height="40" bgcolor="#FFFFFF">设备规格</td>
                    <td height="40" bgcolor="#FFFFFF"><?=$equipment['equipment_size']?></td>
                  </tr>
                  <tr>
                    <td width="100" height="40" bgcolor="#FFFFFF">设备数量</td>
                    <td height="40" bgcolor="#FFFFFF"><?=$equipment['equipment_total']?></td>
                  </tr>
                  <tr>
                    <td width="100" height="40" bgcolor="#FFFFFF">存放地点</td>
                    <td height="40" bgcolor="#FFFFFF"><?=$place['lab_place_name']?></td>
                  </tr>
                  <tr>
                    <td width="100" height="40" bgcolor="#FFFFFF">适用课程</td>
                    <td height="40" bgcolor="#FFFFFF"><?=$equipment['equipment_course']?></td>
                  </tr>
                  <tr>
                    <td width="100" height="60" bgcolor="#FFFFFF">&nbsp;</td>
                    <td height="60" bgcolor="#FFFFFF"><a href="#/lab/borrow/equipment/id"><span>租借</span></a></td>
                  </tr>
                </table>
            </div>
            <div class="function">
            	<h1 class="h1">功能简介</h1>
                <div><?=$equipment['equipment_function']?></div>
            </div>
        </div>
    </div>
</div>
<div class="h20 clear"></div>
<?php include("footer.php");?>
<script type="text/javascript">

$(document).ready(
	function(){
		$('#search').click(function(){
			$('form').submit();
			});
	}
);

</script>
</body>
</html>