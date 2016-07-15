
	<div id="mmain" class="mmain">
		<h2>设备管理</h2><a class="maina" href="/manage/lab_equipment_add"><span>添加</span></a><a class="maina" href="/manage/lab_equipment_recycle"><span>回收站</span></a><a class="maina" href="/manage/lab_equipment_borrow_list"><span>借用管理</span></a><form action="/manage/lab_search" style="float:right" method="post"><input name="s" placeholder="输入设备名称" type="text"><input name="submit" type="submit" value="搜索"></form>
<div class="equipment">
<?php foreach ($equipments as $e): ?>
<li>
<?php $lanmu = $this->db->query("select * from ji_lanmu where id=".$e->equipment_lm."")->row_array();?>
<span>[<?php if($lanmu['lm_pid']==46){echo 'ME-';}elseif($lanmu['lm_pid']==47){echo 'ECE-';}?><?=$lanmu['lm_name']?>]</span>
<a target="_blank" href="/lab/index/detail/<?=$e->equipment_id?>" class="title"><?=$e->equipment_name?></a><a class="act" href="lab_equipment_edit/<?=$e->equipment_id?>" target="_self"><span>修改</span></a><a class="act" href="lab_equipment_del/<?=$e->equipment_id?>" target="_self" onclick="return confirm('是否确认删除？删除后不会显示在后台列表中，但是仍旧存在于数据库中，可找回！')"><span>删除</span></a><a class="act" href="lab_equipment_borrow_add/<?=$e->equipment_id?>" target="_self"><span>外借</span></a>
</li>
<?php endforeach?>
</div>
<div class="pages" style="clear:both; margin-top:5px;">
<?php 
echo $pager;
?>
</div>
</div>
</div>

</body>
</html>
