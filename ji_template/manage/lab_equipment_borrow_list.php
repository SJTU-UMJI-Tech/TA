
	<div id="mmain" class="mmain">
		<h2>借用管理</h2><a class="maina" href="/manage/lab"><span>设备管理</span></a><a class="maina" href="/manage/lab_equipment_add"><span>添加</span></a><a class="maina" href="/manage/lab_equipment_recycle"><span>回收站</span></a><form action="/manage/lab_search" style="float:right" method="post"><input name="s" placeholder="输入设备名称" type="text"><input name="submit" type="submit" value="搜索"></form>
<div class="equipment">
<?php foreach ($equipments as $e): ?>
<li>
<a href="lab_equipment_borrow_edit/<?=$e->borrow_id?>" class="title"><span style="width:300px;"><?=$e->equipment_name?></span></a><span style="width:100px;"><?=$e->student_name?></span><span style="width:100px;"><?=$e->student_mobile?></span><span style="width:160px;"><?=$e->borrow_begin?>/</span><span style="width:100px;"><?=$e->borrow_end?></span>
<?php if($e->borrow_status==0){?><a class="act" href="lab_equipment_borrow_approve/<?=$e->borrow_id?>" target="_self"><span>批准</span></a><a class="act" href="lab_equipment_borrow_refuse/<?=$e->borrow_id?>" target="_self"><span>驳回</span></a><?php }elseif($e->borrow_status==1){?>
<a class="act" href="lab_equipment_borrow_return/<?=$e->borrow_id?>" target="_self"><span>回收</span></a>
<?php }elseif($e->borrow_status==4){?>
<a class="act" target="_self"><span style="color:#ccc">已驳回</span></a>
<?php }?>
</li>
<?php endforeach?>
</div>

	</div>
</div>

</body>
</html>
