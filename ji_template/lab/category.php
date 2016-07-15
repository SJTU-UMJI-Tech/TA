<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!--equivalence index-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UM-SJTU JI</title>
<link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
<link href="/ji_style/lab.css" type="text/css" rel="stylesheet" />
<script src="/ji_js/jquery-2.1.4.min.js" language="javascript" type="text/javascript"></script>
</head>
<?php
function place($id){
	if($id==1){return 'ME Lab';};
	if($id==2){return 'ECE Lab';};
	if($id==3){return 'General Engineering Lab';};
	if($id==4){return 'Optics Lab';};
	if($id==5){return '电磁学实验室';};
	if($id==6){return '机电一体化实验室';};
	if($id==7){return 'Student Innovation Center';};
	if($id==8){return '东上院激光切割室';};
}
?>
<body id="lab-category">
<div class="top">
	<?php include_once('top.php');?>
</div>
<div class="main">
	<div class="title"><h1>Lab Equipment Management System</h1><form action="/lab/search" method="post"><span id="search">SEARCH</span><input name="search" placeholder="输入任意关键词"  type="text" /></form></div>
    <div class="lab">
    	<div class="category">
        	<?php foreach($lanmu as $l){?><h1>在<?=$l->lm_name;?>中检索</h1>
			<?php $sublanmu = $this->db->query("select * from ji_lanmu where lm_pid=".$l->id."")->result();?>
            <a href="/lab/category/lists/<?=$l->id;?>"><span class="lm" <?php if($this->uri->segment(4)==$l->id){?>style="font-weight:bold; font-size:15px;"<?php }?>><?=$l->lm_name;?></span></a>
			<?php foreach($sublanmu as $s){?>
            <a href="/lab/category/lists/<?=$s->id;?>"><span class="lm" <?php if($this->uri->segment(4)==$s->id){?>style="font-weight:bold; font-size:15px;"<?php }?>><?=$s->lm_name;?></span></a>
			<?php }}?>
            
            <h1>按地点查询</h1>
            <?php foreach($places as $p){?>
			<a href="/lab/category/place/<?=$p->lab_place_id?>"><span><?=$p->lab_place_name?></span></a>
			<?php }?>
        </div>
        
        <div class="equipments">
        	<?php foreach($equipments as $e){?>
        	<a href="/lab/index/detail/<?=$e->equipment_id?>"><div><img src="/ji_upload/lab/small/<?=$e->equipment_pic?>" /><span class="name"><?=$e->equipment_name?></span></div></a>
            <?php }?>
        </div>
        
        <div class="list">
        	<a href="#"><div class="head"><span class="name">设备名称</span><span class="place">放置地点</span><span class="total">设备数量</span></div></a>
        	<?php foreach($equipments as $e){?>
        	<a href="/lab/index/detail/<?=$e->equipment_id?>"><div><span class="name"><?=$e->equipment_name?></span><span class="place"><?=place($e->equipment_place);?></span><span class="total"><?=$e->equipment_total?></span></div></a>
            <?php }?>
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