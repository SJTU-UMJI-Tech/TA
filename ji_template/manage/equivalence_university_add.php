
	<div id="mmain" class="mmain">
		<h2>添加大学</h2>
		<form action="/manage/equivalence/university/save" method="post" enctype="multipart/form-data">
  <table width="800" border="0" class="course_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4" align="left">
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">名称</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="name" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">国家</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="country" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">城市</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="city" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">首字母</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label>
    <input type="text" name="letter" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="70" height="30" align="right" valign="middle" bgcolor="#F0F0F0">特殊说明</td>
    <td height="30" colspan="3" bgcolor="#F0F0F0"><label for="remarks">
    <textarea name="remarks" cols="80" rows="12" id="remarks"></textarea>
    </label></td>
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
		if($("input[name=name]")[0].value==''){
			err = '大学名称不能为空'; callerror(err); return false;
		}
		if($("input[name=country]")[0].value==''){
			err = '大学所在国家不能为空'; callerror(err); return false;
		}
		if($("input[name=city]")[0].value==''){
			err = '大学所在城市不能为空'; callerror(err); return false;
		}
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
<script charset="utf-8" src="/editor/kindeditor.js"></script>
<script charset="utf-8" src="/editor/lang/zh_CN.js"></script>
<script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#remarks');
        });
</script>
</body>
</html>
