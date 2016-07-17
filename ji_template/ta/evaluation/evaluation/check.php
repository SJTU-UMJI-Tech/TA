<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php /** @var $course Course_obj */ ?>
	
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>
					Check > <?php echo $course->KCDM ?>
					<div id="return" url="/view" back="2">
						<a><span class="glyphicon glyphicon-repeat" aria-hidden="true"
						         title="Return"></span></a>
					</div>
				</h2>
				<?php if (count($course->question_list) == 0): ?>
					<h4>Question not added</h4>
					<br/>
				<?php endif; ?>
				<?php foreach ($course->question_list as $key => $question): ?>
					<?php /** @var $question Evaluation_question_obj */ ?>
					<div class="row">
						<h4 class="col-sm-3 question_type">
                            <span class="label label-info tag">
                               Question #<?php echo $key + 1; ?>
                            </span>
						</h4>
						<div class="col-sm-2">
							<a class="btn btn-warning btn-edit"
							   href="/ta/evaluation/teacher/evaluation/edit/<?php echo $course->BSID . '?id=' .
							                                                           ($key + 1); ?>">
								Edit
							</a>
						</div>
					</div>
					<div class="question_description">
						<div class="row">
							<h4 class="col-sm-3">Question Type: </h4>
							<h5 class="col-sm-6">
								<?php echo $question->type; ?>
							</h5>
						</div>
						<div class="row">
							<h4 class="col-sm-3">Question Content: </h4>
							<h5 class="col-sm-6">
								<?php echo $question->content; ?>
							</h5>
						</div>
						<div class="row">
							<h4 class="col-sm-3">Edit Time: </h4>
							<h5 class="col-sm-6">
								<?php echo $question->CREATE_TIMESTAMP; ?>
							</h5>
						</div>
					</div>
					<br><br>
					<hr>
				<?php endforeach; ?>
			
			
			</div>
		</div>
	</div>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>