<div id="mmain" class="mmain">
    <h2>Page management</h2><a class="maina" href="page"><span>中文</span></a>
<div class="page">
<!--输出单页面开始-->
<?php foreach($pages as $p):?>
<li><div style="clear:both">
<?php if($p->page_publish == 0){?><span title="未发布" style="color:#FF0000; padding:0 10px;">◎</span><?php }else{?><span title="已发布" style="color:#009900; padding:0 10px;">●</span><?php }?>
<a href="/<?=$p->id?>" target="_blank" class="title"><?=$p->page_title?></a>
<?php if($p->page_m == 1){?><img src="/ji_style/image/mobile.gif"><?php }; //如果是手机页面，则出现手机图标?>
<a class="act" href="page_edit/<?=$p->id?>" target="_self"><span>Edit</span></a><a class="act" href="page_del/<?=$p->id?>" target="_self" onclick="return confirm('是否确认删除？删除后不会显示在后台列表中，但是仍旧存在于数据库中，可找回！')"><span>Delete</span></a>
<a class="act" href="page_edit/<?=$p->page_en?>" target="_self"><span>CN</span></a>
</div></li>
<?php endforeach;?>
<!--输出单页面结束-->
</div>
</div>

</body>
</html>

