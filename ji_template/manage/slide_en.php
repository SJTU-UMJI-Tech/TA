
	<div id="mmain" class="mmain">
		<h2>英文幻灯片管理</h2><a class="maina" href="/manage/slide_add"><span>添加</span></a><a class="maina" href="slide"><span>中文</span></a>

  <table width="800" border="0" cellpadding="0" class="slide" cellspacing="1" bgcolor="#D4D4D4">
  <?php foreach ($slide as $s): ?>
  <?php if($_SESSION['user'] == master || $s->slide_user == $_SESSION['user']){?>
  <tr>
    <td width="200" height="130" rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><img src="/ji_upload/slide/<?=$s->slide_pic?>" height="90" /></td>
    <td height="30" valign="middle" bgcolor="#CFE2FE"><h2>[<?=$s->slide_user?>]<?=$s->slide_title?></h2><?php if($s->slide_m == 1){?><img src="/image/mobile.gif"><?php }?><a href="slide_edit/<?=$s->id?>" target="_self"><span>修改</span></a><a href="slide_del/<?=$s->id?>" target="_self" onclick="return confirm('是否确认删除？')"><span>删除</span></a></td>
  </tr>
  <tr>
    <td height="100" bgcolor="#FFFFFF"><p><?=$s->slide_content?></p></td>
  </tr>
  <?php } endforeach?>
</table>

	</div>
</div>

</body>
</html>
