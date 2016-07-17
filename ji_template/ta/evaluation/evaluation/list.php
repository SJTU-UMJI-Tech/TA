<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>Evaluation Setup</h2>
				<h2 id="semester">
					<span class="label label-info">
                        Current Semester: <?php echo $this->Mta_site->print_semester(); ?>
                    </span>
				</h2>

				<div class="attention teacher_setup">
					<h2>Attention</h2>
					<ul>
						<?php if ($type == 'teacher'): ?>
							<li>1. You can add at most <?php echo $config->addition;?> questions to
								TA evaluation.</li>
							<li>2. Click on the course and check or evaluate the TAs.</li>
							<li>3. You must add questions before the evaluation begins.</li>
						<?php elseif ($type == 'student'): ?>
							<?php if ($state == 0): ?>
								<li>Time for Evaluation</li>
							<?php else: ?>
								<li>Not time for evaluation</li>
							<?php endif; ?>
						<?php endif; ?>
					</ul>
				</div>

				<h4>Course List</h4>
				<div class="row feedback_schema">
					<h4 class="col-sm-2">Course ID</h4>
					<h4 class="col-sm-6">Course Name</h4>
					<h4 class="col-sm-2">TA Number</h4>
					<h4 class="col-sm-2">Process</h4>
				</div>
				<div class="list_container">
					<?php foreach ($course_list as $course): ?>
						<?php /** @var $course Course_obj */ ?>
						<div class="evaluation-list" state="close">
								<h4 class="col-sm-2"><?php echo $course->KCDM; ?></h4>
								<h4 class="col-sm-6"><?php echo $course->KCZWMC; ?></h4>
								<h4 class="col-sm-2"><?php echo count($course->ta_list); ?></h4>
								<h4 class="col-sm-2">
									<?php if ($type == 'teacher'): ?>
										<a href="/ta/evaluation/teacher/evaluation/check/<?php
										echo $course->BSID; ?>">check</a>
										<?php if (count($course->question_list) < $config->addition &&
											$state == -1
										): ?>
											| <a href="/ta/evaluation/teacher/evaluation/add/<?php
											echo $course->BSID; ?>">add question</a>
										<? endif; ?>
									<? endif; ?>
									<?php if ($type == 'student'): ?>
										<span>check</span>
									<? endif; ?>
								</h4>
							<?php foreach ($course->ta_list as $ta): ?>
								<?php /** @var $ta Ta_obj */ ?>
								<div class="row evaluation-list-ta" style="display: none">
									<h5 class="col-sm-2"><span class="glyphicon glyphicon-tag"></span></h5>
									<h5 class="col-sm-6"><?php echo $ta->name_ch . '(' .
											$ta->name_en . ')'; ?></h5>
									<h5 class="col-sm-2"></h5>
									<h5 class="col-sm-2">
										<?php if ($type == 'teacher' || $type == 'student'): ?>
											<?php if ($state == -1): ?>
												not opened
											<?php elseif ($state == 0 ||
												count($ta->answer_list) > 0
											): ?>
												<a href="/ta/evaluation/<?php
												echo $type; ?>/evaluation/evaluate/<?php
												echo $course->BSID; ?>?ta_id=<?php echo $ta->USER_ID ?>">
													<?php if (count($ta->answer_list) == $edit_max)
														: ?>
														review
													<?php elseif (count($ta->answer_list) == 0): ?>
														evaluate
													<?php else: ?>
														edit(<?php echo $edit_max -
															count($ta->answer_list); ?>
														times left)
													<?php endif; ?>
												</a>
											<?php elseif ($state == 1): ?>
												not participated
											<?php endif; ?>
										<?php endif; ?>
									</h5>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function ()
		{
			$(".evaluation-list").click(function (e)
			{
				var $target = $(e.target);
				while ($target.attr('class') != "evaluation-list")
				{
					$target = $target.parent();
				}
				if ($target.attr('state') == 'open')
				{
					$target.attr('state', 'close');
					$target.children(".evaluation-list-ta").css('display', 'none');
				}
				else
				{
					$target.attr('state', 'open');
					$target.children(".evaluation-list-ta").css('display', 'inline');
				}
			});
		});
	</script>
<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>