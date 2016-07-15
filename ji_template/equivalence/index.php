<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!--equivalence index-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Course Equivalencies - UM-SJTU JI</title>
<link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
<link href="/ji_style/equivalence.css" type="text/css" rel="stylesheet" />
<script src="/ji_js/jquery-2.1.4.min.js" language="javascript" type="text/javascript"></script>
</head>

<body id="equivalence-index">
<div class="top">
	<?php include_once('top.php');?>
</div>
<div class="main">
	<div class="title"><h1>Course Equivalencies</h1><form action="/equivalence/search" method="post"><span id="search">SEARCH</span><input name="search" placeholder="输入任意关键词"  type="text" /></form></div>
    <div class="universities">
    	<li class="descript"><span class="left">University Name</span><span class="right">Country / City</span></li>
    <?php foreach($universities as $u):?>
    	<a href="/equivalence/university/index/<?=$u->university_id;?>"><li><span class="left"><?php if($u->university_top==1){?><img style="top:3px; position:relative;" src="/ji_style/image/top.gif" /><?php }?><?=$u->university_name;?></span><span class="right"><?=$u->university_country;?> / <?=$u->university_city;?></span></li></a>
    <?php endforeach;?>
    </div>
</div>
<div class="h20 clear"></div>
<?php include("footer.php");?>
<script type="text/javascript">

$(document).ready(
	function(){
		$('#search').click(function(){
			$('form').submit();
			});
	}
);

</script>
</body>
</html>