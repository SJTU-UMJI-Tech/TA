
	<div id="mmain" class="mmain">
		<h2>添加设备</h2>
		<form class="equipment" action="/manage/lab_equipment_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="page_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>名称&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="equipment_name" type="text" id="equipment_name" value="" />
    </label></td>
  </tr>
  
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>类目&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <select name="equipment_lm">
    <?php foreach($lanmu as $l){?>
	  <option value="<?=$l->id;?>"><?=$l->lm_name;?></option>
      <?php $sublanmu = $this->db->query("select * from ji_lanmu where lm_pid=".$l->id."")->result();?>
      <?php foreach($sublanmu as $s){?>
	  <option value="<?=$s->id;?>"> - <?=$s->lm_name;?></option>
    <?php }}?>
    </select>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>图片&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><input name="pic2" type="hidden" value="<?=$pic?>" /><?php if(!empty($pic)){?><img src="/image/<?=$pic?>" width="100" /><br /><?php }?><label>
    <input type="file" name="equipment_pic" id="equipment_pic" />
    允许的格式：jpg、png、gif</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>数量&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="equipment_total" type="text" id="equipment_total" /></label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>规格&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="equipment_size" type="text" id="equipment_size" /> </label></td>
  </tr>
  
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>供应单位&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="equipment_supply" type="text" id="equipment_supply" /> </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>生产厂家&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="equipment_company" type="text" id="equipment_company" /> </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>保管人&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="equipment_keeper" type="text" id="equipment_keeper" /> </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>设备编号&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="equipment_number" type="text" id="equipment_number" /> </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>放置地点&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <select name="equipment_place">
    <?php foreach($places as $p){?>
      <option value="<?=$p->lab_place_id?>"><?=$p->lab_place_name?></option>
    <?php }?>
    </select>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>功能概述&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <textarea name="equipment_function" style="height:500px;" id="equipment_function"></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>适用课程&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input name="equipment_course" type="text" id="equipment_course" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否外借&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="equipment_borrow" type="checkbox" id="equipment_borrow" value="1">
    外借(勾选后则表示该设备可外借)</label></td>
  </tr>
  <tr>
    <td width="120" height="30" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="submit" name="Submit" value="保存" />
    </label></td>
  </tr>
</table>
<input name="fid" type="hidden" value="<?=$fid?>" />
<?php if(!empty($tid)){?><input name="tid" type="hidden" value="<?=$tid?>" /><?php }?>
</form>
	</div>
</div>
<script charset="utf-8" src="/editor/kindeditor.js"></script>
<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#equipment_function');
        });
</script>

</body>
</html>
