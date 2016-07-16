<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>
	
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>
					View
					<?php if ($type == 'teacher'): ?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<a class="btn btn-primary <?php echo $state_id == 1 ? 'btn active' : ''; ?>"
						   href="/ta/evaluation/teacher/feedback/view/1"><?php echo lang('ta_feedback_list_apply_student'); ?></a>
						&nbsp;&nbsp;
						<a class="btn btn-primary <?php echo $state_id == 2 ? 'btn active' : ''; ?>"
						   href="/ta/evaluation/teacher/feedback/view/2"><?php echo lang('ta_feedback_list_check'); ?></a>
						&nbsp;&nbsp;
						<a class="btn btn-primary <?php echo $state_id == 3 ? 'btn active' : ''; ?>"
						   href="/ta/evaluation/teacher/feedback/view/3"><?php echo lang('ta_feedback_list_disposed'); ?></a>
					<?php elseif ($type == 'manage'): ?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<a class="btn btn-primary <?php echo $state_id == 1 ? 'btn active' : ''; ?>"
						   href="/ta/evaluation/manage/feedback/view/1"><?php echo lang('ta_feedback_list_apply_student'); ?></a>
						&nbsp;&nbsp;
						<a class="btn btn-primary <?php echo $state_id == 2 ? 'btn active' : ''; ?>"
						   href="/ta/evaluation/manage/feedback/view/2"><?php echo lang('ta_feedback_list_apply_teacher'); ?></a>
						&nbsp;&nbsp;
						<a class="btn btn-primary <?php echo $state_id == 3 ? 'btn active' : ''; ?>"
						   href="/ta/evaluation/manage/feedback/view/3"><?php echo lang('ta_feedback_list_disposed'); ?></a>
						&nbsp;&nbsp;
						<a class="btn btn-primary <?php echo $state_id == 4 ? 'btn active' : ''; ?>"
						   href="/ta/evaluation/manage/feedback/view/4"><?php echo lang('ta_feedback_list_closed'); ?></a>
					<?php endif; ?>
				</h2>
				<h2 id="semester">
					<span class="label label-info">
						Current Semester: <?php echo $this->Mta_site->print_semester(); ?>
					</span>
				</h2>
				<div class="row feedback_schema">
					<h4 class="col-sm-3"><?php echo lang('ta_main_title'); ?></h4>
					<h4 class="col-sm-2"><?php echo lang('ta_main_course_code'); ?></h4>
					<h4 class="col-sm-2"><?php echo lang('ta_main_ta_name'); ?></h4>
					<h4 class="col-sm-3"><?php echo lang('ta_main_time_submit'); ?></h4>
					<h4 class="col-sm-2"><?php echo lang('ta_main_progress'); ?></h4>
				</div>
				
				<div class="row feedback_content list_container">
					<?php foreach ($list as $feedback): ?>
						<?php /** @var $feedback Feedback_obj */ ?>
						<a class="col-sm-3"
						   href="/ta/evaluation/<?php echo $type; ?>/feedback/check/<?php echo
								   $feedback->id . '?page=' . $page_id .
								   ($type == 'student' ? '' : '&state=' . $state_id); ?>">
							<h4><?php echo $feedback->title; ?></h4></a>
						<h4 class="col-sm-2"><?php echo $feedback->course->KCDM; ?></h4>
						<h4 class="col-sm-2"><?php echo $feedback->ta->name_en; ?></h4>
						<h4 class="col-sm-3"><?php echo $feedback->CREATE_TIMESTAMP; ?></h4>
						<h4 class="col-sm-2"><?php echo $feedback->get_state_str(); ?></h4>
					<?php endforeach; ?>
					<?php echo '<center><h2 id="page_num">' . $this->pagination->create_links() . '</h2></center>'; ?>
				</div>
				<br>
				<?php if ($type == 'student'): ?>
					<a class="btn btn-primary" href="/ta/evaluation/student/feedback/add">Add new feedback</a>
				<?php endif ?>
			</div>
		</div>
	</div>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>