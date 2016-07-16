<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php /** @var $config Evaluation_config_obj */ ?>
	
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>
					Edit Config > <?php echo $config->id > 0 ? $config->id : 'New'; ?>
					<div id="return" url="<?php echo '?type=' . $edit_type; ?>" back="0">
						<a><span class="glyphicon glyphicon-repeat" aria-hidden="true" title="Return"></span></a>
					</div>
				</h2>
				
				<?php if ($config->state == 0): ?>
					<?php if ($ta_evaluation_config_student != $id && $ta_evaluation_config_teacher != $id): ?>
						<button class="btn btn-danger btn-delete-all">Delete
						</button>
					<?php else: ?>
						<button class="btn btn-warning btn-lock" data-toggle="tooltip" data-placement="bottom"
						        title="<?php echo lang('ta_question_explain_lock'); ?>">Lock
						</button>
					<?php endif; ?>
				<?php else: ?>
					<button class="btn btn-warning btn-modify-all" data-toggle="tooltip" data-placement="bottom"
					        title="<?php echo lang('ta_question_explain_modify'); ?>">Modify
					</button>
				<?php endif; ?>
				
				<h3>Description:</h3>
				<input id="description" type="text" name="description" value="<?php echo $config->description; ?>">
				
				<h3>Choices:</h3>
				<div class="question-list" id="choice-list"></div>
				<button class="btn btn-primary btn-add" qtype="choice">Add</button>
				
				<h3>Blanks:</h3>
				<div class="question-list" id="blank-list"></div>
				<button class="btn btn-primary btn-add" qtype="blank">Add</button>
				
				<?php if ($edit_type == 'student'): ?>
					<h3>Number of Addition Questions:</h3>
					<input id="addition" type="text" name="addition-question" value="<?php echo $config->addition; ?>">
					
				<?php endif; ?>
				
				<br>
				<br>
				
				<button class="btn btn-primary btn-save">Save</button>
				
				<?php if ($ta_evaluation_config_student != $id && $ta_evaluation_config_teacher != $id): ?>
					<button class="btn btn-warning btn-active">Set as active</button>
				<?php else: ?>
					<button class="btn btn-warning btn-active" disabled="disabled">Active</button>
				<?php endif; ?>
			</div>
			
			
			<div class="modal fade" id="add-modal" aria-hidden="true"
			     aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="add-form">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" id="add-modal-label">Add a question</h4>
							</div>
							<div class="modal-body">
								<input type="text" class="form-control add-search" placeholder="Search">
								<br>
								<div class="add-list">
								
								</div>
								
								<div class="row">
									<div class="col-sm-6">
										<a href="javascript:void(0)" class="list-group-item add-item add-new active"
										   qid="0">
											New Question
										</a>
									</div>
								</div>
								
								<br>
								
								<div class="add-text">
									<textarea class="form-control" rows="5"
									          style="resize:none;width:100%"></textarea>
									<br>
								</div>
								<button class="btn btn-primary btn-block btn-close">Done</button>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.modal -->
		
		
		</div>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function ()
		{
			var config_id = <?php echo $id?>;
			
			var $addModal = $("#add-modal");
			var $addList = $addModal.find(".add-list");
			var $addText = $addModal.find(".add-text");
			
			var getitem = function ($target)
			{
				while ($target.attr('class') != "question-item" || !$target)
				{
					$target = $target.parent();
				}
				return $target;
			};
			
			var reset = function (type)
			{
				var $children = $("#" + type + "-list").children(".question-item");
				var $target = $children.first();
				if (!$target)
				{
					return;
				}
				$target.find(".btn-up").attr('disabled', 'disabled');
				$target = $target.next();
				if ($target)
				{
					$target.find(".btn-up").removeAttr('disabled');
				}
				$target = $children.last();
				$target.find(".btn-down").attr('disabled', 'disabled');
				$target = $target.prev();
				if ($target)
				{
					$target.find(".btn-down").removeAttr('disabled');
				}
			};
			
			var generate = function (type, id, content, time, state)
			{
				var data = [
					'<div class="question-item" qid="', id, '" qtype="', type, '">',
					'<div class="row">',
					'<div class="col-sm-6">',
					'<textarea class="input-text" rows="5" style = "resize:none;width:100%" ',
					(state == 0) ? 1 : 'disabled="disabled"', '>',
					content, '</textarea>',
					'</div>',
					'<div class="col-sm-6">',
					'<h5>', 'Edited ', time, '</h5>',
					'<button class="btn btn-primary btn-up">UP</button>',
					'&nbsp;<button class="btn btn-primary btn-down">DOWN</button>',
					'&nbsp;<button class="btn btn-danger btn-delete">Delete</button>',
					(state == 0) ?
							/*'<button class="btn btn-primary">Submit</button>'*/ '' :
					'&nbsp;<button class="btn btn-warning btn-modify" data-toggle="tooltip" data-placement="bottom" title="<?php echo lang('ta_question_explain_modify_question');?>">Modify</button>',
					'</div>',
					'</div>',
					'</div>'
				].join('');
				
				var $list = $("#" + type + "-list");
				$list.append(data);
				var $target = $list.children(".question-item").last();
				$target.find(".btn-up").click(btn_up);
				$target.find(".btn-down").click(btn_down);
				$target.find(".btn-modify").click(btn_modify);
				$target.find(".btn-delete").click(btn_delete);
				
				reset(type);
			};
			
			
			const UP = -1;
			const DOWN = 1;
			var move = function ($target, direction)
			{
				$target = getitem($target);
				if (direction == UP)
				{
					var $prev = $target.prev(".question-item");
					$prev.before($target);
				}
				else
				{
					var $next = $target.next(".question-item");
					$next.after($target);
				}
				reset($target.attr('qtype'));
			};
			
			var set_list = function (data)
			{
				$addList.html('');
				$addModal.find(".add-new").addClass('active');
				var question_list = JSON.parse(data);
				for (var index in question_list)
				{
					var question = Object.create(question_list[index]);
					
					var html = [
						'<div class="row">',
						'<div class="col-sm-6">',
						'<a href="javascript:void(0)" class="list-group-item add-item" qid=',
						question.id, ' state="', question.state, '" time="', question.UPDATE_TIMESTAMP, '">',
						question.content,
						'</a>',
						'</div>',
						'<div class="col-sm-6">',
						'<h5>',
						'Edit Time: ', question.UPDATE_TIMESTAMP,
						'</h5>',
						'</div>',
						'</div>',
						'<br>'
					
					].join('');
					
					$addList.append(html);
					
					$("#" + question.type + "-list .question-item").each(function ()
					{
						if ($(this).attr('qid') == question.id)
						{
							$addList.children(".row").last().find(".add-item").addClass('disabled');
						}
					});
					
				}
				
				$addList.find(".add-item").click(function (e)
				{
					var $target = $(e.target);
					$addModal.find(".add-item.active").removeClass('active');
					$addText.css('display', 'none');
					$target.addClass('active');
				});
				
			};
			
			var search_lock = new Date().getTime();
			var search = function ()
			{
				var type = $addModal.attr('qtype');
				var key = $addModal.find(".add-search").val();
				var search_time = search_lock = new Date().getTime();
				$.ajax
				 ({
					 type: 'GET',
					 url: '/ta/evaluation/manage/evaluation/search_question',
					 data: {
						 type: type,
						 key: key
					 },
					 dataType: 'text',
					 success: function (data)
					 {
						 if (search_time == search_lock)
						 {
							 set_list(data);
						 }
					 },
					 error: function ()
					 {
						 alert('fail!');
					 }
				 });
			};
			
			var btn_modify = function (e)
			{
				if (!confirm("<?php echo lang('ta_question_confirm_modify');?>\n(<?php echo lang('ta_question_explain_modify_question');?>)"))
				{
					return;
				}
				var $target = getitem($(e.target));
				$target.attr('qid', -1);
				$target.find(".input-text").removeAttr('disabled');
				$target.find(".btn-modify").remove();
			};
			
			var btn_delete = function (e)
			{
				if (!confirm("<?php echo lang('ta_question_confirm_delete');?>"))
				{
					return;
				}
				var $target = getitem($(e.target));
				var type = $target.attr('qtype');
				$target.remove();
				reset(type);
			};
			
			var btn_up = function (e)
			{
				move($(e.target), UP);
			};
			
			var btn_down = function (e)
			{
				move($(e.target), DOWN);
			};
			
			<?php foreach ($choice_list as $choice):?>
			<?php /** @var $choice Evaluation_default_obj */ ?>
			generate('choice', <?php echo $choice->id . ', "' .
			                              $choice->content . '", "' .
			                              $choice->UPDATE_TIMESTAMP .
			                              '", ' . $choice->state;?>);
			<?php endforeach;?>
			
			<?php foreach ($blank_list as $blank):?>
			<?php /** @var $blank Evaluation_default_obj */ ?>
			generate('blank', <?php echo $blank->id . ', "' .
			                             $blank->content . '", "' .
			                             $blank->UPDATE_TIMESTAMP .
			                             '", ' . $blank->state;?>);
			<?php endforeach;?>
			
			$("[data-toggle='tooltip']").tooltip();
			
			$(".btn-add").click(function (e)
			{
				$addModal.attr('qtype', $(e.target).attr('qtype'));
				$addList.html('');
				search();
				$addModal.modal('show');
			});
			
			$(".btn-close").click(function (e)
			{
				var $target = $addModal.find(".add-item.active");
				var id = $target.attr('qid');
				var type = $addModal.attr('qtype');
				if (id > 0)
				{
					generate(type, id, $target.html(), $target.attr('time'), $target.attr('state'));
					$addModal.modal('hide');
					return;
				}
				var textarea = $addText.children("textarea")
				var text = textarea.val();
				if (text.length >= <?php echo $ta_evaluation_question_min;?>)
				{
					textarea.val('');
					generate(type, id, text, "now", 0);
					$addModal.modal('hide');
				}
				else
				{
					alert("The question content is too short!");
				}
			});
			
			$addModal.find(".add-search").keyup(function ()
			{
				search();
			});
			
			$addModal.find(".add-new").click(function (e)
			{
				var $target = $(e.target);
				$addModal.find(".add-item.active").removeClass('active');
				$target.addClass('active');
				$addText.css('display', 'inline');
			});
			
			<?php if ($config->state != 0):?>
			$(".btn-up").attr('disabled', 'disabled');
			$(".btn-down").attr('disabled', 'disabled');
			$(".btn-modify").attr('disabled', 'disabled');
			$(".btn-delete").attr('disabled', 'disabled');
			$(".btn-add").attr('disabled', 'disabled');
			$("input").attr('disabled', 'disabled');
			$(".input-text").attr('disabled', 'disabled');
			
			<?php endif;?>
			
			$(".btn-modify-all").click(function (e)
			{
				if (!confirm("<?php echo lang('ta_question_confirm_modify');?>\n(<?php echo lang('ta_question_explain_modify');?>)"))
				{
					return;
				}
				$(e.target).css('display', 'none');
				$(".btn-up").removeAttr('disabled');
				$(".btn-down").removeAttr('disabled');
				$(".btn-modify").removeAttr('disabled');
				$(".btn-delete").removeAttr('disabled');
				$(".btn-add").removeAttr('disabled');
				reset('choice');
				reset('blank');
				$("input").removeAttr('disabled');
				$(".input-text").each(function ()
				{
					//alert(getitem($(this)).find(".btn-modify")[0]);
					if (!getitem($(this)).find(".btn-modify")[0])
					{
						$(this).removeAttr('disabled');
					}
				});
				$(".btn-active").removeAttr('disabled');
				$(".btn-active").html('Set as Active');
				config_id = 0;
			});
			
			$(".btn-delete-all").click(function (e)
			{
				if (!confirm("<?php echo lang('ta_question_confirm_delete');?>"))
				{
					return;
				}
				window.location.href = '/ta/evaluation/manage/evaluation/delete<?php echo '?type=' . $edit_type .
				                                                                          '&id=' . $id;?>';
			});
			
			var submit = function (activeFlag)
			{
				var question = [];
				$(".question-item").each(function ()
				{
					var item =
					{
						'id': $(this).attr('qid'),
						'content': $(this).find('.input-text').val(),
						'type': $(this).attr('qtype')
					};
					question.push(item);
				});
				var data =
				{
					'id': config_id,
					'type': "<?php echo $edit_type;?>",
					'description': $("#description").val(),
					'question': question,
					'addition': $("#addition").val(),
					'active': activeFlag ? "true" : "false"
				};
				//alert(JSON.stringify(data));
				$.ajax
				 ({
					 type: 'POST',
					 url: '/ta/evaluation/manage/evaluation/submit',
					 data: {json: JSON.stringify(data)},
					 dataType: 'text',
					 success: function (data)
					 {
						 if (data == 'success')
						 {
							 window.location.href = '/ta/evaluation/manage/evaluation/edit?type=<?php echo $edit_type;?>';
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
			};
			
			$(".btn-save").click(function (e)
			{
				submit(false);
			});
			
			$(".btn-active").click(function (e)
			{
				submit(true);
			});
			
			$(".btn-lock").click(function (e)
			{
				if (!confirm("<?php echo lang('ta_question_confirm_lock');?>\n(<?php echo lang('ta_question_explain_lock');?>)"))
				{
					return;
				}
				window.location.href = '/ta/evaluation/manage/evaluation/lock<?php echo '?type=' . $edit_type .
				                                                                        '&id=' . $id;?>';
			});
		});
	</script>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>