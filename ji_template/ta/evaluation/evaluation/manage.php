<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<script src="/ji_js/datetimepicker/bootstrap-datetimepicker.js"></script>
<script src="/ji_js/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<link rel="stylesheet" type="text/css" href="/ji_style/datetimepicker/bootstrap-datetimepicker.min.css">
<link href="http://cdn.bootcss.com/prettify/r224/prettify.css" rel="stylesheet">

<!-- The main page content is here -->
<div class='body'>
	<div class="maincontent">
		<div class="announcement">
			<h2>Evaluation Setup</h2>
			<a class="btn btn-primary" href="/ta/evaluation/manage/evaluation/edit?type=student">Edit the students'
				questions</a>
			<a class="btn btn-primary" href="/ta/evaluation/manage/evaluation/edit?type=teacher">Edit the teachers'
				questions</a>
			<h4 class="description">Once you set the time of evaluation, the current question set will be locked so that
				you can no longer edit them.</h4>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<h4 class="description"><?php echo lang('ta_evaluation_time_start'); ?></h4>
						<div class="input-group date form_datetime" id="datetime-start">
							<input type="text" class="form-control" size="16" value="" readonly="readonly"
							       aria-describedby="basic-addon1" placeholder="Choose a date">
							<span class="input-group-addon add-on" id="basic-addon1">
									<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
								</span>
						</div>
					</div>
					<div class="form-group">
						<h4 class="description"><?php echo lang('ta_evaluation_time_end'); ?></h4>
						
						<div class="input-group date form_datetime" id="datetime-end">
							<input type="text" class="form-control" size="16" value="" readonly="readonly"
							       aria-describedby="basic-addon1" placeholder="Choose a date">
							<span class="input-group-addon add-on" id="basic-addon1">
									<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
								</span>
						</div>
					</div>
					<a class="btn btn-primary" id="submit-button"><?php echo lang('ta_main_submit'); ?></a>
				</div>
			</div>
			
			<script type="text/javascript">
				$(document).ready(function ()
				{
					$(".form_datetime").datetimepicker({
						<?php if ($_SESSION['language'] == 'zh-cn'): ?>
						language: 'zh-CN',
						<?php endif;?>
						format: "yyyy-mm-dd",
						autoclose: true,
						todayBtn: true,
						todayHighlight: true,
						forceParse: true,
						minView: 'month',
						pickerPosition: "bottom-right"
					});
				});
				$("#datetime-start").children("input").val("<?php echo $ta_evaluation_start?>");
				$("#datetime-end").children("input").val("<?php echo $ta_evaluation_end?>");
				
				$("#submit-button").click(function ()
				{
					if (!confirm('Once you set the time of evaluation, the current question set will be locked so that you can no longer edit them'))
					{
						return;
					}
					var start = $("#datetime-start").children("input").val();
					var end = $("#datetime-end").children("input").val();
					$.ajax
					 ({
						 type: 'GET',
						 url: '/ta/evaluation/manage/evaluation/settime',
						 data: {
							 start: start,
							 end: end
						 },
						 dataType: 'text',
						 success: function (data)
						 {
							 if (data == 'success')
							 {
								 location.reload();
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
			
			</script>
		
		</div>
	</div>
</div>


<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>

