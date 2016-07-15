<script charset="utf-8" src="/editor/kindeditor.js"></script>
<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#act_content');
        });
</script>
	<div id="mmain" class="mmain">
		<h2>添加活动</h2>
		<form action="/manage/activity_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="page_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>活动标题&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_name" value="<?=$actedit['act_name']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>活动分类&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <select name="act_class">
	  <option <?php if($actedit['act_class'] == '1'){?> selected="selected"<?php }?> value="1">招生说明会</option>
      <option <?php if($actedit['act_class'] == '2'){?> selected="selected"<?php }?> value="2">校友活动</option>
    </select>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>海报图片&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="act_pic_ab" type="hidden" value="<?=$actedit['act_pic']?>" /><?php if($actedit['act_pic']){?><img src="/image/<?=$actedit['act_pic']?>" width="200" /><br /><?php }?><input type="file" name="act_pic" />允许的格式：jpg、png、gif</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>活动地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_place" value="<?=$actedit['act_place']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>活动ID</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_redirect" value="<?=$actedit['act_redirect']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>跳转地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_url" value="<?=$actedit['act_url']?>" />  不需要跳转请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>开始时间&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_start" value="<?=$actedit['act_start']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>结束时间&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_end" value="<?=$actedit['act_end']?>" />  
    永久有效请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>活动简介&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <textarea  name="act_summary" style="height:100px;"><?=$actedit['act_summary']?></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>网页内容&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <textarea name="act_content" id="act_content" style="height:300px;"><?=$actedit['act_content']?></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO关键字&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_keywords" value="<?=$actedit['act_keywords']?>" />不设置请留空，,分割</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO描述&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_descript" value="<?=$actedit['act_descript']?>" />不做设置请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="act_order" value="<?=$actedit['act_order']?>" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否发布&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="act_publish" <?php if($actedit['act_publish'] == 1){?> checked="checked"<?php }?>  value="1">
    发布 (默发布，去掉勾选则不发布) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>手机版本&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="act_m"<?php if($actedit['act_m'] == 1){?> checked="checked"<?php }?> value="1">
    手机 (默认为网页模式，勾选则为手机版本，内容只在手机网页显示) </label></td>
  </tr>
  <?php 
if($actedit['id'] != ''){?>
	<input name="id" type="hidden" value="<?=$actedit['id']?>">
	<input name="cnid" type="hidden" value="<?=$actedit['act_en']?>">
<?php }?>
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
