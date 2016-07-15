
	<div id="mmain" class="mmain">
		<h2>教授讲师</h2><a class="maina" href="/manage/faculty_add"><span>添加中文讲师</span></a><a class="maina" href="/manage/faculty_en"><span>English</span></a>
<div class="faculty">
<?php foreach ($faculty as $f): ?>
<table width="1000" border="0" cellpadding="5" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td rowspan="3" align="center" valign="middle" bgcolor="#FFFFFF"><a href="/faculty/view/<?=$f->id?>" target="_blank"><img src="/ji_upload/faculty/<?=$f->f_pic?>" width="95" height="110"></a></td>
    <td width="100" height="30" align="center" valign="middle" bgcolor="#CFE2FE">姓名</td>
    <td width="330" height="30" valign="middle" bgcolor="#FFFFFF"><span><?=$f->f_name?>(<?php if($f->f_style==1){echo "教授"; }else{echo "校友";}?>)</span></td>
    <td width="100" height="30" align="center" valign="middle" bgcolor="#CFE2FE">操作</td>
    <td width="330" height="30" align="center" valign="middle" bgcolor="#F2F2F2"><a href="/manage/faculty_edit/<?=$f->id?>"><span>修改</span></a>　　<a href="/manage/faculty_del/<?=$f->id?>" onclick="return confirm('是否确认删除？删除后不会显示在后台列表中，但是仍旧存在于数据库中，可找回！')"><span>删除</span></a><a href="/manage/tuisong/<?php if($f->f_style==1){echo "faculty";}else{echo "alumni";}?>/<?=$f->id?>"><span>Ｔ</span></a><a href="/manage/faculty_add/<?=$f->id?>"><span>Add En</span></a></td>
  </tr>
  <tr>
    <td width="100" height="30" align="center" valign="middle" bgcolor="#CFE2FE">国籍</td>
    <td width="330" height="30" valign="middle" bgcolor="#FFFFFF"><span><?=$f->f_country?></span></td>
    <td width="100" height="30" align="center" valign="middle" bgcolor="#CFE2FE">联系电话</td>
    <td width="330" height="30" valign="middle" bgcolor="#FFFFFF"><span><?=$f->f_tel?></span></td>
  </tr>
  <tr>
    <td width="100" height="40" align="center" valign="middle" bgcolor="#CFE2FE">职务</td>
    <td width="330" height="40" valign="middle" bgcolor="#FFFFFF"><span><?=$f->f_zhiwu?></span></td>
    <td width="100" height="40" align="center" valign="middle" bgcolor="#CFE2FE">研究领域</td>
    <td width="330" height="40" valign="middle" bgcolor="#FFFFFF"><span><?=$f->f_area?></span></td>
  </tr>
</table>

<?php endforeach?>
</div>
<div class="pages" style="clear:both; margin-top:5px;">
<?php 
echo $pager;
?>
</div>
</div>
</div>

</body>
</html>
