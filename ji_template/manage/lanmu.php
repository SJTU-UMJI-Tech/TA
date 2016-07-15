
  <div id="mmain" class="mmain">
    <h2>栏目管理</h2><a class="maina" href="/manage/lanmu_add"><span>添加</span></a>
<div class="lanmu">
<?php foreach ($lanmu as $l): ?>
<li>
<?php if($l->lm_status == 0){?>
<span title="未发布" style="color:#FF0000; padding:0 10px;">◎</span>
<?php }else{?>
<span title="已发布" style="color:#009900; padding:0 10px;">●</span>
<?php }?>

<a class="title"><?=$l->lm_name?>[<?=$l->lm_enname?>][<?=$l->id?>]</a><?php if($_SESSION['user'] == master){?><a class="lm" href="lanmu_edit/<?=$l->id?>" target="_self"><span>修改</span></a><?php }?>

<?php
$sqlsonlm = $this->db->query("SELECT * from ji_lanmu where lm_pid=".$l->id."");
$sql = $sqlsonlm->result();
foreach($sql as $s):
?>
<ol><span title="二级栏目" style="color:#999999; padding:0 10px;">◎</span><?=$s->lm_name;?>[<?=$s->lm_enname?>][<?=$s->id?>]<a class="lm" href="lanmu_edit/<?=$s->id?>" target="_self"><span>修改</span></a></ol>
	<?php
	$thirdlanmu = $this->db->query("SELECT * from ji_lanmu where lm_pid=".$s->id."")->result();
	foreach($thirdlanmu as $t):
	?>
	<ol><span title="三级栏目" style="color:#999999; padding:0 10px; margin-left:30px;">■</span><?=$t->lm_name;?>[<?=$t->lm_enname?>][<?=$t->id?>]<a class="lm" href="lanmu_edit/<?=$t->id?>" target="_self"><span>修改</span></a></ol>
	<?php endforeach;?>
<?php endforeach;?>
</li>

<?php endforeach;?>
</div>

  </div>
</div>

</body>
</html>

