
	<div id="mmain" class="mmain">
		<h2>搜索 ：<?=$search?></h2><a class="maina" href="/manage/lab_equipment_add"><span>添加</span></a><a class="maina" href="/manage/lab_equipment_recycle"><span>回收站</span></a><a class="maina" href="/manage/lab"><span>设备管理</span></a><form action="/manage/lab_search" style="float:right" method="post"><input name="s" placeholder="输入设备名称" value="<?=$search?>" type="text"><input name="submit" type="submit" value="搜索"></form>
<div class="equipment">
<?php foreach ($equipments as $e): ?>
<li>
<?php $lanmu = $this->db->query("select * from ji_lanmu where id=".$e->equipment_lm."")->row_array();?>
<span>[<?php if($lanmu['lm_pid']==46){echo 'ME';}else{echo 'ECE';}?>-<?=$lanmu['lm_name']?>]</span>
<a href="#" class="title"><?=$e->equipment_name?></a><a class="act" href="lab_equipment_edit/<?=$e->equipment_id?>" target="_self"><span>修改</span></a>
<?php if($e->equipment_status==0){?>
	<a class="act" href="lab_equipment_back/<?=$e->equipment_id?>" target="_self" onclick="return confirm('是否确认恢复？')"><span>恢复</span></a>
<?php }else{?>
<a class="act" href="lab_equipment_del/<?=$e->equipment_id?>" target="_self" onclick="return confirm('是否确认删除？删除后不会显示在后台列表中，但是仍旧存在于数据库中，可找回！')"><span>删除</span></a>
<?php }?>
</li>
<?php endforeach?>
</div>

	</div>
</div>

</body>
</html>
