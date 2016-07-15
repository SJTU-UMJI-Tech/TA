
	<div id="mmain" class="mmain">
		<h2>修改幻灯片</h2>
		<form action="/manage/slide_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="config" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>幻灯片标题&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="slide_title" value="<?=$slide['slide_title']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>语言选择&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0">
    <select name="slide_en">
      <option value="0"<?php if($slide['slide_en']==0){?> selected="selected"<?php }?>>中文</option>
      <option value="1"<?php if($slide['slide_en']==1){?> selected="selected"<?php }?>>English</option>
    </select>
    </td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>简短介绍&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <textarea name="slide_content" cols="60" rows="3"><?=$slide['slide_content']?></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>图片地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label><input name="slide_pic_ab" type="hidden" value="<?=$slide['slide_pic']?>" /><?=$slide['slide_pic']?><input type="file" name="slide_pic"></label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>链接地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="slide_url" value="<?=$slide['slide_url']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="slide_order" value="<?=$slide['slide_order']?>" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否显示&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="slide_publish"<?php if($slide['slide_publish'] == 1){?> checked="checked"<?php }?> value="1">
    显示 (默认显示，去掉勾选则不显示在网页中) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>手机版本&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="slide_m"<?php if($slide['slide_m'] == 1){?> checked="checked"<?php }?> value="1">
    手机 (默认为网页模式，勾选则为手机版本，内容只在手机网页显示) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="submit" name="Submit" value="保存" />
    </label></td>
  </tr>
</table>
<?php 
if($slide['id'] != ''){?>
	<input name="id" type="hidden" value="<?=$slide['id']?>">
<?php }?>
</form>
	</div>
</div>

</body>
</html>
