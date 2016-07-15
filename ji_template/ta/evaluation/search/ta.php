<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php /** @var $ta Ta_obj */?>

<div class='body'>
	<div class="maincontent">
		<div class="announcement">
			<h2 id="title">
				TA Description >
				<?php echo $ta->name_en; ?>
				<div id="return">
					<a><span class="glyphicon glyphicon-repeat" aria-hidden="true" title="Return"></span></a>
				</div>
			</h2>

			<!--			Course information-->
			<h4 class="title_course">
                TA Info
			</h4>
			<div class="row course_info">
				<h5 class="col-sm-2">
					English Name:
					<br><br>
					Name:
					<br><br>
					Gender:
					<br><br>
					Faculty:
					<br><br>
					Email:
                    <br><br>
                    Phone:
                    <br><br>
				</h5>
				<h5 class="col-sm-5">
                    <?php echo $ta->name_en; ?>
					<br><br>
					<?php echo $ta->name_ch; ?>
					<br><br>
					<?php echo $ta->gender; ?>
					<br><br>
					<?php echo $ta->faculty; ?>
					<br><br>
					<?php echo $ta->email; ?>
                    <br><br>
                    <?php echo $ta->phone; ?>
				</h5>
			</div>

			<br>
			<!--			Feedback part-->
			<h4 class="title_course">
				Course Assisting
			</h4>
			<div id="feedback-list" class="feedback_list">
                <div class="ta_course_info">
                    <h5 class="col-sm-2">Course ID</h5>
                    <h5 class="col-sm-5">Course Name</h5>
                    <h5 class="col-sm-3">Teacher</h5>
                <br><br>
				<?php
                echo '</div>';
                echo '<br>';
                foreach ($ta->course_list as $course)
                {
                    echo '<h5 class="col-sm-2">'.$course->KCDM.'</h5>';
                    echo '<h5 class="col-sm-5">'.$course->KCZWMC.'</h5>';
                    echo '<h5 class="col-sm-3">'.$course->XM.'</h5>';
                    echo '<br>';
                };
                ?>
			</div>

			<br>
			<!--			TA list part-->
			<h4 class="title_course">
				Feedback
			</h4>
			<div id="ta-list" class="ta_list">
				<?php
                foreach ($ta->feedback_list as $feedback)
                {
                    echo $feedback->title;
                    echo '<br>';
                };
                ?>
			</div>

			<br>
			<!--			Student list taking this course-->
			<h4 class="title_course">
				Report
			</h4>
			<div id="student-list" class="student_list">
				<?php
                foreach ($ta->report_list as $report)
                {
                    echo $report->title;
                    echo '<br>';
                };
                ?>
			</div>

		</div>
	</div>
</div>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>
