
	<div id="mmain" class="mmain">
		<h2>添加推送</h2>
		<form action="/manage/tuisong_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="page_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>标题名称&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="title" value="<?=$title?>" />
    </label></td>
  </tr>
  
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>模块分类&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <select name="class">
	  <option value="news"<?php if($class==news){?> selected="selected"<?php }?>>首页新闻</option>
	  <option value="video"<?php if($class==video){?> selected="selected"<?php }?>>首页视频</option>
	  <option value="alumniimg">首页校友</option>
      <option value="activity"<?php if($class==activity){?> selected="selected"<?php }?>>首页活动</option>
	  <option value="alumni"<?php if($class==alumni){?> selected="selected"<?php }?>>明星校友</option>
	  <option value="faculty"<?php if($class==faculty){?> selected="selected"<?php }?>>明星教授</option>
    </select>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>语言分类&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <select name="ten">
	  <option value="0"<?php if($ten==0){?> selected="selected"<?php }?>>中文</option>
      <option value="1"<?php if($ten==1){?> selected="selected"<?php }?>>English</option>
    </select>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>图片&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><input name="pic2" type="hidden" value="<?=$pic?>" /><?php if(!empty($pic)){?><img src="/image/<?=$pic?>" width="100" /><br /><?php }?><label>
    <input type="file" name="pic" />
    允许的格式：jpg、png、gif</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>跳转地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="url" value="<?=$url?>" />  不需要跳转请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>日期时间&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="time" value="<?=$ttime?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>简要内容&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <textarea  name="summary" style="height:100px;"><?=$summary?></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="tuisong_order" value="<?php if(!empty($tuisong_order)){echo "$tuisong_order";}else{echo "10";}?>" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否显示&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="publish"<?php if(empty($publish) || $publish==1){?> checked="checked"<?php }?> value="1">
    显示 (默认显示，去掉勾选则不显示在网页中) </label></td>
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

</body>
</html>
