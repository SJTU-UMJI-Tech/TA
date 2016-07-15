<script charset="utf-8" src="/editor/kindeditor.js"></script>
<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#art_content');
        });
</script>
	<div id="mmain" class="mmain">
		<?php if($this->uri->segment(3)){?><h2>添加英文文章内容:<?=$this->uri->segment(3);?></h2><?php }else{?><h2>添加新闻</h2><? }?>
		<form action="/manage/article_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="article_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>新闻分类&nbsp;</strong></td>
    <td width="260" height="30" bgcolor="#F0F0F0"><label>
    <select name="art_class" <?php if($this->uri->segment(3)){?> disabled="disabled"<?php }?>>
		<?php foreach($fenlei as $f):?>
        <option value="<?=$f->id?>"<?php if($art['art_class']==$f->id){?> selected="selected"<?php }?>><?=$f->lm_name?></option>
		<?php endforeach;?>
    </select>
    <?php if($this->uri->segment(3)){?><input name="art_class" type="hidden" value="<?=$art['art_class']?>" /><?php }?>
    </label></td>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE">(日期)<strong>发布时间&nbsp;</strong></td>
    <td width="260" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="art_addtime" class="inputs" value="<?php echo date("Y-m-d G:i:s");?>" />
    </label></td>
  </tr>
  
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE">(学生)<strong>作者&nbsp;</strong></td>
    <td width="260" height="30" bgcolor="#F0F0F0"><label>
    <input class="inputs" type="text" name="art_author" value="" /></label></td>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>标签&nbsp;</strong></td>
    <td width="260" height="30" bgcolor="#F0F0F0"><label>
    <input class="inputs" type="text" name="art_tags" value="" /></label></td>
  </tr>
<?php if($this->uri->segment(3)){?>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>中文标题&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" disabled="disabled" value="<?=$art['art_title']?>" />
    </label></td>
  </tr>  
<?php }?>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong><?php if($this->uri->segment(3)){echo "英文";}else{echo "中文";}?>标题&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="art_title" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>新闻图片&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="file" name="art_pic" />
    允许的格式：jpg、png、gif 200*114</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>跳转地址&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="art_url" value="" />不需要跳转请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>简要概述&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <textarea  name="art_summary" style="height:100px;"></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>新闻内容&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
      <textarea name="art_content" id="art_content" style="height:300px;"></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO关键字&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="art_keywords" value="" />不设置请留空，,分割</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO描述&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="art_descript" value="" />不做设置请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
      <input type="text" name="art_order" value="10" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否显示&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="art_publish" checked="checked" value="1">
    显示 (默认显示，去掉勾选则不显示在网页中) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>手机版本&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="art_m" value="1">手机 (默认为网页模式，勾选则为手机版本，内容只在手机网页显示) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
      <input type="submit" name="Submit" value="保存" />
    </label></td>
  </tr>
</table>
<?php if($this->uri->segment(3)){?>
<input name="cnid" type="hidden" value="<?=$this->uri->segment(3)?>" />
<?php }else{?>
<input name="cnid" type="hidden" value="0" />
<?php }?>
</form>
	</div>
</div>

</body>
</html>
