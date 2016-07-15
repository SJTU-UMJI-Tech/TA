<div id="mmain" class="mmain">
<h2>通讯录</h2><a class="maina" href="/manage/contactlist_add"><span>添加通讯录</span></a>
<div class="contactlist">
	<li>
        <div>
            <div style="clear:both; font-weight:bold;">
            	<span style="width:60px">办公室</span><span style="width:90px">中文名</span><span style="width: 140px">英文名</span><span style="width:100px">职称</span><span style="width:100px">直线</span><span style="width:80px">内线</span><span style="width:140px">手机</span><span style="width:50px">小号</span><span style="width:220px">邮箱</span><span style="width:140px">Skype</span><span style="width:80px">Action</span>
            </div>
        </div>
    </li>
    <?php foreach($contactlist as $c):?>
    <li>
        <div>
            <div style="clear:both;">
            	<span style="width:60px"><?=$c->user_room?></span><span style="width:90px"><?=$c->user_name?></span><span style="width: 140px"><?=$c->user_enname?></span><span style="width:100px"><?=$c->user_position?></span><span style="width:100px"><?=$c->user_tel?></span><span style="width:80px"><?=$c->user_subtel?></span><span style="width:140px"><?=$c->user_mobile?></span><span style="width:50px"><?=$c->user_short?></span><span style="width:220px"><?=$c->user_email?></span><span style="width:140px"><?=$c->user_skype?></span><span style="width:80px"><a href="">改</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="">删</a></span>
            </div>
        </div>
    </li>
    <?php endforeach;?>
</div>
</div>

</div>

</body>
</html>
