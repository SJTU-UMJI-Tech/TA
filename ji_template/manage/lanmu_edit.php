<?php foreach($onelanmu as $o):?>
  <div id="mmain" class="mmain">
    <h2>修改栏目</h2>
	<form action="../lanmu_save" method="post" >
<table width="800" border="0" class="page_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>栏目名称&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="lm_name" value="<?=$o->lm_name;?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>英文名称&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="lm_enname" value="<?=$o->lm_enname;?>" />
    </label></td>
  </tr>
  
  <tr<?php if(!isset($_SESSION['user']) || $_SESSION['user']!=master){echo " style='display:none'";}?>>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>父级栏目&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <select name="lm_pid">
	  <option <?php if($o->lm_pid == 0){?> selected="selected"<?php };?> value="0">创建为一级栏目</option>
	<?php foreach($lanmu as $l):?>
      <option <?php if($o->lm_pid == $l->id){?> selected="selected"<?php };?> value="<?=$l->id?>"><?=$l->lm_name?>[<?=$l->lm_enname?>]</option>
      <?php $sublanmu = $this->db->query("SELECT * FROM `ji_lanmu` where lm_pid=".$l->id."")->result();//获取子栏目
	  		foreach($sublanmu as $s){?>
      <option value="<?=$s->id?>" <?php if($o->lm_pid == $s->id){?> selected="selected"<?php };?>>&nbsp;&nbsp;-<?=$s->lm_name?>[<?=$s->lm_enname?>]</option>
      <?php }?>
	<?php endforeach?>
    </select>
    </label></td>
  </tr>
  
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO关键字&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="lm_keywords" value="<?=$o->lm_keywords;?>" />不设置请留空，,分割</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO描述&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="lm_descript" value="<?=$o->lm_descript;?>" />不做设置请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="lm_order" value="<?=$o->lm_order;?>" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否显示&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="lm_status" checked="checked" value="1">
    显示 (默认显示，去掉勾选则不显示) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="submit" name="Submit" value="保存" />
    </label></td>
  </tr>
</table>
<input name="id" type="hidden" value="<?=$o->id;?>">
</form>
  </div>
  <?php endforeach;?>
</div>

</body>
</html>

