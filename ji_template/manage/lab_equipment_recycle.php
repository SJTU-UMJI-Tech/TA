
	<div id="mmain" class="mmain">
		<h2>回收站</h2><a class="maina" href="/manage/lab_equipment_add"><span>添加</span></a><a class="maina" href="/manage/lab"><span>设备管理</span></a><a class="maina" href="/manage/lab_equipment_borrow_list"><span>借用管理</span></a>
<div class="activity">
<?php foreach ($equipments as $e): ?>
<li>
<?php $lanmu = $this->db->query("select * from ji_lanmu where id=".$e->equipment_lm."")->row_array();?>
<span>[<?php if($lanmu['lm_pid']==46){echo 'ME';}else{echo 'ECE';}?>-<?=$lanmu['lm_name']?>]</span>
<a href="#" class="title"><?=$e->equipment_name?></a><a class="act" href="lab_equipment_edit/<?=$e->equipment_id?>" target="_self"><span>修改</span></a><a class="act" href="lab_equipment_back/<?=$e->equipment_id?>" target="_self" onclick="return confirm('是否确认恢复该设备信息？')"><span>恢复</span></a>
</li>
<?php endforeach?>
</div>

	</div>
</div>

</body>
</html>
