
	<div id="mmain" class="mmain"> 
		<h2>添加通讯录</h2>
		<form action="contactlist_save" method="post">
<table class="contactlist_add" width="800" border="0" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>部门</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><select name="user_department">
      <option value="DO">Dean's Office 院长办公室</option>
      <option value="IAO">Institutional Advancement Office 发展与合作办公室
Mgr:Kathy Xu</option>
      <option value="AAD">Academic Affairs Division 教学事务部 Mgr:Scott Yang</option>
      <option value="RMD">Resource Management Division 综合行政部 Mgr: Sherry Yao</option>
      <option value="DO">Domestic Recruitment Office 本科生招生办公室 Mgr: Yang Wang</option>
      <option value="CPRO">Communication and Public Relations Office 对外交流与宣传办 公室Mgr: Yi Yuan</option>
      <option value="LAB">Teaching Lab Service Office 教学实验室办公室 Mgr: Roger Han</option>
      <option value="OTHER">Other 其他</option>
    </select></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>办公室</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" style="color:#666;" name="user_office" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>房间号</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" style="color:#666;" name="user_room" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>中文名</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input name="user_name" style="color:#666;" type="text" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>英文名</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="user_enname" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>工号</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="user_id" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>职称</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
     <input type="text" name="user_position" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>英文职称</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
     <input type="text" name="user_enposition" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>直线</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="user_tel" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>内线</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="user_subtel" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>手机</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="user_mobile" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>小号</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="user_short" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>邮箱</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="user_email" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>Skype</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="user_skype" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>QQ</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="user_qq" value="" />
    </label></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>类型</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><select name="user_type">
      <option value="staff">Staff</option>
      <option value="faculty">Faculty</option>
      <option value="lecture">Lecture</option>
      <option value="visitor">Visitor</option>
      <option value="student">Student</option>
      <option value="other">Other</option>
    </select></td>
  </tr>
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>国籍</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="text" name="user_country" value="" />
    </label></td>
  </tr>
  
  <tr>
    <td width="120" height="30" bgcolor="#F0F0F0">&nbsp;</td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <input type="submit" name="Submit" value="保存" />
    </label></td>
  </tr>
</table>

	</div>
</div>

</body>
</html>
