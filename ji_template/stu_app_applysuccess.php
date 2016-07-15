<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Apply Successfully!</title>
	<link href="/ji_style/stu_app_common.css" type="text/css" rel="stylesheet" />
	<style type="text/css">
		#return {
			border-radius: 10px;
			font-size: 25px;
			width: 130px;
			margin: 50px 0 40px 0;
		}

		h1 {
			margin-top: 40px;
			padding-bottom: 15px;
			border-bottom: solid;
			border-color: rgb(145,145,145);
			width: 400px;
		}

	</style>
	<script src="/ji_js/jquery-app.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#strip-2').addClass('current');
			$('#button-2').addClass('current');
		});
	</script>
	<script src="/ji_js/stu_app_common.js"></script>
</head>
	<meta charset="utf-8">
	<title>Edit TA Recruitment Time</title>
</head>
<body>
<?php
require 'stu_app_head.php';
?>
<div class="apply" align="center">
	<br>
	<h1 align="center">Apply Successfully!</h1>
	<br />
	<input id="return" class="submit" type="button" name="return" value="Return" onclick="location='/ta/application/Student/apply'"/>
</div>
</body>
</html>
