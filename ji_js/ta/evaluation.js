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
		var pos = [], temp = 0;
		var back = Number($("#return").attr('back'));
		if (!back)
		{
			back = 0;
		}
		var url = window.location.href.replace("http://", "").replace("https://", "");
		temp = url.indexOf('?');
		if (temp > 0)
		{
			url = url.substr(0, temp);
		}
		if (url[url.length - 1] == "/")
		{
			url = url.substr(0, url.length - 1);
		}
		temp = 0;
		do
		{
			pos.push(temp);
			temp = url.indexOf('/', temp + 1);
		}
		while (temp >= 0);
		pos.push(url.length);
		var len = pos.length;
		if (len > 1)
		{
			if (len > back + 2)
			{
				url = url.substr(pos[1], pos[len - back - 1] - pos[1]);
			}
			else
			{
				url = "/";
			}
			var par = $("#return").attr('url');
			if (par)
			{
				url += par;
			}
			window.location.href = url;
		}
	});
	var screen_width = window.screen.width;
	$("body").css('width', 'screen.width');
});