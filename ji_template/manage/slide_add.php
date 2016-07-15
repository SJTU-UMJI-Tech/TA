
	<div id="mmain" class="mmain">
	<h2>添加幻灯片</h2>
		<form action="slide_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="config" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>幻灯片标题&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="slide_title" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>语言选择&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0">
    <select name="slide_en">
      <option value="0">中文</option>
      <option value="1">English</option>
    </select>
    </td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>类别</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0">
    <select name="slide_lm">
    <?php
	if($_SESSION['user'] != master){
	foreach ($lanmus as $l){
		$lanmu = $this->db->query("select * from ji_lanmu where id=".$l->lm_id."")->row_array();
		?>
      <option value="<?=$lanmu['id']?>"><?=$lanmu['lm_name']?></option>
    <?php }}else{foreach ($lanmus as $l){?>
		
	<option value="<?=$l->id?>"><?php if($l->lm_pid>0) echo ' -';?><?=$l->lm_name?></option>
	
	<? }}?>
    </select>
    </td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>简短介绍&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <textarea name="slide_content" cols="60" rows="3"></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>图片地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label><input type="file" name="slide_pic">
    可以使用绝对路径图片</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>链接地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="slide_url" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="slide_order" value="10" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否显示&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="slide_publish" checked="checked" value="1">
    显示 (默认显示，去掉勾选则不显示在网页中) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>手机版本&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="slide_m" value="1">手机 (默认为网页模式，勾选则为手机版本，内容只在手机网页显示) </label></td>
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
