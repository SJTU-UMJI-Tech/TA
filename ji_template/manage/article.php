
	<div id="mmain" class="mmain">
		<h2>新闻管理</h2><a class="maina" href="/manage/article_add"><span>添加</span></a><a class="maina" href="/manage/article_en"><span>English</span></a><form action="article" method="post"><input name="s" type="text" /><input name="submit" type="submit" value="查询" /></form>
<div class="article">
<?php foreach ($article as $a): ?>
<li><?php if($a->art_publish == 0){?><span title="未发布" style="color:#FF0000; padding:0 10px;">◎</span><?php }else{?><span title="已发布" style="color:#009900; padding:0 10px;">●</span><?php }?>

<?php $q = $this->db->query("select lm_name from ji_lanmu where id=".$a->art_class."")->row_array();?>
<span>[<?=$q['lm_name']?>]</span>

<a target="_blank" href="/news/view/<?=$a->id?>" class="title"><?=utf8_substr($a->art_title,0,40)?></a>
<?php if($a->art_m == 1){?><img src="/image/mobile.gif"><?php }?>
<a class="art" href="/manage/tuisong/news/<?=$a->id?>" target="_self"><span>Ｔ</span></a>
<a class="art" href="/manage/article_edit/<?=$a->id?>" target="_self"><span>修改</span></a>
<a class="art" href="/manage/article_del/<?=$a->id?>" target="_self" onclick="return confirm('是否确认删除？')"><span>删除</span></a>
<?php
	$sqlenart = $this->db->query("select * from `ji_article` where art_en=".$a->id." and art_status=1");
	$sqlenart = $sqlenart->row_array();
	if($sqlenart){
?>
	<a class="art" href="/manage/article_edit/<?=$sqlenart['id']?>" target="_self"><span>EN</span></a>
<?php }else{?>
	<a class="art" href="/manage/article_add/<?=$a->id?>" target="_self"><span style="color:#FF0000">Add EN</span></a>
<?php }?>
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
