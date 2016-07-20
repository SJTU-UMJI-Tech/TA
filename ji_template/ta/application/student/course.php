<?php include 'header.php'; ?>

<link href="/ji_style/stu_app_courseinfo.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="/ji_js/stu_app_courseinfo.js"></script>
<script type="text/javascript">
	$(document).ready(function ()
	{
		var kcdm = "<?=$KCDM?>";
		$('.choose-course td').each(function ()
		{
			if ($(this).text().indexOf(kcdm) != -1)
			{
				$(this).trigger("click");
			}
		});
	});
</script>

<div class="list">
	<table class="all-content" width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td width="167px" class="sidebar">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="choose-course">
					<?php foreach ($class as $class_item): ?>
						<tr>
							<td><?php echo ucfirst(strtolower($class_item->KCDM)); ?><img
										src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
						</tr>
					<?php endforeach; ?>
				</table>
			</td>
			<td class="mainbar">
				<form id="form_action" action="/ta/application/Student/applydetail?courseid=" method="post">
					<fieldset class="text-container application-status">
						<legend>Application Status</legend>
						<div align="center">
							<h3>Application of <span class="courseid"></span> Teaching Assistant is <span
										class="status">Close</span>.
							</h3>
							<input type="button" align="center" value="" class="submit change">
							<input id="form_status" type="text" name="status" value="" class="hidden">
							<input id="form_BSID" type="text" name="BSID" value="" class="hidden">
							<input type="text" name="choice" value="change" class="hidden">
						</div>
					</fieldset>
					<div class="box" id="change-box">
						<div class="text">
							<p class="question">Are you sure to change the status?</p>
						</div>
						<table width="80%" align="center">
							<td width="40%"><input type="submit" align="center" value="Yes" class="submit"
							                       id="change-yes"></td>
							<td width="40%"><input type="button" align="center" value="No" class="submit no"></td>
						</table>
					</div>
				</form>
				<form action="/Pro_class/setcourseinfo" method="post">
					<fieldset class="text-container course-information">
						<legend>Course Information</legend>
						<table width="100%">
							<td width="100%">
								<ul>
									<li>Course ID: <span class="readonly course_id input_text" value="" size="12"
									                     readonly></span></li>
									<li>Course Title: <span class="readonly course_title input_text" value="" size="20"
									                        readonly></span></li>
									<li>Professor's Name: <span class="readonly name input_text" value="" size="12"
									                            readonly></span>
									</li>
									<li>Professor's Email: <span type="text" name="email"
									                             class="readonly email input_text" value="" size="20"
									                             readonly></span></li>
									<li>Academic Year: <span class="readonly year input_text" value="" size="12"
									                         readonly="readonly"></span></li>
									<li>Semester: <span class="readonly semester input_text" value="" size="6"
									                    readonly></span></li>
									<li>Max TA Number: <span type="text" name="maxta" class="readonly max input_text"
									                         value="" size="1" readonly></span></li>
									<li>Current TA Number: <span class="readonly current input_text" value="" size="1"
									                             readonly></span></li>
									<li>Salary: <span type="text" name="salary" class="readonly salary input_text"
									                  value="" size="4" readonly></span></li>
									<input id="form_BSID2" type="text" name="BSID" value="" class="hidden">
									<input type="text" name="choice" value="modify" class="hidden">
									<li>Description: <br/></li>
								</ul>
							</td>
						</table>
						<div align="center">
							<textarea name="description" rows="10" class="readonly description" readonly></textarea>
						</div>
					</fieldset>
					<div class="box" id="modify-box">
						<div class="text">
							<p class="question">Are you sure to submit the modification?</p>
						</div>
						<table width="80%" align="center">
							<td width="40%"><input type="submit" align="center" value="Yes" class="submit"
							                       id="modify-yes"></td>
							<td width="40%"><input type="button" align="center" value="No" class="submit no"></td>
						</table>
					</div>
					<div class="box" id="modify-box2">
						<div class="text">
							<p class="question">The modification hasn't be saved yet.<br/>Do you want to save it?</p>
						</div>
						<table width="80%" align="center">
							<td width="40%"><input type="submit" align="center" value="Yes" class="submit"
							                       id="modify-yes2"></td>
							<td width="40%"><input type="button" align="center" value="No" class="submit no"
							                       id="modify-no2"></td>
						</table>
					</div>
				</form>
			</td>
		</tr>
	</table>
</div>
<div id="bg"></div>
<div id="bg2" class="hidden"></div>
<div class="hidden" id="class_data">
	<?php foreach ($class as $class_item): ?>
		<p id="<?= strtolower($class_item->KCDM) ?>" status="<?= $class_item->status ?>"
		   KCDM="<?= strtolower($class_item->KCDM) ?>" KCZWMC="<?= $class_item->KCZWMC ?>" XM="<?= $class_item->XM ?>"
		   XQ="<?= $class_item->XQ ?>" XN="<?= $class_item->XN ?>" KCJJ="<?= $class_item->KCJJ ?>"
		   maxta="<?= $class_item->maxta ?>" curta="<?= $class_item->curta ?>" salary="<?= $class_item->salary ?>"
		   email="<?= $class_item->email ?>" BSID="<?= $class_item->BSID ?>"></p>
	<?php endforeach; ?>
</div>
</body>
</html>