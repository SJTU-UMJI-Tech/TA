<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php /** @var $course Course_obj */ ?>

<div class='body'>
	<div class="maincontent">
		<div class="announcement">
			<h2 id="title">
				Course Description >
				<?php echo $course->KCDM; ?>
				<div id="return">
					<a><span class="glyphicon glyphicon-repeat" aria-hidden="true" title="Return"></span></a>
				</div>
			</h2>

			<!--			Course information-->
			<h4 class="title_course">
				<?php echo lang('ta_main_course_info'); ?>
			</h4>
			<div class="row course_info">
				<h5 class="col-sm-2">
					<?php echo lang('ta_main_course_id'); ?>
					<br><br>
					<?php echo lang('ta_main_course_code'); ?>
					<br><br>
					<?php echo lang('ta_main_course_name'); ?>
					<br><br>
					<?php echo lang('ta_main_term'); ?>
					<br><br>
					<?php echo lang('ta_main_teacher'); ?>
				</h5>
				<h5 class="col-sm-5">
					<?php echo $course->BSID; ?>
					<br><br>
					<?php echo $course->KCDM; ?>
					<br><br>
					<?php echo $course->KCZWMC; ?>
					<br><br>
					<?php echo $course->XN . ': ' . $course->XQ; ?>
					<br><br>
					<?php echo $course->XM; ?>
				</h5>
			</div>

			<br>
			<!--			Feedback part-->
			<h4 class="title_course">
				<?php echo lang('ta_main_feedback_list'); ?>
			</h4>
			<div id="feedback-list" class="feedback_list">
				<?php foreach ($course->feedback_list as $feedback): ?>
					<?php /** @var $feedback Feedback_obj */ ?>
					<div class="row">
						<div class="col-sm-2">
							<a href="/ta/evaluation/manage/feedback/check/<?php echo $feedback->id; ?>"><?php echo $feedback->title; ?></a>
						</div>
						<div class="col-sm-2">
							<?php echo $feedback->get_state_str(); ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

            <br>
			<!--			TA list part-->
			<h4 class="title_course">
				<?php echo lang('ta_main_ta_list'); ?>
			</h4>
			<div id="ta-list" class="ta_list">
				<?php foreach ($course->ta_list as $ta): ?>
					<?php /** @var $ta Ta_obj */ ?>
					<?php echo $ta->name_ch; ?>
				<?php endforeach; ?>
			</div>

            <br>
			<!--			Student list taking this course-->
			<h4 class="title_course">
				<?php echo lang('ta_main_student_list'); ?>
			</h4>
			<div id="student-list" class="student_list">
				<?php foreach ($course->student_list as $student): ?>
					<?php /** @var $student Student_obj */ ?>
					<?php echo '<h4 class="col-sm-2">'.$student->student_name.'</h4>'; ?>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
</div>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>
