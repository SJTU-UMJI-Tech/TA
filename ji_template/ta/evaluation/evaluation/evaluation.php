<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php /** @var $course Course_obj */ ?>
<?php /** @var $ta Ta_obj */ ?>
	
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<div class="evaluation_question">
					<h2>Evaluation Questions for <?php echo $this->Mta_site->print_semester(); ?></h2>
					<h2 id="semester">
                    	<span class="label label-info">
                        	<?php echo $this->Mta_site->print_semester(); ?> > Course ID > <?php echo $ta->name_en; ?>
                    	</span>
					</h2>
					<div class="main_question">
						<h4 class="module_description">
							I) Choice Questions: (max score is 5 points for each questions)
							<br/><br/>
						</h4>
						<?php foreach ($choice_list as $key => $question): ?>
							<h5>
								&nbsp;&nbsp;<?php echo $key + 1; ?>.&nbsp;
								<?php echo $question->content; ?>
							</h5>
							<div class="row multi-choice">
								<label class="col-sm-2 col-md-1"><input
											name="c<?php echo $key + 1; ?>" type="radio"
											value="1"/>1
								</label>
								<label class="col-sm-2 col-md-1"><input
											name="c<?php echo $key + 1; ?>" type="radio"
											value="2"/>2
								</label>
								<label class="col-sm-2 col-md-1"><input
											name="c<?php echo $key + 1; ?>" type="radio"
											value="3"/>3
								</label>
								<label class="col-sm-2 col-md-1"><input
											name="c<?php echo $key + 1; ?>" type="radio"
											value="4"/>4
								</label>
								<label class="col-sm-2 col-md-1"><input
											name="c<?php echo $key + 1; ?>" type="radio"
											value="5"/>5
								</label>
							</div>
						<?php endforeach; ?>
						<br/>
						<h4 class="module_description">
							II) Blank Questions:
							<br/><br/>
						</h4>
						<?php foreach ($blank_list as $key => $question): ?>
							<h5>
								&nbsp;&nbsp;<?php echo $key + 1; ?>.&nbsp;
								<?php echo $question->content; ?>
							</h5>
							<br/>
							<textarea id="b<?php echo $key + 1; ?>" rows="5"
							          style="resize:none;width:100%"></textarea>
							<br/>
						<?php endforeach; ?>
						<br/>
						<?php if ($type == 'student' && count($course->question_list) > 0): ?>
							<br/>
							<h4 class="module_description">
								III) Additional Questions:
								<br/><br/>
							</h4>
							<?php foreach ($course->question_list as $key => $question): ?>
								<?php /** @var $question Evaluation_question_obj */ ?>
								<div id="a<?php echo $key + 1; ?>"
								     class="addition-<?php echo $question->type; ?>">
									<h5>
										&nbsp;&nbsp;<?php echo $key + 1; ?>.&nbsp;
										<?php echo $question->content; ?>
									</h5>
									<?php if ($question->type == 'choice'): ?>
										<div class="row">
											<label class="col-sm-2 col-md-1">
												<input name="a<?php echo $key + 1; ?>" type="radio"
												       value="1"/>1
											</label>
											<label class="col-sm-2 col-md-1">
												<input name="a<?php echo $key + 1; ?>" type="radio"
												       value="2"/>2
											</label>
											<label class="col-sm-2 col-md-1">
												<input name="a<?php echo $key + 1; ?>" type="radio"
												       value="3"/>3
											</label>
											<label class="col-sm-2 col-md-1">
												<input name="a<?php echo $key + 1; ?>" type="radio"
												       value="4"/>4
											</label>
											<label class="col-sm-2 col-md-1">
												<input name="a<?php echo $key + 1; ?>" type="radio"
												       value="5"/>5
											</label>
										</div>
									<?php elseif ($question->type == 'blank'): ?>
										<textarea rows="5"
										          style="resize:none;width:100%"></textarea>
									<?php endif; ?>
									<br/>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
						<br/>
						<?php if ($operation == 'edit' || $operation == 'evaluate'): ?>
							<button id="submit-button" class="btn btn-primary">Submit</button>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function ()
		{
			<?php if ($operation == 'edit' || $operation == 'review'): ?>
			var answer = JSON.parse('<?php echo $answer; ?>');
			for (var i = 1; i <= <?php echo count($choice_list); ?>; i++)
			{
				$("input[name='c" + i + "'][value=" + answer.choice[i] + "]").attr('checked', true);
				<?php if ($operation == 'review'): ?>
				$("input[name='c" + i + "']").attr('disabled', true);
				<?php endif; ?>
			}
			for (var i = 1; i <= <?php echo count($blank_list); ?>; i++)
			{
				var $select = $("#b" + i);
				$select.val(answer.blank[i]);
				<?php if ($operation == 'review'): ?>
				$select.attr('disabled', true);
				<?php endif; ?>
			}
			<?php if($type == 'student'):?>
			for (var i = 1; i <= <?php echo count($course->question_list); ?>; i++)
			{
				var type = $("#a" + i).attr('class');
				type = type.substr(type.indexOf('-') + 1);
				if (type == 'choice')
				{
					$("input[name='a" + i + "'][value=" + answer.addition[i] + "]")
							.attr('checked', true);
					<?php if ($operation == 'review'): ?>
					$("input[name='a" + i + "']").attr('disabled', true);
					<?php endif; ?>
				}
				else if (type == "blank")
				{
					var $select = $("#a" + i + " textarea");
					$select.val(answer.addition[i]);
					<?php if ($operation == 'review'): ?>
					$select.attr('disabled', true);
					<?php endif; ?>
				}
			}
			<?php endif; ?>
			<?php endif; ?>
			<?php if ($operation == 'edit' || $operation == 'evaluate'): ?>
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
				<?php if($type == 'student'):?>
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
				<?php endif;?>
				$.ajax
				 ({
					 type: 'POST',
					 url: '/ta/evaluation/<?php echo $type;?>/evaluation/answer/',
					 data: {
						 BSID: <?php echo $course->BSID; ?>,
						 ta_id: <?php echo $ta->USER_ID; ?>,
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
			<?php endif;?>
		})
		;
	</script>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>