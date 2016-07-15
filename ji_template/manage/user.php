
<div id="mmain" class="mmain">
<h2>用户管理</h2><a class="maina" href="/manage/user_password"><span>密码修改</span></a>
<div class="page">
<?php foreach($users as $u){?>
    <li>
        <div class="user">
            <div style="clear:both">
            <a href="#" target="_blank" title="" class="title"><?=$u->user_name;?></a>
            <span class="permission">
            <?php 
			$permission = $this->db->query("select * from ji_user_permission where user_id='".$u->user_id."'")->result();
			foreach ($permission as $p){
			?>
            <small><?=$p->module_name;?></small>
            <?php }?>
            </span>
            <a class="act" href="/manage/user/password/<?=$u->user_id;?>" target="_self"><span>修改密码</span></a><?php if($u->user_status==1){?><a class="act" href="/manage/user/disable/<?=$u->user_id;?>" target="_self" style="color:#060" onclick="return confirm('是否确认禁用该账户？该账户被禁用后会无法登录系统，但是仍旧存在于数据库中，可找回，需联系管理员！')"><span>已启用</span></a><?php }elseif($u->user_status==0){?><a class="act" style="color:#ff0000" href="/manage/user/enable/<?=$u->user_id;?>" target="_self" onclick="return confirm('是否确认启用该账户？')"><span>已禁用</span></a><?php }?>
            </div>
            
        </div>
    </li>
<?php }?>
</div>
</div>

</div>

</body>
</html>
