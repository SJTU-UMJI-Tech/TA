<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php /** @var $course Course_obj */ ?>

	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>
					Add question > <?php echo $course->KCDM;?> > <?php echo '#'.(count($course->question_list)+1);?>
					<div id="return" url="/view" back="2">
						<a><span class="glyphicon glyphicon-repeat" aria-hidden="true" title="Return"></span></a>
					</div>
				</h2>
                <div class="row">
                    <h4 class="col-sm-3 question_type">
                        <span class="label label-info tag">
                            Question Type:
                        </span>
                    </h4>
                    <div class="form-group col-sm-6 question_content">
                        <br><br>
                        <input type="radio" name="type" value="choice" checked="checked"/><span>Choice &nbsp;&nbsp;(Grading Questions: up to 5 points for each question)</span>
                        <br>
                        <input type="radio" name="type" value="blank"/><span>Blank &nbsp;&nbsp;&nbsp;&nbsp;(Short Answer Questions)</span>
                    </div>
                </div>

                <div class="row">
                    <h4 class="col-sm-3">
                        <span class="label label-info tag">
                            Question Content:
                        </span>
                    </h4>
                    <div class="form-group col-sm-7">
                        <br><br>
                        <textarea id="input-content" rows="15" style="resize:none;width:100%"></textarea>
                    </div>
                </div>
                <div class="submit">
                    <button id="submit-button" class="btn btn-primary">Submit</button>
                </div>

			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function ()
		{
			$("#submit-button").click(function ()
			{
				$.ajax
				 ({
					 type: 'GET',
					 url: '/ta/evaluation/teacher/evaluation/question/',
					 data: {
						 BSID: <?php echo $course->BSID;?>,
						 type: $("input[name='type']:checked").val(),
						 content: $("#input-content").val(),
						 id: 0
					 },
					 dataType: 'text',
					 success: function (data)
					 {
						 if (data == 'success')
						 {
							 location.href = '/ta/evaluation/teacher/evaluation/check/<?php echo $course->BSID;?>';
						 }
						 else
						 {
							 alert(data);
						 }
					 },
					 error: function ()
					 {
						 alert('fail!');
					 }
				 });
			});
		});
	</script>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>