$(document).ready(function ()
{
	$(function ()
	{
		$(window).scroll(function ()
		{
			if ($(window).scrollTop() > 100)
			{
				$("#To_Top").fadeIn(300);
			}
			else
			{
				$("#To_Top").fadeOut(300);
			}
		});
		$("#To_Top").click(function ()
		{
			$('body,html').animate({scrollTop: 0}, 200);
		});
	});
	$("#return").click(function ()
	{
		window.location.href = document.referrer;
	});
    var screen_width = window.screen.width;
	$("body").css('width', 'screen.width');
});