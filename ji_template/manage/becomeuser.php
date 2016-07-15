
	<div id="mmain" class="mmain">
		<h2>变身成为用户</h2>
<form action="" method="post">
  <table width="800" border="0" class="config" cellpadding="8" cellspacing="1" bgcolor="#D4D4D4">
  <tr>
    <td width="120" height="30" align="right" valign="middle" bgcolor="#CFE2FE"><strong>用户信息&nbsp;</strong></td>
    <td width="680" height="30" bgcolor="#F0F0F0"><label>
      <select name="user_id">
      <?php foreach($users as $u){?>
        <option value="<?=$u->user_id?>"><?=$u->user_name?>(<?=$u->user_id?>)</option>
      <?php }?>
      </select>
    </label></td>
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

</body>
</html>
