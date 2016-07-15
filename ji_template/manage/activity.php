
	<div id="mmain" class="mmain">
		<h2>活动管理</h2><a class="maina" href="/manage/activity_add"><span>添加中文活动</span></a><a class="maina" href="activity_en"><span>English</span></a><form action="/manage/activity" method="post"><input name="s" type="text" /><input name="submit" type="submit" value="查询" /></form>
<div class="activity">
<?php foreach ($act as $a): ?>
<li><?php if($a->act_publish == 0){?><span title="未发布" style="color:#FF0000; padding:0 10px;">◎</span><?php }else{?><span title="已发布" style="color:#009900; padding:0 10px;">●</span><?php }?>
<?php if($a->act_class==1){?><span>[招生说明会]</span><?php }elseif($a->act_class==2){?><span>[校友活动]</span><?php }?>
<a href="/activity/view/<?=$a->id?>" target="_blank" class="title"><?=substr($a->act_name,0,90)?></a><?php if($a->act_m == 1){?><img src="/image/mobile.gif"><?php }?><a class="act" href="/manage/tuisong/activity/<?=$a->id?>" target="_self"><span>Ｔ</span></a><a class="act" href="/manage/activity_edit/<?=$a->id?>" target="_self"><span>修改</span></a><a class="act" href="/manage/activity_del/<?=$a->id?>" target="_self" onclick="return confirm('是否确认删除？删除后不会显示在后台列表中，但是仍旧存在于数据库中，可找回！')"><span>删除</span></a>

<?php
	$sqlen = $this->db->query("select * from `ji_activity` where act_en=".$a->id." and act_status=1");
	$sqlen = $sqlen->row_array();
	if($sqlen){
?>
	<a class="act" href="/manage/activity_edit/<?=$sqlen['id']?>" target="_self"><span>EN</span></a>
<?php }else{?>
	<a class="act" href="/manage/activity_add/<?=$a->id?>" target="_self"><span style="color:#FF0000">Add EN</span></a>
<?php }?>

</li>
<?php endforeach?>
</div>
<div class="pages" style="clear:both; margin-top:5px;">
<?php 
echo $pager;
?>
</div></div>
</div>

</body>
</html>
