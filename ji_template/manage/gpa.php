<div id="mmain" class="mmain">
<h2>GPA</h2><a class="maina" href="/manage/gpa"><span>查询GPA</span></a><a class="maina" href="/manage/gpa_createall"><span>批量GPA生成</span></a><a class="maina" href="/manage/gpa_createone"><span>单个GPA生成</span></a>
<div class="gpa">
	<div class="order-nav">
    <form action="" method="post">
        <select name="student_grade">
          <option<?php if($student_grade=='f10'){echo " selected='selected'";}?> value="f10">F10级</option>
          <option<?php if($student_grade=='f11'){echo " selected='selected'";}?> value="f11">F11级</option>
          <option<?php if($student_grade=='f12'){echo " selected='selected'";}?> value="f12">F12级</option>
          <option<?php if($student_grade=='f13'){echo " selected='selected'";}?> value="f13">F13级</option>
          <option<?php if($student_grade=='f14'){echo " selected='selected'";}?> value="f14">F14级</option>
          <option<?php if($student_grade=='f15'){echo " selected='selected'";}?> value="f15">F15级</option>
        </select>
      <select name="student_major">
       	<option<?php if($student_major=='电子与计算机工程'){echo " selected='selected'";}?> value="电子与计算机工程">电子与计算机工程专业</option>
        <option<?php if($student_major=='机械类'){echo " selected='selected'";}?> value="机械类">机械类专业</option>
        <option<?php if($student_major=='联合学院'){echo " selected='selected'";}?> value="联合学院">联合学院</option>
        </select>
        <select name="gpa_xq">
        	<option value="0"<?php if($gpa_xq==0){echo " selected='selected'";}?>>全学年</option>
        	<option value="1"<?php if($gpa_xq==1){echo " selected='selected'";}?>>第一学期</option>
            <option value="2"<?php if($gpa_xq==2){echo " selected='selected'";}?>>第二学期</option>
        </select>
        <select name="gpa_xn">
          <option value="0"<?php if($gpa_xn=='0'){echo " selected='selected'";}?>>学年</option>
          <option value="2010-2011"<?php if($gpa_xn=='2010-2011'){echo " selected='selected'";}?>>2010-2011</option>
          <option value="2011-2012"<?php if($gpa_xn=='2011-2012'){echo " selected='selected'";}?>>2011-2012</option>
          <option value="2012-2013"<?php if($gpa_xn=='2012-2013'){echo " selected='selected'";}?>>2012-2013</option>
          <option value="2013-2014"<?php if($gpa_xn=='2013-2014'){echo " selected='selected'";}?>>2013-2014</option>
          <option value="2014-2015"<?php if($gpa_xn=='2014-2015'){echo " selected='selected'";}?>>2014-2015</option>
        </select>
<select name="student_xueji">
        	<option value="0">学籍状态</option>
        	<option value="毕业离校">毕业离校</option>
            <option value="退学离校">退学离校</option>
            <option value="外校交换生">外校交换生</option>
            <option value="结业转毕业">结业转毕业</option>
            <option value="延期转毕业">延期转毕业</option>
            <option value="保留入学资格">保留入学资格</option>
            <option value="延期在校">延期在校</option>
            <option value="长期游学">长期游学</option>
            <option value="复学在校">复学在校</option>
            <option value="未报到">未报到</option>
        </select>
        <label><input name="student_fuxue" type="checkbox" checked="checked" value="1" /><span>复学在校</span></label>
        <label><input name="student_zhengchang" type="checkbox" checked="checked" value="1" /><span>正常在校</span></label>
        <input name="submit" type="submit" value="查询" />
      </form>
    </div>
<div class="gpa_list">

<table width="900" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100" height="25">班级</td>
    <td width="100" height="25">学号</td>
    <td width="100" height="25">姓名</td>
    <td width="100" height="25">GPA</td>
    <td width="100" height="25">学年</td>
    <td width="100" height="25">学期</td>
    <td width="100" height="25">学籍</td>
    <td width="200" height="25">生成时间</td>
  </tr>
	<?php if($students){
	foreach($students as $s){
		$gpa = $this->db->query("select * from gpa_gpa where student_id=".$s->student_id." and gpa_xn='".$gpa_xn."' and gpa_xq='".$gpa_xq."' limit 1")->row_array();
		//echo "select * from gpa_gpa where student_id=".$s->student_id." and gpa_xn='".$gpa_xn."' and gpa_xq='".$gpa_xq."' limit 1".'<br />';
	?>
  <tr>
    <td width="100" height="25"><?=$s->student_class?></td>
    <td width="100" height="25"><?=$s->student_id?></td>
    <td width="100" height="25"><?=$s->student_name?></td>
    <td width="100" height="25"><?=$gpa['gpa']?></td>
    <td width="100" height="25"><?=$gpa['gpa_xn']?></td>
    <td width="100" height="25"><?=$gpa['gpa_xq']?></td>
    <td width="100" height="25"><?=$s->student_xueji?></td>
    <td width="200" height="25"><?=$gpa['gpa_createtime']?></td>
  </tr>
	<? }}?>
</table>

</div>
</div>
</div>

</div>

</body>
</html>
