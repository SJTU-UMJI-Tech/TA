<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Edit TA Recruitment Time</title>
</head>
<body>
	<br>
	<table>
		<tr>
			<td>Object</td>
			<td>Data</td>
		</tr>
		<?php foreach($list as $item): ?>
		<tr>
			<td><?=$item->obj?></td>
			<td><?=$item->data?></td>
		</tr>
		<?php endforeach;?>
	</table>
</body>
</html>
