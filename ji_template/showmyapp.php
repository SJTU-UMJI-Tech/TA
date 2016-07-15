<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My application</title>
<link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
<link href="/ji_style/home.css" type="text/css" rel="stylesheet" />
</head>
	<meta charset="utf-8">
	<title>My application</title>
</head>
<body>
	My application!
	<br>
		<?php foreach($list as $item): ?>
		<table border="1">
		<tr>
			<td>Name</td>
			<td><?=$item->name?></td>
		</tr>
		<tr>
			<td>Student ID</td>
			<td><?=$item->student_id?></td>
		</tr>
		<tr>
			<td>Faculty</td>
			<td><?=$item->faculty?></td>
		</tr>
		<tr>
			<td>Applied Course</td>
			<td><?=$item->app_course?></td>
		</tr>
		<tr>
			<td>Self-Introduction</td>
			<td><?=$item->self_introduction?></td>
		</tr>
		<tr>
			<td>Comment</td>
			<td><?=$item->comment?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?=$item->email?></td>
		</tr>
		<tr>
			<td>Application Status</td>
			<td><?php 
				if($item->status==0) echo "Undecided";
				else if ($item->status==1) echo "Pass";
				else echo "Rejected";
			?></td>
		</tr>
		<tr>
		<!--这里使用id是因为还不能读取session-->
		<td><input type="button" name="delete" value="delete" onclick="location='/ApplyTA/deleteapp?app_course=<?=$item->app_course?>&&id=<?=$item->student_id?>'"/></td>
		</tr>
		</table>
		<br />
		<?php endforeach;?>
</body>
</html>