<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>
	<style>
		.text-match { background-color: #ffff00; }
	</style>

	<script type="text/javascript">
		$(document).ready(function ()
		{
			var search_item = 'course';
			var search_lock = new Date().getTime();
			var lang_check = '<?php echo lang('ta_main_check');?>';

			$(document).keydown(function (e)
			{
				var event = document.all ? window.event : e;
				if (event.keyCode == 13)
				{
					$(".btn.btn-info").click();
				}
			});

			$.extend(
					{
						key_to_reg: function (key)
						{
							var keys = key.split(' ');
							var index = 0;
							while (index < keys.length)
							{
								if (keys[index] == '')
								{
									keys.splice(index, 1);
								}
								else
								{
									index++;
								}
							}
							if (keys.length == 0)
							{
								return new RegExp('/[]/gi');
							}
							return new RegExp('(' + keys.join('|') + ')', 'gi');
						},

						course_append: function (data, key)
						{
							var course_list = JSON.parse(data);
							$(".search_content_course.list_container").html('');
							for (var index in course_list)
							{
								var course = Object.create(course_list[index]);
								for (var index2 in course)
								{
									if (course[index2] != null)
									{
										course[index2] = course[index2].toString()
										                               .replace($.key_to_reg(key), '<span class="text-match">$1</span>');
									}
								}
								var href = '/ta/evaluation/manage/search/course/' +
								           course_list[index].BSID;
								var html = [
									'<h5 class="col-sm-1 sub xnxq"><a href="', href, '">',
									course.XN, ': ', course.XQ_JI, '</a></h5>',
									'<h5 class="col-sm-4 sub kczwmc"><a href="', href, '">',
									course.KCZWMC, '</a></h5>',
									'<h5 class="col-sm-1 sub kcdm"><a href="', href, '">',
									course.KCDM, '</a></h5>',
									'<h5 class="col-sm-2 sub xm"><a href="', href, '">',
									course.XM, '</a></h5>',
									'<h5 class="col-sm-1 sub xkzj"><a href="', href,
									'#ta-list">', lang_check, '</a></h5>',
									'<h5 class="col-sm-1 sub xkxs"><a href="', href,
									'#student-list">', lang_check, '</a></h5>',
									'<br /><br class="end_label_search" />'
								].join('');
								$(".search_content_course.list_container").append(html);
							}
						},
						ta_append: function (data, key)
						{
							var ta_list = JSON.parse(data);
							$(".search_content_ta.list_container").html('');
							for (var index in ta_list)
							{
								var ta = Object.create(ta_list[index]);
								for (var index2 in ta)
								{
									if (ta[index2] != null)
									{
										ta[index2] = ta[index2].toString()
										                       .replace($.key_to_reg(key), '<span class="text-match">$1</span>');
									}
								}
								var href = '/ta/evaluation/manage/search/ta/' + ta_list[index].USER_ID;
								var html = [
									'<h5 class="col-sm-2 sub user_id"><a href="', href, '">',
									ta.USER_ID, '</a></h5>',
									'<h5 class="col-sm-1 sub"><a href="', href, '">',
									ta.name_ch, '</a></h5>',
									'<h5 class="col-sm-1 sub"><a href="', href, '">',
									ta.name_en, '</a></h5>',
									'<h5 class="col-sm-2 sub"><a href="', href, '">',
									ta.phone, '</a></h5>',
									'<h5 class="col-sm-2 sub"><a href="', href, '">',
									ta.email, '</a></h5>',
									'<h5 class="col-sm-1 sub"><a href="', href,
									'#course-list">', lang_check, '</a></h5>',
									'<h5 class="col-sm-1 sub"><a href="', href,
									'#report-list">', lang_check, '</a></h5>',
                                    '<br /><br class="end_label_search" />'
								].join('');
								$(".search_content_ta.list_container").append(html);
							}
						},
						ajax_search: function (item, page_id, callback)
						{
							var key = $("#search").val();
							var search_time = search_lock = new Date().getTime();
							$.ajax
							 ({
								 type: 'GET',
								 url: '/ta/evaluation/manage/search/view/',
								 data: {
									 item: item,
									 key: key,
									 page_id: page_id
								 },
								 dataType: 'text',
								 success: function (data)
								 {
									 if (search_time == search_lock)
									 {
										 callback(data, key);
									 }
								 },
								 error: function ()
								 {
									 alert('fail!');
								 }
							 });
						}
					}
			);
			$("#search").keyup(function ()
			{
				//alert($("#search").val());
				if (search_item == 'course')
				{
					$.ajax_search('course', 1, $.course_append);
				}
				else if (search_item == 'ta')
				{
					$.ajax_search('ta', 1, $.ta_append);
				}
			});
			$("#course_search").click(function ()
			{
				$("#search_object").text($("#course_search").text());
				$("#search").val('');
				$("#course_search").hide();
				$("#ta_search").show();
				$("#search_content_display_ta").hide();
				$("#search_content_display_course").show();
				$.ajax_search('course', 1, $.course_append);
				search_item = 'course';
			});
			$("#ta_search").click(function ()
			{
				$("#search_object").text($("#ta_search").text());
				$("#search").val('');
				$("#ta_search").hide();
				$("#course_search").show();
				$("#search_content_display_course").hide();
				$("#search_content_display_ta").show();
				$.ajax_search('ta', 1, $.ta_append);
				search_item = 'ta';
			});
			$("#search_object").text($("#course_search").text());
			$("#course_search").hide();
			$("#search_content_display_course").show();
			$.ajax_search('course', 1, $.course_append);
			search_item = 'course';
		});
	
	</script>
	
	
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2 id="title"><?php echo lang('ta_main_search'); ?></h2>
				<div class="dropdown">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
					        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<span id="search_object"></span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
						<li id="course_search"><a href="javascript:void(0)"><?php echo lang('ta_main_course'); ?></a>
						</li>
						<li id="ta_search"><a href="javascript:void(0)"><?php echo lang('ta_main_ta'); ?></a></li>
					</ul>
				</div>
				<br/>
				<div class="row head">
					<div class="col-lg-12">
						<div class="input-group">
							<input type="text" class="form-control" id="search"
							       placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-info" id="enter" type="submit">
	                                <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
						</div>
					</div>
				</div>
				
				<!--                Course Search-->
				<div id="search_content_display_course" style="display: none;">
					<div class="row search_course">
						<h5 class="col-sm-1"><?php echo lang('ta_main_year') . '：' . lang('ta_main_term'); ?></h5>
						<h5 class="col-sm-4"><?php echo lang('ta_main_course_name'); ?></h5>
						<h5 class="col-sm-1"><?php echo lang('ta_main_course_code'); ?></h5>
						<h5 class="col-sm-2"><?php echo lang('ta_main_teacher'); ?></h5>
						<h5 class="col-sm-1"><?php echo lang('ta_main_ta_list'); ?></h5>
						<h5 class="col-sm-1"><?php echo lang('ta_main_student_list'); ?></h5>
					</div>
					<div class="search_content_course list_container">

					</div>
				</div>
				
				<!--                TA Search-->
				<div id="search_content_display_ta" style="display: none;">
					<div class="row search_ta">
						<h5 class="col-sm-2"><?php echo lang('ta_main_student_id'); ?></h5>
						<h5 class="col-sm-1"><?php echo lang('ta_main_name'); ?></h5>
						<h5 class="col-sm-1"><?php echo lang('ta_main_name_en'); ?></h5>
						<h5 class="col-sm-2"><?php echo lang('ta_main_contact'); ?></h5>
						<h5 class="col-sm-2"><?php echo lang('ta_main_email'); ?></h5>
						<h5 class="col-sm-1"><?php echo lang('ta_main_course_list'); ?></h5>
						<h5 class="col-sm-1"><?php echo lang('ta_main_report_list'); ?></h5>
					</div>
					<div class="search_content_ta list_container">

					</div>
				</div>
			
			</div>
		</div>
	</div>


<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>