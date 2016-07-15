
	<div id="mmain" class="mmain">
		<h2>编辑大学：<?=$university['university_name']?></h2>
		<form action="/manage/equivalence/university/edit_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="course_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4" align="left">
  <input type="hidden" name="id" value="<?=$university['university_id']?>" />
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">名称</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="name" value="<?=$university['university_name']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">国家</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="country" value="<?=$university['university_country']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">城市</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="city" value="<?=$university['university_city']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">首字母</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="letter" value="<?=$university['university_letter']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">特殊说明</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label for="remarks">
    <textarea name="remarks" cols="80" rows="12" id="remarks"><?=$university['university_remarks']?></textarea>
    </label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">置顶</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="top"<?php if($university['university_top']==1){?> checked="checked"<?php }?> value="1">
    勾选置顶</label></td>
  </tr>
  <tr>
    <td width="70" height="30" bgcolor="#F0F0F0">&nbsp;</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
      <input type="submit" name="Submit" value="保存" />
    </label></td>
  </tr>
</table>
</form>
	</div>
</div>
<script charset="utf-8" src="/editor/kindeditor.js"></script>
<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#remarks');
        });
</script>
</body>
</html>
