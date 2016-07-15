
	<div id="mmain" class="mmain">
		<h2>Activity management</h2><a class="maina" href="activity"><span>中文</span></a><form action="activity_en" method="post"><input name="s" type="text" /><input name="submit" type="submit" value="查询" /></form>
<div class="activity">
<?php foreach ($act as $a): ?>
<li><?php if($a->act_publish == 0){?><span title="未发布" style="color:#FF0000; padding:0 10px;">◎</span><?php }else{?><span title="已发布" style="color:#009900; padding:0 10px;">●</span><?php }?>
<?php if($a->act_class==1){?><span>[Recruitment seminars]</span><?php }elseif($a->act_class==2){?><span>[Alumni activities]</span><?php }?>
<a href="/en/activity/view/<?=$a->id?>" target="_blank" class="title"><?=utf8_substr($a->act_name,0,60)?></a>
<?php if($a->act_m == 1){?><img src="/image/mobile.gif"><?php }?>
<a class="act" href="/manage/tuisong/activity/<?=$a->id?>" target="_self"><span>Ｔ</span></a>
<a class="act" href="/manage/activity_edit/<?=$a->id?>" target="_self"><span>Edit</span></a>
<a class="act" href="/manage/activity_del/<?=$a->id?>" target="_self" onclick="return confirm('是否确认删除？删除后不会显示在后台列表中，但是仍旧存在于数据库中，可找回！')"><span>Delete</span></a>
<a class="act" href="/manage/activity_edit/<?=$a->act_en?>" target="_self"><span>CN</span></a>

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
