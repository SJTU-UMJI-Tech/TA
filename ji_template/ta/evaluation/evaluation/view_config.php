<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>
	
	
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>
					Edit Config > <?php echo $edit_type; ?>
					<div id="return" back="1">
						<a><span class="glyphicon glyphicon-repeat" aria-hidden="true" title="Return"></span></a>
					</div>
				</h2>
				<div class="row">
					<div class="col-sm-9">
						<h2 id="semester">
						<span class="label label-info">
							Current Semester: <?php echo $this->Mta_site->print_semester(); ?>
						</span>
						</h2>
					</div>
					<div class="col-sm-3">
						<a class="btn btn-primary" href="/ta/evaluation/manage/evaluation/edit<?php echo '?id=0&type=' .
						                                                                                 $edit_type; ?>">
							Add new config
						</a>
					</div>
				</div>
				
				
				<div class="row search_course">
					<h5 class="col-sm-1"><?php echo lang('ta_question_edit_id'); ?></h5>
					<h5 class="col-sm-3"><?php echo lang('ta_question_edit_name'); ?></h5>
					<h5 class="col-sm-2"><?php echo lang('ta_question_create_by'); ?></h5>
					<h5 class="col-sm-2"><?php echo lang('ta_question_last_edit'); ?></h5>
					<h5 class="col-sm-2"><?php echo lang('ta_question_edit_time'); ?></h5>
					<h5 class="col-sm-1"><?php echo lang('ta_question_status'); ?></h5>
				</div>
				<?php foreach ($config_list as $config): ?>
					<?php /** @var $config Evaluation_config_obj */ ?>
					<div class="row">
						<h5 class="col-sm-1">
							<a href="/ta/evaluation/manage/evaluation/edit<?php echo '?id=' . $config->id . '&type=' .
							                                                         $config->type; ?>">
								<?php echo $config->id; ?>
							</a>
						</h5>
						<h5 class="col-sm-3">
							<a href="/ta/evaluation/manage/evaluation/edit<?php echo '?id=' . $config->id . '&type=' .
							                                                         $config->type; ?>">
								<?php echo $config->description; ?>
							</a>
						</h5>
						<h5 class="col-sm-2">
							<a href="/ta/evaluation/manage/evaluation/edit<?php echo '?id=' . $config->id . '&type=' .
							                                                         $config->type; ?>">
								<?php echo $config->creater->user_name; ?>
							</a>
						</h5>
						<h5 class="col-sm-2">
							<a href="/ta/evaluation/manage/evaluation/edit<?php echo '?id=' . $config->id . '&type=' .
							                                                         $config->type; ?>">
								<?php echo $config->editor->user_name; ?>
							</a>
						</h5>
						<h5 class="col-sm-2">
							<a href="/ta/evaluation/manage/evaluation/edit<?php echo '?id=' . $config->id . '&type=' .
							                                                         $config->type; ?>">
								<?php echo $config->CREATE_TIMESTAMP; ?>
							</a>
						</h5>
						<h5 class="col-sm-1">
							<?php if ($config->state != 0): ?>
								<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
							<?php endif; ?>
							<?php if ($ta_evaluation_config_student == $config->id ||
							          $ta_evaluation_config_teacher == $config->id
							): ?>
								
								<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							<?php endif; ?>
						</h5>
					</div>
				
				<?php endforeach; ?>
			
			
			</div>
		</div>
	</div>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>