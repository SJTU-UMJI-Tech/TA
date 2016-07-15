<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Newsletter</title>
<style type="text/css">
body{ width:100%; border:0; margin:0; padding:0; float:left; font-family:Arial, Helvetica, sans-serif; font-size:13px;}
a { text-decoration:none;}
.clear{ clear:both;}
.none { display:none;}
.box { max-width:720px; margin:0 auto;}
.mt10 { margin-top:10px;}.mt20 { margin-top:20px !important;}.mt30{ margin-top:30px;} .pt30 { padding-top:30px;}.mb20{ margin-bottom:20px;}
img { width:100%;}
.readmore { clear:both; width:100%; text-align:right; margin:0; float:left; color:#F60 !important; padding:0;}
.title { width:100%; clear:both; background-color:#002d5f; height:100px;}
.title span{ float:left; margin-left:100px; font-size:26px;  height: 40px;  line-height: 40px;  margin-top: 30px;  border-bottom: 1px solid; color:#fff; font-weight:bold}
.new,.team,.story,.share,.gallery,.au { width:100%; margin:0 auto; clear:both; min-height:160px;}
.new .left { width:450px; margin:5px; float:left;}
.new .right { width:220px; margin:5px; float:right;}
.new .left .name{ font-size:26px; line-height:40px; float:left; width:100%;}
.new .left .content { line-height:24px; color:#666; width:100%; float:left;}

.team .name{ height:50px; line-height:50px; font-size:26px; float:left; border-bottom:1px solid #999; color:000;}
.team ul{ clear:both; margin:0; padding:0; list-style:none;}
.team li { width:130px; float:left; height:160px; text-align:center}
li:hover{ background-color:#FFF4FE; border-radius:5px;}
.team li img { width:90px; height:90px; border-radius:45px;}
.team li span { width:100%; float:left; text-align:center; line-height:30px; font-size:14px; font-weight:bold; color:#333;}
 .team li i { color:#666; width:100%; float:left; text-align:center; line-height:30px; font-style:normal;}

 .story li{ list-style:none; width:100%; min-height:120px; float:left; clear:both;}
 .story li img { width:160px; float:left;}
 .story li p{ width:520px; float:right; padding:0px; margin:0;}
 .story li span { float:left; color:#666; line-height:22px;}
 .story li p i{ width:100%; text-align:right; font-style:normal; float:right; line-height:25px;}
 .story li strong{ font-weight:normal; font-size:22px; line-height:40px; color:#333}
 .share li{ width:200px; float:left; list-style:none; margin:20px; min-height:200px;}
 .share li img{ width:100%; height:140px;}
 .share li h3 { color:#333}
 .share li p{ margin:0; padding:0; line-height:25px; color:#666}
 .gallery li{ list-style:none;}
 .gallery img{ width:350px; float:left;}
 .gallery p{ width:350px; float:right; line-height:25px;}
 .gallery span{ float:right; line-height:40px; margin-right:20px;}
 .au { background-color:#eee; float:left;}
 .au .left{ width:340px; float:right;}
 .au .left li{list-style:none; margin:10px; line-height:25px;}
 .au .left p{color:#666; text-align:right;}
 .au .right{ width:360px; float:left;}
 .au h2 { font-size: 26px;  font-weight: normal;  text-indent: 10px;}
</style>
</head>

<body>
<div class="box">
	<div class="img"><img src="/ji_upload/newsletter/1224-01.jpg" /></div>
    <div class="title"><span>What's New</span></div>
    <div class="img"><a href="/newsletter/view/148"><img width="720" src="/ji_upload/page/page20151231133825.jpg" /></a></div>
    <?php foreach($new as $n){?>
    <div class="new pt30">
    	<div class="left">
        	<div class="name"><?=$n->page_title?></div>
            <div class="content"><?=$n->page_summary?></div>
            <a href="/newsletter/view/<?=$n->id?>"><span class="readmore">Read More</span></a>
        </div>
        <div class="right"><img src="/ji_upload/page/<?=$n->page_pic?>" /></div>
    </div>
    <?php }?>
    
    <div class="team none">
        <div class="name mt30 mb20">Our Team</div>
        <ul>
        <a href="#"><li><img src="/ji_upload/newsletter/1224-01.jpg" /><span>Dengpan Huang</span><i>IT Engneer</i></li></a>
        <a href="#"><li><img src="/ji_upload/newsletter/1224-01.jpg" /><span>Dengpan Huang</span><i>IT Engneer</i></li></a>
        <a href="#"><li><img src="/ji_upload/newsletter/1224-01.jpg" /><span>Dengpan Huang</span><i>IT Engneer</i></li></a>
        <a href="#"><li><img src="/ji_upload/newsletter/1224-01.jpg" /><span>Dengpan Huang</span><i>IT Engneer</i></li></a>
        </ul>
    </div> 
<div class="clear"></div>
</div>
<div class="box">
    <div class="au mt20">
    	<div class="left">
    		<h2>Announcement</h2>
        	<li><h3><?=$announcement['page_title']?></h3><span><?=$announcement['page_summary']?></span><a href="/newsletter/view/<?=$announcement['id']?>"><p class="readmore">Read More</p></a></li>
           <h2><?=$event['page_title']?></h2>
           	<li><span><?=$event['page_content']?></span></li>
        </div>
        <div class="right"><img src="/ji_upload/page/<?=$announcement['page_pic']?>" /></div>
    </div>
<div class="clear"></div>
</div>

<div class="box">
	<div class="title"><span>JI Stories</span></div>
    <div class="story pt30">
    <?php foreach($story as $s){?>
    	<li class="mb20"><img src="/ji_upload/page/<?=$s->page_pic?>" /><p><strong><?=$s->page_title?></strong><span><?=$s->page_summary?></span><i><?=$s->page_keywords?></i><a href="/newsletter/view/<?=$s->id?>"><span class="readmore">Read More</span></a></p></li>
    <?php }?>
        
    </div>
<div class="clear"></div>  
</div>
<div class="box">
	<div class="title mt10"><span>Have Your Say</span></div>
    <div class="img"><a href="/newsletter/view/155"><img width="720" src="/ji_upload/page/page20151231133611.jpg" /></a></div>
</div>
<div class="box">
	<div class="title"><span>Share Your JI</span></div>
    <div class="share">
    <?php foreach($share as $s){?>
    	<li><img src="/ji_upload/page/<?=$s->page_pic?>" /><h3><?=$s->page_title?></h3><p><?=$s->page_summary?></p><a href="/newsletter/view/<?=$s->id?>"><span class="readmore">Read More</span></a></li>
   	<?php }?>
    </div>
<div class="clear"></div>  
</div>
<div class="box">
	<div class="title"><span>Photo Gallery</span></div>
    <div class="gallery">
    <?php foreach($gallery as $g){?>
    	<li><img src="/ji_upload/page/<?=$g->page_pic?>" /><p><?=$g->page_summary?><a href="/newsletter/view/<?=$g->id?>"><span class="readmore">Read More</span></a></p>
        <P><STRONG style="font-size:22px; font-weight:normal; line-height:40px;">Submit a news story</STRONG><BR />
If you have an idea for a news story that you would like to submit to JI E-newsletter, please email:<br /> <a href="mailto:ji-newsletter@sjtu.edu.cn">ji-newsletter@sjtu.edu.cn</a> .<BR />
You may send us the story, your contact details and any photos or videos to accompany the story. 
Thank you. <BR />
JI Communications Office</P>
        </li>
   	<?php }?>
    </div>
<div class="clear"></div>  
</div>
</body>
</html>