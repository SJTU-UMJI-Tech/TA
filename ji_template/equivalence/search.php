<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!--equivalence university's courses-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UM-SJTU JI</title>
<link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
<link href="/ji_style/equivalence.css" type="text/css" rel="stylesheet" />
<script src="/ji_js/jquery-2.1.4.min.js" language="javascript" type="text/javascript"></script>
</head>

<body id="equivalence-search">
<div class="top">
	<div class="logo"><a href="/equivalence/index"><img src="/ji_style/image/jilogo.png" width="500" height="80" /></a></div>
</div>
<div class="main">
	<div class="title"><h1><a href="/equivalence/index">Course Equivalencies</a></h1><form action="/equivalence/search" method="post"><span id="search">SEARCH</span><input name="search" placeholder="输入任意关键词"  type="text" /></form></div>
    <div class="courses">
    	<div class="descript"><span class="left"><b>搜索'<?=$search;?>'结果</b></span></div>
        <li class="nav" id="nav">
                <div style="clear:both; font-weight:bold;">
                	<span style="width:150px">University</span>
                    <span style="width:100px">Dept.</span>
                    <span style="width:80px">Code</span>
                    <span style="width:230px">Title</span>
                    <span style="width:70px">Credits</span>
                    <span style="width:100px; border-right:1px solid #999">Language</span>
                    <span style="width:80px">&nbsp;&nbsp;Code</span>
                    <span style="width:80px">Category</span>
                    <span style="width:80px">Credits</span>
                    <span style="width:90px" class="right">Expires</span>
                </div>
        </li>
        <div class="list" id="list">
        <?php foreach($courses as $c){
			$university = $this->db->query("SELECT * FROM `equivalence_university` where university_id=".$c->university_id."")->row_array();
		?>
        <li>
                <div style="clear:both">
                    <span style="width:150px">&nbsp;<!--<?php if($c->course_top == 1){echo '↑&nbsp;&nbsp';}?>--><?=$university['university_name']?></span><span style="width:100px">&nbsp;<!--<?php if($c->course_top == 1){echo '↑&nbsp;&nbsp';}?>--><?=$c->course_department?></span><span style="width:80px">&nbsp;<?=$c->course_code?></span><span style="width:230px">&nbsp;<?=$c->course_name?></span><span style="width: 70px">&nbsp;<?=$c->course_credits?></span><span style="width:100px; border-right:1px solid #999">&nbsp;<?=$c->course_language?></span><span style="width:80px; margin-left:5px;"><?=$c->ji_code?>&nbsp;</span><span style="width:80px">&nbsp;<?=$c->ji_category?></span><span style="width:80px">&nbsp;<?=$c->ji_credits?></span><span style="width:90px" class="right">&nbsp;<?=$c->course_endtime?></span>
                </div>
        </li>
        <?php }?>
        </div>
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
<script type="text/javascript">
function menuFixed(id){
    var obj = document.getElementById(id);
    var _getHeight = obj.offsetTop;
    
    window.onscroll = function(){
        changePos(id,_getHeight);
    }
}
function changePos(id,height){
    var obj = document.getElementById(id);
    var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    if(scrollTop < height){
        obj.style.position = 'relative';
    }else{
        obj.style.position = 'fixed';
    }
}
window.onload = function(){
    menuFixed('nav');
}
</script>
</body>
</html>