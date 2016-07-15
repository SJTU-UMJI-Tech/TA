	<div class="logo"><img src="/ji_style/image/jilogo.png" width="500" height="80" /></div>
    <div class="userinfo">
    	<?php if(!$_SESSION['user']){?>
    	<p><span><a href="/jaccount.php">用Jaccount登陆</a></span></p>
        <?php }else{?>
    	<p><span><a href="/jaccount_logout.php">注销</a></span><span title="身份ID"><?=$_SESSION['user'][0]?></span><span title="学院名称"><?=$_SESSION['user'][4]?></span><span title="中文名字"><?=$_SESSION['user'][2]?></span></p>
        <?php }?>
    </div>