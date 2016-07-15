<link href="/ji_js/date/styles/glDatePicker.flatwhite.css" rel="stylesheet" type="text/css">

	<div id="mmain" class="mmain">
		<h2>添加课程</h2>
		<form action="/manage/equivalence/course/save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="course_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4" align="left">
  <tr>
    <td height="30" colspan="2" align="center" valign="middle" bgcolor="#F0F0F0"><strong>合作大学</strong></td>
    <td height="30" colspan="2" align="center" valign="middle" bgcolor="#CFE2FE"><strong>密西根学院</strong></td>
    </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">科目</td>
    <td width="330" height="30" bgcolor="#F0F0F0"><label>
    <input class="inputs" type="text" name="code" value="" /></label></td>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">科目</td>
    <td width="330" height="30" bgcolor="#CFE2FE"><label>
    <input class="inputs" type="text" name="ji_code" value="" /></label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">学校</td>
    <td width="330" height="30" bgcolor="#F0F0F0">
      <label for="university"></label>
      <select name="university" id="university">
        <?php foreach($universities as $u){?>
        <option value="<?=$u->university_id?>"><?=$u->university_name?>&nbsp;<?=$u->university_id?></option>
        <?php }?>
      </select></td>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">类目</td>
    <td width="330" height="30" bgcolor="#CFE2FE">
      <label for="category">
      <input class="inputs" type="text" id="ji_category" name="ji_category" value="" /></label></td>
      </td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">学分</td>
    <td width="330" height="30" bgcolor="#F0F0F0">
      <label for="credits">
      <input class="inputs" type="text" id="credits" name="credits" value="" /></label>
      </td>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">学分</td>
    <td width="330" height="30" bgcolor="#CFE2FE">
      <label for="ji_credits">
      <input class="inputs" type="text" id="ji_credits" name="ji_credits" value="" /></label>
      </td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">语言</td>
    <td width="330" height="30" bgcolor="#F0F0F0"><label for="language"></label>
      <select name="language" id="language">
      <option value="English">English</option>
        <option value="Dual">Dual</option>
        <option value="Chinese">Chinese</option>
        <option value="French">French</option>
        <option value="German">German</option>
        <option value="Japanese">Japanese</option>
        <option value="Portuguese">Portuguese</option>
        <option value="Russian">Russian</option>
        <option value="Spanish">Spanish</option>
        
      </select></td>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">备注</td>
    <td width="330" height="30" bgcolor="#CFE2FE"><label>
    <input class="inputs" type="text" name="ji_remarks" value="" /></label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">部门</td>
    <td width="330" height="30" bgcolor="#F0F0F0">
      <label>
    <input class="inputs" type="text" name="department" value="" /></label></td>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">&nbsp;</td>
    <td width="330" height="30" bgcolor="#CFE2FE"></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">名称</td>
    <td width="330" height="30" bgcolor="#F0F0F0">
      <label>
    <input class="inputs" type="text" name="name" value="" /></label></td>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#CFE2FE">&nbsp;</td>
    <td width="330" height="30" bgcolor="#CFE2FE"></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">备注</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="remarks" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">生效</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" value="" name="starttime" id="starttime" />
    *开始日期
    2015-07-22</label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">失效</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" value="" name="endtime" id="endtime" />
    *截止日期
    2015-07-22</label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">置顶</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="checkbox" name="top" value="1">
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
		}
		if($("input[name=code]")[0].value==''){
			err = '课程代码不能为空'; callerror(err); return false;
		}
		if($("input[name=ji_code]")[0].value==''){
			err = 'JI 的课程代码不能为空'; callerror(err); return false;
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
<script src="/ji_js/date/glDatePicker.js"></script>
    <script type="text/javascript">
        $(window).load(function()
        {
            $('#endtime').glDatePicker({
				showAlways: false,
				onClick: function(target, cell, date, data) {
					target.val(date.getFullYear() + '-' + (parseInt(date.getMonth())+1) + '-' + date.getDate());}
			});
			$('#starttime').glDatePicker({
				showAlways: false,
				onClick: function(target, cell, date, data) {
					target.val(date.getFullYear() + '-' + (parseInt(date.getMonth())+1) + '-' + date.getDate());}
			});
        });
    </script>

</body>
</html>
