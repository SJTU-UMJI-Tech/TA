<script charset="utf-8" src="/editor/kindeditor.js"></script>
<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#page_content',{
                filterMode: false,//是否开启过滤模式
           });
        });
</script>
	<div id="mmain" class="mmain">
		<h2>编辑页面</h2>
<form action="/manage/page_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="page_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>页面标题&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="page_title" value="<?=$pageedit['page_title']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>简要内容&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <textarea name="page_summary" cols="50" rows="4"><?=$pageedit['page_summary']?></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>出版期&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="page_stage" value="<?=$pageedit['page_stage']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>所属栏目&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <select name="page_lm">
	  <?php if(isset($_SESSION['user']) && $_SESSION['user']==master){?><option value="0">做为单独页面使用</option><? }?>
	<?php foreach($lanmu as $l):
		$lm_name = $this->db->query("select * from ji_lanmu where id=".$l->id."")->row_array();
	?>
      <option <?php if($pageedit['page_lm'] == $l->id){?> selected="selected"<?php }?> value="<?=$l->id?>"><?=$lm_name['lm_name']?></option>
	  <?php 
	  $lanmuson = $this->db->query("SELECT * FROM ji_lanmu where lm_pid=".$l->id."");
	  $lr = $lanmuson->result();
	  foreach($lr as $s):
	  ?>
	  <option <?php if($pageedit['page_lm'] == $s->id){?> selected="selected"<?php }?> value="<?=$s->id?>">&nbsp;&nbsp;&nbsp;&nbsp;<?=$s->lm_name?></option>
      <?php 
	  $thirdlanmu = $this->db->query("SELECT * FROM ji_lanmu where lm_pid=".$s->id."")->result();
	  foreach($thirdlanmu as $t):
	  ?>
	  <option <?php if($pageedit['page_lm'] == $t->id){?> selected="selected"<?php }?> value="<?=$t->id?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<?=$t->lm_name?></option>
	  <?php endforeach;?>
	  <?php endforeach;?>
	<?php endforeach?>
    </select>
    </label></td>
  </tr>
  
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>形象图片&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="page_pic_ab" type="hidden" value="<?=$pageedit['page_pic']?>" /><?php if(!empty($pageedit['page_pic'])){?><img src="/ji_upload/page/<?=$pageedit['page_pic']?>" width="200" /><br /><?php }?></span><input type="file" name="page_pic" />允许的格式：jpg、png、gif 宽230，高129</label></td>
  </tr>
  
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>跳转地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="page_url" value="<?=$pageedit['page_url']?>" />  不需要跳转请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>网页内容&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <textarea name="page_content" id="page_content" style="height:300px;"><?=$pageedit['page_content']?></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO关键字&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="page_keywords" value="<?=$pageedit['page_keywords']?>" />不设置请留空，,分割</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO描述&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="page_descript" value="<?=$pageedit['page_descript']?>" />不设置请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="page_order" value="<?=$pageedit['page_order']?>" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否发布&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="page_publish"<?php if($pageedit['page_publish'] == 1){?> checked="checked"<?php }?> value="1">
    发布 (默认发布，去掉勾选则不发布) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>手机版本&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="page_m"<?php if($pageedit['page_m'] == 1){?> checked="checked"<?php }?> value="1">
    手机 (默认为网页模式，勾选则为手机版本，内容只在手机网页显示) </label></td>
  </tr>
  <?php 
if($pageedit['id'] != ''){?>
	<input name="id" type="hidden" value="<?=$pageedit['id']?>">
    <input name="cnid" type="hidden" value="<?=$pageedit['page_en']?>">
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
