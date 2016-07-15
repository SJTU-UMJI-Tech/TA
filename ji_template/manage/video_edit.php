
	<div id="mmain" class="mmain">
	<h2>编辑视频</h2>
		<form action="../video_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="config" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>视频名称&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="v_title" value="<?=$v['v_title']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>视频简介&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <textarea name="v_summary" cols="60" rows="3"><?=$v['v_summary']?></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>缩略图&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><?php if(!empty($v['v_pic'])){?><img src="/ji_upload/video/<?=$v['v_pic']?>" height="90"><br /><?php }?><label><input type="file" name="v_pic">
    宽度比例200*160</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>视频地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="v_url" value="<?=$v['v_url']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO关键词&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="v_keywords" value="<?=$v['v_keywords']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO描述&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="v_descript" value="<?=$v['v_descript']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="v_order" value="<?=$v['v_order']?>" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否显示&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="v_publish" checked="checked" value="1">
    显示 (默认显示，去掉勾选则不显示在网页中) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="submit" name="Submit" value="保存" />
	  <input name="id" type="hidden" value="<?=$v['id']?>">
    </label></td>
  </tr>
</table>
</form>
	</div>
</div>

</body>
</html>
