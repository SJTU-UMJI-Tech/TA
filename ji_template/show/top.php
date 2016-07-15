
    <div class="logo"><a href="/"><img src="/ji_style/image/jilogo.png" width="500" height="80" /></a></div>
    <div class="userinfo">
    	<?php if(!$_SESSION['jaccount']){?>
    	<p><span><a href="/jaccount.php">用Jaccount登陆</a></span></p>
        <?php }else{?>
    	<p>
		<?php if(in_array($_SESSION['jaccount']['id'],array(master,'22000','60366','61539','61125','61413'))){?><span><a href="/manage/home">后台管理</a></span><?php }?>
        <span><a href="/jaccount_logout.php">注销</a></span><span title="身份ID"><?=$_SESSION['jaccount']['id']?></span><span title="学院名称"><?=$_SESSION['jaccount']['dept']?></span><span title="中文名字"><?=$_SESSION['jaccount']['chinesename']?></span></p>
        <?php }?>
    </div>
    <div style="display:none;"><?=tongji?></div>