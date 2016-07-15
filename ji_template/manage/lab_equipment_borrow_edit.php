<link href="/ji_js/date/styles/glDatePicker.flatwhite.css" rel="stylesheet" type="text/css">
	<div id="mmain" class="mmain">
		<h2>修改借用信息</h2>
		<form class="equipment" action="/manage/lab_equipment_borrow_save" method="post" enctype="multipart/form-data">
       <input name="borrow_id" type="hidden" value="<?=$equipment['borrow_id']?>" />
  <table width="800" border="0" class="page_add" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>设备名称&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="equipment_name" readonly="readonly" type="text" id="equipment_name" value="<?=$equipment['equipment_name']?>" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>设备ID&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="equipment_id" type="text" id="equipment_id" value="<?=$equipment['equipment_id']?>" readonly="readonly" /></label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>学生学号&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="student_id" value="<?=$equipment['student_id']?>" type="text" id="student_id" /> </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>学生姓名&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="student_name" value="<?=$equipment['student_name']?>" type="text" id="student_name" /> </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>学生手机&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="student_mobile" value="<?=$equipment['student_mobile']?>" type="text" id="student_mobile" /> </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>预计归还时间&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="borrow_end" style="width:300px;" value="<?=$equipment['borrow_end']?>" type="text" id="borrow_end" /> </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>经手人&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="borrow_fromwho" type="text" id="borrow_fromwho" value="<?=$equipment['borrow_fromwho']?>" readonly="readonly" /> </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>用途&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
    <input name="student_application" value="<?=$equipment['student_application']?>" type="text" id="student_application" /> </label></td>
  </tr>
  
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
<script src="/ji_js/date/glDatePicker.js"></script>
    <script type="text/javascript">
        $(window).load(function()
        {
            $('#borrow_end').glDatePicker({
				showAlways: false,
				onClick: function(target, cell, date, data) {
					target.val(date.getFullYear() + '-' + (parseInt(date.getMonth())+1) + '-' + date.getDate());}
			});
			
        });
    </script>
</body>
</html>
