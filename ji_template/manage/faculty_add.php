<script charset="utf-8" src="/editor/kindeditor.js"></script>
<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#act_content');
        });
</script>
	<div id="mmain" class="mmain">
		<h2>添加人员</h2>
		<form action="/manage/faculty_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="page_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>人员姓名&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input <?php if($faculty){?>disabled="disabled" <?php }?>type="text" name="f_name" value="<?php if($faculty){echo $faculty['f_name'];}?>" />
    </label></td>
  </tr>
  <?php if($faculty){?>
    <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>英文姓名&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="f_name" value="" />
    </label></td>
  </tr>
  <?php }?>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>人员分类&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
	
    <select name="f_style" <?php if($faculty){?>disabled="disabled"<?php }?>>
      <option value="1"<?php if($faculty['f_style']==1){?> selected="selected"<?php }?>>教授</option>
      <option value="0"<?php if($faculty['f_style']==0){?> selected="selected"<?php }?>>校友</option>
    </select>
	<?php if($faculty){?>
    <input name="f_style" type="hidden" value="<?=$faculty['f_style']?>" />
    <?php }?>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>研究方向&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <select name="f_class" <?php if($faculty){?>disabled="disabled"<?php }?>>
      <option value="金融学"<?php if($faculty['f_class']=='金融学'){?> selected="selected"<?php }?>>金融学</option>
      <option value="经济学"<?php if($faculty['f_class']=='经济学'){?> selected="selected"<?php }?>>经济学</option>
      <option value="管理学"<?php if($faculty['f_class']=='管理学'){?> selected="selected"<?php }?>>管理学</option>
      <option value="市场营销"<?php if($faculty['f_class']=='市场营销'){?> selected="selected"<?php }?>>市场营销</option>
      <option value="会计财务"<?php if($faculty['f_class']=='会计财务'){?> selected="selected"<?php }?>>会计财务</option>
      <option value="运营管理"<?php if($faculty['f_class']=='运营管理'){?> selected="selected"<?php }?>>运营管理</option>
      <option value="品牌管理"<?php if($faculty['f_class']=='品牌管理'){?> selected="selected"<?php }?>>品牌管理</option>
      <option value="战略管理"<?php if($faculty['f_class']=='战略管理'){?> selected="selected"<?php }?>>战略管理</option>
    </select>
    <?php if($faculty){?>
    <input name="f_class" type="hidden" value="<?=$faculty['f_class']?>" />
    <?php }?>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>证件照片&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="file" name="f_pic" />
    允许的格式：jpg、png、gif</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>国籍&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="f_country" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>跳转地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="f_url" value="" />  不需要跳转请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>职务&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="f_zhiwu" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>研究领域&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="f_area" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>联系电话&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="f_tel" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>个人主页&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="f_homepage" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>邮箱地址&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="f_email" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>详细介绍&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <textarea name="f_content" id="act_content" style="height:300px;"></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO关键字&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="f_keywords" value="" />不设置请留空，,分割</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>SEO描述&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="text" name="f_descript" value="" />不做设置请留空</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>排序&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="f_order" value="10" />
    数字越小越往前显示</label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>是否显示&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="f_publish" checked="checked" value="1">
    显示 (默认显示，去掉勾选则不显示在网页中) </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>手机版本&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="f_m" value="1">手机 (默认为网页模式，勾选则为手机版本，内容只在手机网页显示) </label></td>
  </tr>
  <?php if($id){?>
	<input name="cnid" type="hidden" value="<?=$id?>" />
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
