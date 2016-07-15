
	<div id="mmain" class="mmain">
		<h2>视频管理</h2><a class="maina" href="/manage/video_add"><span>添加</span></a>

  <table width="800" border="0" cellpadding="0" class="video" cellspacing="1" bgcolor="#D4D4D4">
  <?php foreach ($video as $v): ?>
  <tr>
    <td width="200" height="130" rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><img src="/ji_upload/video/<?=$v->v_pic?>" height="90" /></td>
    <td height="30" valign="middle" bgcolor="#CFE2FE"><h2><?=$v->v_title?></h2><a href="video_edit/<?=$v->id?>" target="_self"><span>修改</span></a><a href="video_del/<?=$v->id?>" target="_self" onclick="return confirm('是否确认删除？')"><span>删除</span></a><!--<a style="margin-right:30px" href="video_add/<?=$v->id?>" target="_self"><span>En</span></a>--></td>
  </tr>
  <tr>
    <td height="100" bgcolor="#FFFFFF"><p><?=$v->v_summary?></p></td>
  </tr>
  <?php endforeach?>
</table>

	</div>
</div>

</body>
</html>
