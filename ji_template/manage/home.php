
	<div id="mmain" class="mmain">
		<h2>基本信息</h2>
<form action="config_save_cn" method="post">
  <table width="800" border="0" class="config" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td height="30" colspan="2" bgcolor="#F0F0F0" style="font-weight:bold; color:#09C">我们现在已经完善的功能模块</td>
  </tr>
  <?php foreach($finishmodules as $f){?>
  <tr>
    <td width="80" height="30" align="center" bgcolor="#F0F0F0"><?=$f->module_name;?></td>
    <td height="30" bgcolor="#F0F0F0">
	<?=$f->module_description;?>
    </td>
  </tr>
  <?php }?>
  <tr>
    <td height="30" colspan="2" bgcolor="#F0F0F0" style="font-weight:bold; color:#09C">我们正在开发的功能模块</td>
  </tr>
  <?php foreach($onmodules as $o){?>
  <tr>
    <td width="80" height="30" align="center" bgcolor="#F0F0F0"><?=$o->module_name;?></td>
    <td height="30" bgcolor="#F0F0F0">
	<?=$o->module_description;?>
    </td>
  </tr>
  <?php }?>
  <tr>
    <td height="30" colspan="2" bgcolor="#F0F0F0" style="line-height:30px;"><b>特殊声明：</b><br />该系统源码版权归该系统开发者私有，任何人不得在未得到私有者授权情况下将该系统用于商业用途或私自公开源代码。<br />&copy;小皇博客，2013-2015<br />获取授权：QQ:525562633，TEL:13916658320</td>
  </tr>
</table>
</form>

	</div>
</div>

</body>
</html>
