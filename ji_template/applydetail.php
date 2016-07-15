<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UM-SJTU JI</title>
<link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
<link href="/ji_style/home.css" type="text/css" rel="stylesheet" />
</head>
	<meta charset="utf-8">
	<title>Application Infomation</title>
</head>
<body>
	<form action="/ApplyTA/saveinfo<?php echo "?courseid=$courseid";?>" method="post">
		<?php foreach($list as $item): ?>
		Name<input type="text" name="name" value="<?=$item->name?>" readonly="true"/>
		<br />
		Course ID<input type="text" name="courseid" value="<?php echo $courseid;?>" readonly="true"/>
		<br />
		Student ID<input type="text" name="studentid" value="<?=$item->student_id?>" readonly="true"/>
		<br />
		Faculty><input type="text" name="faculty" value="<?=$item->faculty?>" readonly="true"/>
		<br />
		Grade
			<select name="Grade">
			<option value="freshman">Freshman</option>
			<option value="sophomore">Sophomore</option>
			<option value="junior">Junior</option>
			<option value="senior">Senior</option>
			<option value="graduate">Graduate</option>
			</select>
		<br />
		Gender		
			<input type="radio" name="sex" value="male" checked="checked"/> Male
			<input type="radio" name="sex" value="female" /> Female
		<br />
		Email<input type="text" name="email" value="<?php echo set_value('email'); ?>"/>
		<?php echo form_error('email','<span>','</span>')?>
		<br />
		Self-introduction<textarea name="introduction" rows="10" cols="30"><?php echo set_value('introduction'); ?></textarea>	 		<?php echo form_error('introduction','<span>','</span>')?>
		<br />
		Comment<textarea name="comment" rows="10" cols="30"><?php echo set_value('comment'); ?></textarea>
		<?php echo form_error('comment','<span>','</span>')?>
		<?php endforeach;?>
		<br />
		<input type="submit" name="submit" value="submit"/><input type="reset" name="reset" value="reset"/>
	</form>
</body>
</html>