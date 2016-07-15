
	<div id="mmain" class="mmain">
		<h2>修改课程：<?=$course['course_name']?></h2>
		<form action="/manage/equivalence/course/edit_save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="course_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4" align="left">
  <tr>
    <td height="30" colspan="2" align="center" valign="middle" bgcolor="#F0F0F0"><strong>合作大学</strong></td>
    <td height="30" colspan="2" align="center" valign="middle" bgcolor="#CFE2FE"><strong>密西根学院</strong></td>
    </tr>
    <input class="inputs" type="hidden" name="course_id" value="<?=$course['course_id']?>" />
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">代码</td>
    <td width="330" height="30" bgcolor="#F0F0F0"><label>
    <input class="inputs" type="text" name="code" value="<?=$course['course_code']?>" /></label></td>
    
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">JI Subject</td>
    <td width="330" height="30" bgcolor="#CFE2FE">
      <label for="category">
    <input class="inputs" type="text" name="ji_category" value="<?=$course['ji_category']?>" /></label>
      </td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">学校</td>
    <td width="330" height="30" bgcolor="#F0F0F0">
      <label for="university"></label>
      <select name="university" id="university">
        <?php foreach($universities as $u){?>
        <option value="<?=$u->university_id?>" <?php if($course['university_id']==$u->university_id){echo "selected='selected'";}?>><?=$u->university_name?></option>
        <?php }?>
      </select></td>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">Catalog</td>
    <td width="330" height="30" bgcolor="#CFE2FE"><label>
    <input class="inputs" type="text" name="ji_code" value="<?=$course['ji_code']?>" /></label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">学分</td>
    <td width="330" height="30" bgcolor="#F0F0F0">
      <label for="credits">
    <input class="inputs" type="text" name="credits" value="<?=$course['course_credits']?>" /></label>
      </td>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">Credits</td>
    <td width="330" height="30" bgcolor="#CFE2FE">
      <label for="ji_credits">
    <input class="inputs" type="text" name="ji_credits" value="<?=$course['ji_credits']?>" /></label>
      </td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">语言</td>
    <td width="330" height="30" bgcolor="#F0F0F0"><label for="language"></label>
      <select name="language" id="language">
      <option value="English" <?php if($course['course_language']=='English'){echo "selected='selected'";}?>>English</option>
        <option value="Dual" <?php if($course['course_language']=='Dual'){echo "selected='selected'";}?>>Dual</option>
        <option value="Chinese" <?php if($course['course_language']=='Chinese'){echo "selected='selected'";}?>>Chinese</option>
        <option value="French" <?php if($course['course_language']=='French'){echo "selected='selected'";}?>>French</option>
        
        <option value="German" <?php if($course['course_language']=='German'){echo "selected='selected'";}?>>German</option>
        <option value="Japanese" <?php if($course['course_language']=='Japanese'){echo "selected='selected'";}?>>Japanese</option>
        <option value="Portuguese" <?php if($course['course_language']=='Portuguese'){echo "selected='selected'";}?>>Portuguese</option>
        <option value="Russian" <?php if($course['course_language']=='Russian'){echo "selected='selected'";}?>>Russian</option>
        <option value="Spanish" <?php if($course['course_language']=='Spanish'){echo "selected='selected'";}?>>Spanish</option>
        
      </select></td>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">Remarks</td>
    <td width="330" height="30" bgcolor="#CFE2FE"><label>
    <input class="inputs" type="text" name="ji_remarks" value="<?=$course['ji_remarks']?>" /></label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">部门</td>
    <td width="330" height="30" bgcolor="#F0F0F0">
      <label>
    <input class="inputs" type="text" name="department" value="<?=$course['course_department']?>" /></label></td>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">&nbsp;</td>
    <td width="330" height="30" bgcolor="#CFE2FE"></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">名称</td>
    <td width="330" height="30" bgcolor="#F0F0F0">
      <label>
    <input class="inputs" type="text" name="name" value="<?=$course['course_name']?>" /></label></td>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">&nbsp;</td>
    <td width="330" height="30" bgcolor="#CFE2FE"></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">备注</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="remarks" value="<?=$course['course_remarks']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">生效</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" value="<?=$course['course_starttime']?>" name="starttime" />
    *开始日期
    2015-07-22</label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">失效</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" value="<?=$course['course_endtime']?>" name="endtime" />
    *截止日期
    2015-07-22</label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">置顶</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="top"<?php if($course['course_top']=='1'){echo " checked='checked' ";}?> value="1">
    勾选置顶</label></td>
  </tr>
  <tr>
    <td width="70" height="30" bgcolor="#F0F0F0">&nbsp;</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
      <input type="submit" name="Submit" class="submit" value="保存" />
    </label></td>
  </tr>
</table>
</form>
	</div>
</div>
<div class="fixed"><div class="error"><span></span></div></div>
<script type="text/javascript">
$(function () {
	$(".submit").click(function(){
		/*if($("input[name=name]")[0].value==''){
			err = '课程名称不能为空'; callerror(err); return false;
		}*/
		$('form').submit();
	});
});

</script>
<script type="text/javascript">
function callerror(err){
	$(".error span").text(err);
	$(".error").slideDown();
	setTimeout(function(){
		$(".error").slideUp();
	},2000);
}
</script>
</body>
</html>
