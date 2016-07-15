<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>


	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>
					Edit Config > <?php echo $edit_type;?>
					<div id="return">
						<a><span class="glyphicon glyphicon-repeat" aria-hidden="true" title="Return"></span></a>
					</div>
				</h2>
				<h2 id="semester">
					<span class="label label-info">
						Current Semester: <?php echo $this->Mta_site->print_semester(); ?>
					</span>
				</h2>
				<div class="row search_course">
					<h5 class="col-sm-2"><?php echo lang('ta_question_edit_id'); ?></h5>
					<h5 class="col-sm-3"><?php echo lang('ta_question_edit_name'); ?></h5>
					<h5 class="col-sm-2"><?php echo lang('ta_question_create_by'); ?></h5>
					<h5 class="col-sm-2"><?php echo lang('ta_question_last_edit'); ?></h5>
					<h5 class="col-sm-2"><?php echo lang('ta_question_edit_time'); ?></h5>
				</div>
				<?php foreach ($config_list as $config): ?>
					<?php /** @var $config Evaluation_config_obj */ ?>
					<h5 class="col-sm-2">
						<a href="/ta/evaluation/manage/evaluation/edit?id=<?php echo $config->id; ?>">
							<?php echo $config->id; ?>
						</a>
					</h5>
					<h5 class="col-sm-3">
						<a href="/ta/evaluation/manage/evaluation/edit?id=<?php echo $config->id; ?>">
							<?php echo $config->name; ?>
						</a>
					</h5>
					<h5 class="col-sm-2">
						<a href="/ta/evaluation/manage/evaluation/edit?id=<?php echo $config->id; ?>">
							<?php echo $config->creater->user_name; ?>
						</a>
					</h5>
					<h5 class="col-sm-2">
						<a href="/ta/evaluation/manage/evaluation/edit?id=<?php echo $config->id; ?>">
							<?php echo $config->editor->user_name; ?>
						</a>
					</h5>
					<h5 class="col-sm-3">
						<a href="/ta/evaluation/manage/evaluation/edit?id=<?php echo $config->id; ?>">
							<?php echo $config->CREATE_TIMESTAMP; ?>
						</a>
					</h5>




				<?php endforeach; ?>
			</div>
		</div>
	</div>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>