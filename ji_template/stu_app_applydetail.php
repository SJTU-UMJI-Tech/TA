<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Apply for TA</title>
	<link href="/ji_style/stu_app_common.css" type="text/css" rel="stylesheet" />
	<link href="/ji_style/stu_app_applydetail.css" type="text/css" rel="stylesheet" />
    <script src="/ji_js/jquery-app.js"></script>
	<script src="/ji_js/stu_app_applydetail.js"></script>
    <script src="/ji_js/stu_app_common.js"></script>
</head>
<body>
<?php
require 'stu_app_head.php';
?>
<div class="apply">
    <form action="/ta/application/Student/saveinfo<?php echo "?courseid=$courseid";?>" method="post" enctype="multipart/form-data">
		<?php foreach($list as $item): ?>
			<fieldset class="text-container">
				<legend>Personal Information</legend>
				<ul id="personal-information">
					<li>Name: <input class="readonly" name="name" value="<?=$item->name?>" style="font-size:18px;" size="12" readonly></li>
					<li>Course ID: <input class="readonly" name="courseid" value="<?php echo ucfirst($courseid);?>" style="font-size:18px;" size="5" readonly></li>
					<li>Student ID: <input class="readonly" name="studentid" value="<?=$item->student_id?>" style="font-size:18px;" size="12" readonly></li>
					<li>Faculty: <input class="readonly" name="faculty" value="<?=$item->faculty?>" style="font-size:18px;" size="15" readonly></li>
					<li id="gender">
						Gender:
						<input type="radio" name="sex" value="male" checked="checked">Male
						<input type="radio" name="sex" value="female">Female
					</li>
					<li>
						Grade:
						<select name="Grade" style="font-size:18px;">
							<option value="freshman" selected>Freshman</option>
							<option value="sophomore">Sophomore</option>
							<option value="junior">Junior</option>
							<option value="senior">Senior</option>
							<option value="graduate">Graduate</option>
						</select>
					</li>
					<li class="last">Email: <input id="email" name="email" style="font-size:18px;" size="20" value="<?php echo set_value('email'); ?>"></li>
				</ul>
			</fieldset>

			<fieldset class="text-container-2">
				<legend>Self-Introduction</legend>
				<textarea id="introduction" class="text" name="introduction" rows="15"><?php echo set_value('introduction'); ?></textarea>
			</fieldset>

			<fieldset class="text-container-2">
				<legend>Comment</legend>
				<textarea id="comment" class="text" name="comment" rows="8"><?php echo set_value('comment'); ?></textarea>
			</fieldset>
		<?php endforeach;?>
		<input type="file" name="upfile" size="20" />
        <input id="submit" type="button" align="center" value="Submit" class="submit reprocess">
		<div id="bg"></div>
		<div class="box" id="reprocess-box">
			<p>Are you sure to submit this application?</p>
			<table width="80%" align="center">
				<td width="40%"><input name="submit" type="submit" align="center" value="Yes" class="submit"></td>
				<td width="40%"><input type="button" align="center" value="No" class="submit no"></td>
			</table>
		</div>
    </form>
</div>
</body>
</html>