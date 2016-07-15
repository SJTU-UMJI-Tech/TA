
	<div id="mmain" class="mmain">
		<h2>文件管理</h2><a class="maina" href="/manage/file_add"><span>添加</span></a>
<div class="activity">
<?php foreach ($file as $f): ?>
<li><?php if($f->file_publish == 0){?><span title="未发布" style="color:#FF0000; padding:0 10px;">◎</span><?php }else{?><span title="已发布" style="color:#009900; padding:0 10px;">●</span><?php }?>
<?php if(!empty($f->file_class)){$q = $this->db->query("select lm_name from ji_lanmu where id=".$f->file_class."")->row_array();?>
<span>[<?=$q['lm_name']?>]</span>
<?php }?>
<a href="#" class="title"><?=$f->file_name?></a><a class="act" href="file_edit/<?=$f->id?>" target="_self"><span>修改</span></a><a class="act" href="file_del/<?=$f->id?>" target="_self" onclick="return confirm('是否确认删除？删除后不会显示在后台列表中，但是仍旧存在于数据库中，可找回！')"><span>删除</span></a>
</li>
<?php endforeach?>
</div>

	</div>
</div>

</body>
</html>
