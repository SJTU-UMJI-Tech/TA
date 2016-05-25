<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php /** @var $course Course_obj */ ?>

	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2 id="semester">
                    <span class="label label-info">
                        <?php echo $this->Mta_site->print_semester(); ?> > Course ID > TA name
                    </span>
				</h2>

				<div class="evaluation_question">
					<h2>Evaluation Questions for 2016</h2>
					<div class="main_question">
						<h3>I) Choice Questions: (max score is 5 points for each questions)</h3>
						<br/>
						<?php foreach ($choice_list as $key => $question): ?>
							<h4>
								&nbsp;&nbsp;<?php echo $key + 1; ?>.&nbsp;
								<?php echo $question->content; ?>
							</h4>
							<br/>
							<div class="row">
								<label class="col-sm-2 col-md-1"><input name="c<?php echo $key + 1; ?>" type="radio"
								                                        value="1"/>1
								</label>
								<label class="col-sm-2 col-md-1"><input name="c<?php echo $key + 1; ?>" type="radio"
								                                        value="2"/>2
								</label>
								<label class="col-sm-2 col-md-1"><input name="c<?php echo $key + 1; ?>" type="radio"
								                                        value="3"/>3
								</label>
								<label class="col-sm-2 col-md-1"><input name="c<?php echo $key + 1; ?>" type="radio"
								                                        value="4"/>4
								</label>
								<label class="col-sm-2 col-md-1"><input name="c<?php echo $key + 1; ?>" type="radio"
								                                        value="5"/>5
								</label>
							</div>
							<br/>
						<?php endforeach; ?>
						<br/>
						<h3>II) Blank Questions: </h3>
						<br/>
						<?php foreach ($blank_list as $key => $question): ?>
							<h4>
								&nbsp;&nbsp;<?php echo $key + 1; ?>.&nbsp;
								<?php echo $question->content; ?>
							</h4>
							<br/>
							<textarea id="b<?php echo $key + 1; ?>" rows="5" style="resize:none;width:100%"></textarea>
							<br/>
						<?php endforeach; ?>
						<br/>
						<?php if ($type == 'student' && count($course->question_list) > 0): ?>
							<br/>
							<h3>III) Additional Questions: </h3>
							<br/>
							<?php foreach ($course->question_list as $key => $question): ?>
								<?php /** @var $question Evaluation_question_obj */ ?>
								<div id="a<?php echo $key + 1; ?>" class="addition-<?php echo $question->type; ?>">
									<h4>
										&nbsp;&nbsp;<?php echo $key + 1; ?>.&nbsp;
										<?php echo $question->content; ?>
									</h4>
									<br/>
									<?php if ($question->type == 'choice'): ?>
										<div class="row">
											<label class="col-sm-2 col-md-1">
												<input name="a<?php echo $key + 1; ?>" type="radio" value="1"/>1
											</label>
											<label class="col-sm-2 col-md-1">
												<input name="a<?php echo $key + 1; ?>" type="radio" value="2"/>2
											</label>
											<label class="col-sm-2 col-md-1">
												<input name="a<?php echo $key + 1; ?>" type="radio" value="3"/>3
											</label>
											<label class="col-sm-2 col-md-1">
												<input name="a<?php echo $key + 1; ?>" type="radio" value="4"/>4
											</label>
											<label class="col-sm-2 col-md-1">
												<input name="a<?php echo $key + 1; ?>" type="radio" value="5"/>5
											</label>
										</div>
									<?php elseif ($question->type == 'blank'): ?>
										<textarea rows="5" style="resize:none;width:100%"></textarea>
									<?php endif; ?>
									<br/>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
						<br/>
						<button id="submit-button" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function ()
		{
			$("#submit-button").click(function ()
			{
				var answer = [];
				for (var i = 1; i <= <?php echo count($choice_list); ?>; i++)
				{
					var a = $("input[name='c" + i + "']:checked");
					if (a.val() > 0)
					{
						answer.push({type: 'choice', num: i, answer: a.val()});
						continue;
					}
					alert('Choice ' + i + ' not completed!');
					return;
				}
				for (var i = 1; i <= <?php echo count($blank_list); ?>; i++)
				{
					var a = $("#b" + i);
					if (a.val().length > 0)
					{
						answer.push({type: 'blank', num: i, answer: a.val()});
						continue;
					}
					alert('Blank ' + i + ' not completed!');
					return;
				}
				for (var i = 1; i <= <?php echo count($course->question_list); ?>; i++)
				{
					var type = $("#a" + i).attr('class');
					type = type.substr(type.indexOf('-') + 1);
					if (type == 'choice')
					{
						var a = $("input[name=a" + i + "]:checked");
						if (a.val() > 0)
						{
							answer.push({type: 'addition', num: i, answer: a.val()});
							continue;
						}
					}
					else if (type == "blank")
					{
						var a = $("#a" + i + " textarea");
						if (a.val().length > 0)
						{
							answer.push({type: 'addition', num: i, answer: a.val()});
							continue;
						}
					}
					alert('Addition ' + i + ' not completed!');
					return;
				}
				$.ajax
				 ({
					 type: 'POST',
					 url: '/ta/evaluation/<?php echo $type;?>/evaluation/answer/',
					 data: {
						 BSID: <?php echo $course->BSID; ?>,
						 answer: answer
					 },
					 dataType: 'text',
					 success: function (data)
					 {
						 if (data == 'success')
						 {
							 window.location.href = '/ta/evaluation/<?php echo $type;?>/evaluation/view/';
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