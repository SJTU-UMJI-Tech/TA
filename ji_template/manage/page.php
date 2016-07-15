

  <div id="mmain" class="mmain">
    <h2>页面管理</h2><a class="maina" href="/manage/page_add"><span>添加中文页面</span></a><a class="maina" href="page_en"><span>English</span></a>
<div class="page">

<?php foreach($pages as $p){?>
<li><div style="clear:both">
<?php if($p->page_publish == 0){?><span title="未发布" style="color:#FF0000; padding:0 10px;">◎</span><?php }else{?><span title="已发布" style="color:#009900; padding:0 10px;">●</span><?php }?>
<?php $lanmu = $this->db->query("select * from ji_lanmu where id=".$p->page_lm."")->row_array();?>
<span>[<?=$lanmu['lm_name']?>]</span>
<a href="/newsletter/view/<?=$p->id?>" target="_blank" class="title"><?=$p->page_title?></a>
<?php if($p->page_m == 1){?><img src="/ji_style/image/mobile.gif"><?php }; //如果是手机页面，则出现手机图标?>
<a class="act" href="page_edit/<?=$p->id?>" target="_self"><span>修改</span></a><a class="act" href="page_del/<?=$p->id?>" target="_self" onclick="return confirm('是否确认删除？删除后不会显示在后台列表中，但是仍旧存在于数据库中，可找回！')"><span>删除</span></a>
<?php
	$page_en = $this->db->query("select * from `ji_page` where page_en=".$p->id." and page_status=1");
	$page_en = $page_en->row_array();
	if($page_en){
?>
	<a class="act" href="page_edit/<?=$page_en['id']?>" target="_self"><span>EN</span></a>
<?php }else{?>
	<a class="act" href="page_add/<?=$p->id?>" target="_self"><span style="color:#FF0000">Add EN</span></a>
<?php }?>
</div></li>
<?php }?>
</div>
</div>

</body>
</html>

