<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UM-SJTU JI</title>
<link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
<link href="/ji_style/home.css" type="text/css" rel="stylesheet" />
</head>
	<meta charset="utf-8">
	<title>Edit TA Recruitment Time</title>
</head>
<body>
	<br>
	<table border="1">
		<tr>
			<td>course id</td>
			<td>course name</td>
			<td>professor</td>
		</tr>
		<?php foreach($list as $item): ?>
		<tr>
			<td><?=$item->course_id?></td>
			<td><?=$item->coursename?></td>
			<td><?=$item->professor?></td>
			<td><input type="button" name="apply" value="apply" onclick="location='ApplyTA/applydetail<?php echo "courseid=$item->course_id"?>'"/></td>
		</tr>
		<?php endforeach;?>
	</table>
</body>
</html>