<div id="mmain" class="mmain">
<h2>GPA</h2><a class="maina" href="/manage/gpa"><span>查询GPA</span></a><a class="maina" href="/manage/gpa_createall"><span>批量GPA生成</span></a><a class="maina" href="/manage/gpa_createone"><span>单个GPA生成</span></a>
<div class="gpa">
<form action="" method="post">
<input name="student_id" placeholder="学号" type="text" />
<select name="result_xn">
  <option value="0">学年</option>
  <option value="2010-2011">2010-2011</option>
  <option value="2011-2012">2011-2012</option>
  <option value="2012-2013">2012-2013</option>
  <option value="2013-2014">2013-2014</option>
  <option value="2014-2015">2014-2015</option>
</select>
<select name="result_xq">
  <option value="0">学期</option>
  <option value="1">1</option>
  <option value="2">2</option>
</select>
<input name="submit" value="提交" type="submit" />
</form>
<div class="info">
<?php 
echo '<li>学号：'.$studentid.'</li>';
echo '<li>学年：'.$xn.'</li>';
echo '<li>学期：'.$xq.'</li>';
echo '<li>分子：'.$count.'</li>';
echo '<li>分母：'.$total.'</li>';
echo '<li style="color:#ff0000">GPA：'.$gpa.'</li>';
echo '<li>SQL1：'.$sql1.'</li>';
echo '<li>SQL2：'.$sql2.'</li>';
?>
</div>
<table width="800" border="1" cellpadding="0" cellspacing="0">
<tr>
    <td width="200">课程代码</td>
    <td width="200">NJD</td>
    <td width="200">学分</td>
    <td width="200">学年</td>
    <td width="200">学期</td>
  </tr>
<?php foreach($results1 as $r1){?>
  <tr>
    <td width="200"><?=$r1->result_kcdm?></td>
    <td width="200"><?=$r1->result_njd?></td>
    <td width="200"><?=$r1->result_xf?></td>
    <td width="200"><?=$r1->result_xn?></td>
    <td width="200"><?=$r1->result_xq?></td>
  </tr>	
<?php }?>
</table>

<table width="800" border="1" cellpadding="0" cellspacing="0">
<tr>
    <td width="200">课程代码</td>
    <td width="200">NJD</td>
    <td width="200">学分</td>
    <td width="200">学年</td>
    <td width="200">学期</td>
  </tr>
<?php foreach($results2 as $r2){?>
  <tr>
    <td width="200"><?=$r2->result_kcdm?></td>
    <td width="200"><?=$r2->result_njd?></td>
    <td width="200"><?=$r2->result_xf?></td>
    <td width="200"><?=$r2->result_xn?></td>
    <td width="200"><?=$r2->result_xq?></td>
  </tr>	
<?php }?>
</table>
</div>
</div>

</div>

</body>
</html>
