<script type="text/javascript">
	$(document).ready(function ()
	{
		$("#reply-button").click(function ()
		{
			var flag = $("input[name='request']:checked").val();
			var data = new FormData();
			data.append('id', <?php echo $feedback->id;?>);
			data.append('content', $("#input-content").val());
			data.append('picture', $("#avatar-view-img").attr('src'));
			data.append('change_flag', flag);
			$.ajax
			 ({
				 type: 'POST',
				 url: '/ta/evaluation/<?php echo $type;?>/feedback/reply/',
				 data: data,
				 dataType: 'text',
				 processData: false,
				 contentType: false,
				 beforeSend: function ()
				 {
					 $(".loading").fadeIn();
				 },
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
				 },
				 complete: function ()
				 {
					 $(".loading").fadeOut();
				 }
			 });
		});

		$("#close-button").click(function ()
		{
			if (confirm("<?php echo lang('ta_feedback_confirm_close');?>") == true)
			{
				$.ajax
				 ({
					 type: 'GET',
					 url: '/ta/evaluation/<?php echo $type;?>/feedback/close/',
					 data: {
						 id: <?php echo $feedback->id;?>
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
			}
		});
	});
</script>
