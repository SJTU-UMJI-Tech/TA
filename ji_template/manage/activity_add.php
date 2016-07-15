<script charset="utf-8" src="/editor/kindeditor.js"></script>
<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#act_content');
        });
</script>
	<div id="mmain" class="mmain">
		<?php if($id){?><h2>添加英文活动内容:<?php echo $id;?></h2><?php }else{?><h2>添加活动</h2><? }?>
		<form action="<?php if($id){echo "../activity_save";}else{echo "activity_save";}?>" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="page_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <?php if($id){?>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>中文标题&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" disabled="disabled" value="<?=$act['act_name']?>" />
    </label></td>
  </tr>
  <?php }?>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong><?php if($id){echo "英文";}else{echo "中文";}?>标题&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_name" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>活动分类&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <select name="act_class" <?php if($id){?> disabled="disabled"<?php }?>>
	  <option value="1"<?php if($act['act_class']==1){?> selected="selected"<?php }?>>招生说明会</option>
      <option value="2"<?php if($act['act_class']==2){?> selected="selected"<?php }?>>校友活动</option>
    </select>
    <?php if($id){?><input type='hidden' name='act_class' value='<?=$act['act_class']?>' /><?php }?>
    </label>
    
    </td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>海报图片&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="file" name="act_pic" />
    允许的格式：jpg、png、gif</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>活动地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_place" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>活动ID&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_redirect" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>跳转地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_url" value="" />  不需要跳转请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>开始时间&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_start" value="<?php echo date("Y-m-d G:i:s");?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>结束时间&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_end" value="<?php echo date("Y-m-d G:i:s");?>" />  
    永久有效请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>活动简介&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <textarea  name="act_summary" style="height:100px;"></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>网页内容&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <textarea name="act_content" id="act_content" style="height:300px;"></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO关键字&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_keywords" value="" />不设置请留空，,分割</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO描述&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="act_descript" value="" />不做设置请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="act_order" value="10" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否显示&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="act_publish" checked="checked" value="1">
    显示 (默认显示，去掉勾选则不显示在网页中) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>手机版本&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="act_m" value="1">手机 (默认为网页模式，勾选则为手机版本，内容只在手机网页显示) </label></td>
  </tr>
  <?php
//new
if($id){?>
<input type='hidden' name='cnid' value='<?php echo $id?>' />
<?php }else{?>
<input type='hidden' name='cnid' value='0' />
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
