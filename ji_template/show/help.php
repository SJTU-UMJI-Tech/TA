
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$help['page_title']?> - HELP</title>
<link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
<link href="/ji_style/home.css" type="text/css" rel="stylesheet" />
</head>

<body id="home">
<div class="top">
	<div class="logo"><a href="/"><img src="/ji_style/image/jilogo.png" width="500" height="80" /></a></div>
</div>
<div class="main">
	<div class="content">
    	<h1 style="text-align:center; font-size:16px; line-height:50px;"><?=$help['page_title']?><?php if($_SESSION['user']==master){?><span style=" float:right;">(<a href="/manage/page_edit/<?=$help['id']?>">编辑</a>)</span><?php }?></h1>
    	<?=$help['page_content']?>
    </div>
</div>
<div class="bottom"><span>Address: 800 Dong Chuan Road,Shanghai, 200240, China</span><span><a href="http://umji.sjtu.edu.cn" target="_blank">© 2015 University of Michigan – Shanghai Jiao Tong University Joint Institute</a></span></div>
</body>
</html>