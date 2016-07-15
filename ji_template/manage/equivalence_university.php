<div class="page">
<?php foreach($universities as $u){?>
    <li>
        <div>
            <div style="clear:both">
            <a href="/manage/equivalence/university/course/<?=$u->university_id;?>" title="" <?php if($u->university_status==0){?>style="color:#ff0000"<?php }?> class="title"><?php if($u->university_top ==1){echo '↑&nbsp;&nbsp;';}?><?=$u->university_name;?></a>
            <a class="act" href="/manage/equivalence/university/edit/<?=$u->university_id;?>"><span>编辑</span></a>
            <?php if($u->university_status==1){?><a class="act" href="/manage/equivalence/university/disable/<?=$u->university_id;?>" target="_self" style="color:#060" onclick="return confirm('是否确认关闭该大学转学分？关闭后用户无法查看到该学校的相关信息，但是仍旧存在于数据库中！')"><span>已开启</span></a><?php }elseif($u->university_status==0){?><a class="act" style="color:#ff0000" href="/manage/equivalence/university/enable/<?=$u->university_id;?>" target="_self" onclick="return confirm('是否确认开启该大学转学分？')"><span>已关闭</span></a><?php }?><a class="act"><span><?=$u->university_country;?> - <?=$u->university_city;?></span></a>
            </div>
            
        </div>
    </li>
<?php }?>
</div>
</div>

</div>

</body>
</html>
