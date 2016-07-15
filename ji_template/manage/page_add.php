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
		<?php if($id){?><h2>Add new En Page for ID:<?php echo $id;?></h2><?php }else{?><h2>添加页面</h2><? }?>
		<form action="/manage/page_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="page_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <?php if($id){?>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>中文&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" disabled="disabled" value="<?=$page['page_title']?>" />
    </label></td>
  </tr>
  <?php }?>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>页面标题&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="page_title" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>简要内容&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <textarea name="page_summary" cols="50" rows="4"></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>出版期&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="page_stage" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>所属栏目&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    
        <select name="page_lm"<?php if($id){?> disabled="disabled"<?php }?>>
          <?php if(isset($_SESSION['user']) && $_SESSION['user']==master){?><option value="0">做为单独页面使用</option><? }?>
        <?php foreach($lanmu as $l):
			$lm_name = $this->db->query("select * from ji_lanmu where id=".$l->id."")->row_array();
		?>
          <option value="<?=$l->id?>" <?php if($page['page_lm'] == $l->id){?>selected="selected" <?php }?>><?=$lm_name['lm_name']?></option>
          <?php 
          $lanmuson = $this->db->query("SELECT * FROM ji_lanmu where lm_pid=".$l->id."")->result();
          foreach($lanmuson as $ls):
          ?>
          <option value="<?=$ls->id?>" <?php if($page['page_lm'] == $ls->id){?>selected="selected" <?php }?>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$ls->lm_name?></option>
          <?php $sublanmu = $this->db->query("SELECT * FROM `ji_lanmu` where lm_pid=".$ls->id."")->result();//获取子栏目
	  		foreach($sublanmu as $s){?>
      <option value="<?=$s->id?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<?=$s->lm_name?>[<?=$s->lm_enname?>]</option>
    	  <?php }?>
          <?php endforeach;?>
        <?php endforeach?>
        </select>
	<?php if($id){?><input type='hidden' name='page_lm' value='<?=$page['page_lm']?>' /><?php }?>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>形象图片&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="file" name="page_pic" />
    允许的格式：jpg、png、gif 宽230，高129</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>跳转地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="page_url" value="" />  不需要跳转请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>网页内容&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <textarea name="page_content" id="page_content" style="height:300px;"></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO关键字&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="page_keywords" value="" />不设置请留空，,分割</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO描述&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="page_descript" value="" />不做设置请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="page_order" value="10" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否发布&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="page_publish" checked="checked" value="1">发布 (默认显示，去掉勾选则不发布) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>手机版本&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="page_m" value="1">手机 (默认为网页模式，勾选则为手机版本，内容只在手机网页显示) </label></td>
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
