<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>UM-SJTU JI</title>
	<link href="/ji_style/stu_app_common.css" type="text/css" rel="stylesheet" />
	<link href="/ji_style/stu_app_apply.css" type="text/css" rel="stylesheet" />
	<script src="/ji_js/jquery-app.js"></script>
	<script src="/ji_js/stu_app_apply.js"></script>
	<script src="/ji_js/stu_app_common.js"></script>
</head>
	<meta charset="utf-8">
	<title>Apply for Ta</title>
</head>
<body>
<?php
require 'stu_app_head.php';
?>
<div class="apply" align="center">
	<table width="100%">
		<tr class="first">
			<td width="13%">Course ID</td>
			<td width="33%">Course Name</td>
			<td width="26%">Professor Name</td>
			<td width="18%">Application Status</td>
			<td width="10%"></td>
		</tr>
		<?php foreach($list as $item): ?>
			<tr>
				<td><?=ucfirst($item->course_id)?></td>
				<td><?=ucwords($item->coursename)?></td>
				<td><?=ucwords($item->professor)?></td>
				<?php
				if ( $item->status == '1' ) {
					?>
					<td>Open</td>
					<?php
				}else{
					?>
					<td>Close</td>
					<?php
				}
				if ( $item->status == '1' ) {
					?>
					<td><input class="hidden submit" type="button" name="apply" value="Apply" onclick="location='/ApplyTA/applydetail<?php echo "?courseid=$item->course_id"?>'"/></td>
					<?php
				}else{
					?>
					<td></td>
					<?php
				}
				?>
			</tr>
		<?php endforeach;?>
	</table>
</div>
</body>
</html>