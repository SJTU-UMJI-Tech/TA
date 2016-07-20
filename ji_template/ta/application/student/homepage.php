<?php include 'header.php'; ?>

<script type="text/javascript">
	$(document).ready(function ()
	{
		$('#strip-1').addClass('current');
		$('#button-1').addClass('current');
	});
</script>

<table border="1" class="apply">
	<tr>
		<td>TA申请开始时间</td>
		<td>TA申请结束时间</td>
	</tr>
	<tr>
		<td><?php echo $ta_recruitment_start;?></td>
		<td><?php echo $ta_recruitment_end;?></td>
	</tr>
</table>
</body>
</html>