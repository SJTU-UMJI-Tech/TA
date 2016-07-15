<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript" src="/ji_js/jquery-1.8.3.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$page['page_title']?></title>
<style type="text/css">
body{ width:100%; border:0; margin:0; padding:0; float:left; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-family:}
a{ text-decoration:none;}
.mt10 { margin-top:10px;}.mt20 { margin-top:20px;}.mt30{ margin-top:30px;} .pt30 { padding-top:30px;}.mb20{ margin-bottom:20px;}.clear{ clear:both;}
.box { max-width:720px; margin:0 auto;}
.content p{ line-height:25px;}
.content img {margin-right:20px; margin-bottom:20px;}
.comment{ width:100%; clear:both;}
.comment h2{ line-height:50px; height:50px; width:100%; float:left; background-color:#002d5f; color:#fff; text-indent:20px;}
.comment li{ list-style:none; width:100%; float:left; min-height:40px; line-height:30px; border-bottom:1px dashed #CCC; padding:10px 0;}
.comment li span.name { width:100px; float:left; height:40px; line-height:40px; background-color:#F90; color:#fff; text-align:center;}
.comment li span.content{ float:left; max-width:560px; margin-left:30px; line-height:40px;}
.comment form{ width:100%; margin-bottom:40px; float:left; margin-top:40px;}
.comment textarea { width:500px; height:100px; float:left;}
.comment input[type='submit'] { width:200px; height:100px; line-height:100px; float:right; background-color:#E8A72F; color:#fff; cursor:pointer; border:0; font-size:40px;}
.comment .login{ width:200px; height:50px; line-height:50px; text-align:center; background-color:#E8A72F; float:left; cursor:pointer; color:#fff; font-size:22px;}
.back { height:50px; line-height:70px;}
.FP_pic img{ width:100%;}
</style>
</head>

<body>
<div class="box">
	<div class="head mb20"><a href="/newsletter/issue/<?=$page['page_stage']?>"><img src="/ji_upload/newsletter/heading1224.jpg" /></a></div>
<div class="clear"></div>
</div>
<div class="box">
	<div class="content"><?=$page['page_content']?></div>
 	<div class="back"><a href="/newsletter/issue/<?=$page['page_stage']?>"><span>Back to Home</span></a></div>
<div class="clear"></div>
</div>

<div class="box">
	<div class="comment">
    <h2>Comments</h2>
    <?php foreach($comments as $c){?>
    <li><span class="name">anonymous</span><span class="content"><?=$c->comment_content?></span></li>
    <?php }?>
    <?php if(isset($_SESSION['jaccount']) && $_SESSION['jaccount']['student']=='no'){?>
    <form action="/comment/submit" method="post">
    	<textarea name="content" cols="" rows=""></textarea>
        <input name="model" type="hidden" value="newsletter" />
        <input name="model_id" type="hidden" value="<?=$page['id']?>" />
        <input name="submit" type="submit" value="Submit" />
    </form>
    <?php }else{?>
    <a href="/jaccount.php"><span class="login">Jaccount Login</span></a>
    <?php }?>
    
    </div>
<div class="clear"></div>
</div>

<script type="text/javascript">
var src = document.getElementById("embed").src;
var width = document.getElementById("embed").width;
var height = document.getElementById("embed").height;
$("#video").replaceWith('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="'+width+'" height="'+height+'"><param name="movie" value="/Flvplayer.swf"><param name="quality" value="high"><param name="allowFullScreen" value="true"><param name="FlashVars" value="vcastr_file='+src+'&amp;LogoText=UMJISJTU&amp;AutoStart=true"><embed src="/Flvplayer.swf" allowfullscreen="true" flashvars="vcastr_file='+src+'&amp;LogoText=UMJISJTU&amp;AutoStart=true" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="'+width+'" height="'+height+'"></object>');
</script>
</body>
</html>