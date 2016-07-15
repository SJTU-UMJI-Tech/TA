
	<div id="mmain" class="mmain">
		<h2>推送管理</h2><a class="maina" href="/manage/tuisong"><span>添加</span></a><form action="/manage/tuisong_list" method="post"><input name="s" type="text" /><input name="submit" type="submit" value="查询" /></form>
<div class="article">
<li><span title="注意" style="color:#ff0000; padding:0 10px;">★</span>
<span>请您设置3条新闻、3条活动、一个明星校友、一个明星教授为发布状态，其余信息置为未发布</span>
</li>
<?php foreach ($tuisong as $t): ?>
<li><?php if($t->publish == 0){?><span title="未发布" style="color:#FF0000; padding:0 10px;">◎</span><?php }else{?><span title="已发布" style="color:#009900; padding:0 10px;">●</span><?php }?>

<span>[<?=$t->class?>]</span>

<a target="_blank" href="#" class="title"><?=$t->title?></a><a class="art" href="/manage/tuisong_edit/<?=$t->id?>" target="_self"><span>修改</span></a><a class="art" href="/manage/tuisong_del/<?=$t->id?>" target="_self" onclick="return confirm('彻底删除，是否确认删除？')"><span>删除</span></a>
</li>
<?php endforeach?>
</div>
<!--<div class="pages" style="clear:both; margin-top:5px;">
<?php 
echo $pager;
?>
</div>-->
</div>
</div>

</body>
</html>
