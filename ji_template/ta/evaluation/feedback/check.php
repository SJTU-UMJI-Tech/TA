<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>
<?php include 'button_event.php'; ?>
	
	<link rel="stylesheet" href="/ji_style/swipebox/swipebox.min.css">

<?php /** @var $feedback Feedback_obj */ ?>
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2><a class="navig"
				       href="<?php echo '/ta/evaluation/' . $type . '/feedback/view/' .
				                        (!isset($state_id) ? '' : $state_id . '/') . $page_id; ?>">View</a>
					>
					<?php echo $feedback->title; ?>
					<?php if ($feedback->is_open() &&
					          ($type == 'manage' || $type == 'student' && $feedback->is_student())
					): ?>
						<button id="close-button" type="button" class="btn btn-warning">Close
						</button>
					<?php endif; ?>
					<div id="return" url="<?php echo '/view'.($type == 'student' ? '' : '/' . $state_id) . '/' .
					                                 $page_id ?>" back="2">
						<a><span class="glyphicon glyphicon-repeat" aria-hidden="true" title="Return"></span></a>
					</div>
				</h2>
				<?php echo 'state: ' . $feedback->state; ?>
				<div class="row">
					<h5 class="col-sm-1"><?php echo lang('ta_main_info'); ?>: </h5>
					<h5 class="col-sm-2 _1"><?php echo $feedback->course->KCDM; ?>
						- <?php echo $type ==
						             'manage' ? $feedback->ta->name_ch : $feedback->ta->name_en; ?></h5>
					<br><br>
					<h5 class="col-sm-1 _1"><?php echo lang('ta_main_state'); ?>: </h5>
					<h5 class="col-sm-3 _1"><?php echo $state; ?></h5>
					<br><br>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $feedback->title; ?></h3>
					</div>
					<div class="panel-body">
						<?php echo $feedback->replys[0]->content; ?>
						<br/><br/>
						<?php echo lang('ta_main_time_submit'); ?>: <h5
								class="submit_time"><?php echo $feedback->CREATE_TIMESTAMP; ?></h5>
					</div>
				</div>
				
				<p><?php echo lang('ta_feedback_communication'); ?>:</p>
				
				<?php if (count($feedback->replys) <= 1): ?>
					<div><?php echo lang('ta_feedback_empty'); ?></div>
				<?php endif; ?>
				
				<?php foreach (array_slice($feedback->replys, 1) as $reply): ?>
					<?php /** @var $reply Feedback_reply_obj */ ?>
					<div class="row coversation">
						<ul class="list-group <?php echo strlen($reply->picture) >
						                                 0 ? 'col-sm-8' : ''; ?>">
							<li class="list-group-item _1"><?php echo $this->Mta_feedback->get_reply_title($reply->state); ?></li>
							<li class="list-group-item">
								<h5><?php echo $reply->content; ?></h5>
								<h5 class="submit_time"><?php echo lang('ta_main_time_reply'); ?>
									: <?php echo $reply->CREATE_TIMESTAMP; ?></h5>
							</li>
						</ul>
						
						<script type="text/javascript">
							function DrawImage(MyPic, W, H)
							{
								var flag = false;
								var image = new Image();
								image.src = MyPic.src;
								if (image.width > 0 && image.height > 0)
								{
									flag = true;
									if (image.width / image.height >= W / H)
									{
										if (image.width > W)
										{
											MyPic.width = W;
											MyPic.height = (image.height * W) / image.width;
										}
										else
										{
											MyPic.width = image.width;
											MyPic.height = image.height;
										}
									}
									else
									{
										if (image.height > H)
										{
											MyPic.height = H;
											MyPic.width = (image.width * H) / image.height;
										}
										else
										{
											MyPic.width = image.width;
											MyPic.height = image.height;
										}
									}
								}
							}
						</script>
						
						
						<?php if (strlen($reply->picture) > 0): ?>
							<a href="<?php echo $reply->picture; ?>" class="col-sm-4 swipebox">
								<img src="<?php echo $reply->picture; ?>" onload="javascript:DrawImage(this,200,120);"
								     width="200" height="120">
							</a>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
				
				<?php if ($feedback->is_open() &&
				          (($feedback->is_student() && $type == 'student') ||
				           (!$feedback->is_manage() && $type == 'manage') ||
				           ($feedback->is_teacher() && $feedback->is_manage() &&
				            $type == 'teacher'))
				): ?>
					<br>
					<p>Reply/Addition:</p>
					<div class="row">
						<div class="col-sm-8">
							<textarea id="input-content" rows="15"
							          style="resize:none;width:100%"></textarea>
						</div>
						<div class="col-sm-4">
							<?php include 'upload.php'; ?>
						</div>
					</div>
					<?php if ($type == 'manage' && $feedback->is_student()): ?>
						<input type="radio" name="request" value="true"/> Direct to teacher
						<br/>
						<input type="radio" name="request" value="false"
						       checked="checked"/> Reject the feedback
					<?php endif; ?>
					<?php if ($type == 'manage' && $feedback->is_teacher()): ?>
						<input type="radio" name="request" value="true"
						       checked="checked"/> Direct to student
						<br/>
						<input type="radio" name="request" value="false"/> Reject the feedback
					<?php endif; ?>
					<br>
					<button id="reply-button" class="btn btn-primary">Submit</button>
				
				<?php endif; ?>
			</div>
		</div>
	</div>
	<script src="/ji_js/swipebox/jquery.swipebox.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function ()
		{
			$(".swipebox").swipebox();
		});
	</script>
<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>