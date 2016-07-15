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
			<td>修改学年</td>
			<td>修改学期</td>
		</tr>
		<form action="/ta/application/Edit/savexqxn" method="post">
		<tr>
			<td><input type="text" name="xxn" value="<?=$list[1]->data?>"/></td>
			<td><input type="text" name="xxq" value="<?=$list[0]->data?>"/></td>
		</tr>
		<tr>
		<td>
		<input type="submit" name="submit" value="提交" />
		</td>
		<td>
		<input type="button" name="modify" value="返回" onclick="location='/ta/application/Edit/home'"/>
		</td>
		</tr>
		</form>
	</table>
</body>
</html>