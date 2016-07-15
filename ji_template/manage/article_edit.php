<script charset="utf-8" src="/editor/kindeditor.js"></script>
<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#art_content');
        });
</script>
	<div id="mmain" class="mmain">
		<h2>添加新闻</h2>
		<form action="../article_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="article_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>新闻分类&nbsp;</strong></td>
    <td width="260" height="30" bgcolor="#F0F0F0"><label>
    <select name="art_class">
	<?php foreach($fenlei as $f):?>
	  <option<?php if($art['art_class'] == $f->id){?> selected="selected"<?php }?> value="<?=$f->id?>"><?=$f->lm_name?>[<?=$f->lm_enname?>]</option>
	<?php endforeach;?>
    </select>
    </label></td>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>(日期)发布时间&nbsp;</strong></td>
    <td width="260" height="30" bgcolor="#F0F0F0"><label><input type="text" class="inputs" name="art_addtime" value="<?=$art['art_addtime']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>(学生)作者&nbsp;</strong></td>
    <td width="260" height="30" bgcolor="#F0F0F0"><label>
    <input class="inputs" type="text" name="art_author" value="<?=$art['art_author']?>" /></label></td>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>标签&nbsp;</strong></td>
    <td width="260" height="30" bgcolor="#F0F0F0"><label>
    <input class="inputs" type="text" name="art_tags" value="<?=$art['art_tags']?>" /></label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>新闻标题&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="art_title" value="<?=$art['art_title']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>新闻图片&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <?php if($art['art_pic']){?><img src="/ji_upload/art/<?=$art['art_pic']?>" width="200" /><Br /><?php }?><input type="file" name="art_pic" />
    允许的格式：jpg、png、gif 200*114</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>跳转地址&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="art_url" value="<?=$art['art_url']?>" />不需要跳转请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>简要概述&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <textarea  name="art_summary" style="height:100px;"><?=$art['art_summary']?></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>新闻内容&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
      <textarea name="art_content" id="art_content" style="height:300px;"><?=$art['art_content']?></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO关键字&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="art_keywords" value="<?=$art['art_keywords']?>" />不设置请留空，,分割</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO描述&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="art_descript" value="<?=$art['art_descript']?>" />不做设置请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
      <input type="text" name="art_order" value="<?=$art['art_order']?>" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否显示&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="art_publish"<?php if($art['art_publish'] == '1'){?> checked="checked"<?php }?> value="1">
    显示 (默认显示，去掉勾选则不显示在网页中) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>手机版本&nbsp;</strong></td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="art_m"<?php if($art['art_m'] == 1){?> checked="checked"<?php }?> value="1">
    手机 (默认为网页模式，勾选则为手机版本，内容只在手机网页显示) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="680" height="30" colspan="3" bgcolor="#F0F0F0"><label>
      <input type="submit" name="Submit" value="保存" />
    </label></td>
  </tr>
</table>
<?php 
if($art['id'] != ''){?>
	<input name="id" type="hidden" value="<?=$art['id']?>">
    <input name="cnid" type="hidden" value="<?=$art['art_en']?>">
<?php }?>
</form>
	</div>
</div>

</body>
</html>
