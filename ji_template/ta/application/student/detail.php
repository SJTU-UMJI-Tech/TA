<?php include 'header.php'; ?>

<link href="/ji_style/ta/application/student/stu_app_applydetail.css" type="text/css" rel="stylesheet" />
<script src="/ji_js/ta/application/student/stu_app_applydetail.js"></script>

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