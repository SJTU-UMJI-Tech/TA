
	<div id="mmain" class="mmain">
		<h2>中文网站配置</h2>
<form action="config_save_cn" method="post">
  <table width="800" border="0" class="config" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>网站名称&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="site_name" value="<?=$cn['site_name']?>" />
    显示在所有标题后面</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>网站标题&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="site_title" value="<?=$cn['site_title']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>关键词&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="site_keywords" value="<?=$cn['site_keywords']?>" />
    使用英文逗号(,)分割</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>网站描述&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="site_descript" value="<?=$cn['site_descript']?>" />
    不超过150字</label></td>
  </tr>
  <!--<tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>英文开关&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="radio" name="en" <?php if($cn['en'] == 1){?>checked="checked" <?php };?>value="1" />
    开 
    <input type="radio" name="en" <?php if($cn['en'] == 0){?>checked="checked" <?php };?> value="0" />
    关</label></td>
  </tr>-->
  <tr>
    <td width="120" height="30" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="submit" name="Submit" value="保存" />
    </label></td>
  </tr>
</table>
</form>

<h2 style="margin-top:30px;">English Configration</h2>
<form action="config_save_en" method="post">
  <table width="800" border="0" class="config" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>Site Name&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="site_name" value="<?=$en['site_name']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>Site Title&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="site_title" value="<?=$en['site_title']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>Keywords&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="site_keywords" value="<?=$en['site_keywords']?>" />
    使用英文逗号(,)分割</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>Description&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="site_descript" value="<?=$en['site_descript']?>" />
    Less 150 words</label></td>
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
