<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
		"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>UM-SJTU JI</title>
	<link href="/ji_style/common.css" type="text/css" rel="stylesheet"/>
	<link href="/ji_style/home.css" type="text/css" rel="stylesheet"/>
</head>
<meta charset="utf-8">
<title>Edit TA Recruitment Time</title>
</head>
<body>
<br>
<table border="1">
	<tr>
		<td>TA申请结束时间</td>
		<td>TA申请开始时间</td>
	</tr>
	<tr>
		<?php foreach ($list as $item): ?>
			<td><?= $item->data ?></td>
		<?php endforeach; ?>
	</tr>
	<tr>
		<td>
			<input type="button" name="modify" value="修改"
			       onclick="location='/Edit/modifytime<?php echo "?obj=ta_recruitment_start" ?>'"/>
		</td>
		<td>
			<input type="button" name="modify" value="修改"
			       onclick="location='/Edit/modifytime<?php echo "?obj=ta_recruitment_end" ?>'"/>
		</td>
	</tr>
</table>
</body>
</html>
