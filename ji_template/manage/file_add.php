
	<div id="mmain" class="mmain">
		<h2>上传文件</h2>
		<form action="file_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="file_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>文件名称&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="file_name" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>栏目分类&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <select name="file_class">
    	<?php foreach($lanmu as $l):?>
      <option value="<?=$l->id?>"><?=$l->lm_name?></option>
      <?php 
          $lanmuson = $this->db->query("SELECT * FROM ji_lanmu where lm_pid=".$l->id."");
          $lr = $lanmuson->result();
          foreach($lr as $s):
          ?>
          <option value="<?=$s->id?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$s->lm_name?></option>
          <!--↓三级栏目-->
          <?php 
          $lanmuthree = $this->db->query("SELECT * FROM ji_lanmu where lm_pid=".$s->id."")->result();
          foreach($lanmuthree as $lt):
          ?>
          <option <?php if($file['file_class'] == $lt->id){?> selected="selected"<?php }?> value="<?=$lt->id?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<?=$lt->lm_name?></option>
          <?php endforeach;?>
          <!--↑三级栏目-->
          <?php endforeach;?>
      <?php endforeach;?>
    </select>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>语言&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <select name="file_en">
      <option value="0">中文</option>
      <option value="1">English</option>
    </select>
    </label></td>
  </tr>
  <tr>
    <td width="120" align="right" valign="middle" bgcolor="#CFE2FE"><strong>选择文件&nbsp;</strong></td>
    <td width="680" bgcolor="#F0F0F0"><label>
    <input type="file" name="file_file" />
    <br>
    允许的类型：png|jpg|gif|docx|doc|ppt|pdf|rar|mdb|sql|xls|xlsx|zip|iso</label></td>
  </tr>
  <tr>
    <td width="120" align="right" valign="middle" bgcolor="#CFE2FE"><strong>远程地址&nbsp;</strong></td>
    <td width="680" bgcolor="#F0F0F0"><label>
    <input type="text" name="file_url" value="" />  
    <br>
    本地上传请留空请留空，远程附件URL路径前加http://</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>上传时间&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="file_time" value="<?php echo date("Y-m-d G:i:s");?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="file_order" value="10" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否显示&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="file_publish" checked="checked" value="1">
    显示 (默认显示，去掉勾选则不显示在网页中) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="submit" name="Submit" value="保存" />
    </label></td>
  </tr>
</table>
</form>
	</div>
</div>

</body>
</html>
