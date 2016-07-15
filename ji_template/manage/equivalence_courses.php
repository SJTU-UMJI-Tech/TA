<div class="page courses">
	<li>
        <div>
            <div style="clear:both; font-weight:bold;">
            	<span style="width:100px">Dept.</span><span style="width:100px">Code</span><span style="width:350px">Title</span><span style="width: 80px">Credits</span><span style="width:120px; border-right:1px solid #999">Language</span><span style="width:100px">&nbsp;&nbsp;Catalog</span><span style="width:100px">JI Subject</span><span style="width:80px">Credits</span><span style="width:100px">Effective</span><span style="width:100px">Expires</span><span style="width:50px">Action</span>
            </div>
        </div>
    </li>
	<?php foreach($courses as $c){?>
    <li>
        <div>
            <div style="clear:both">
            	<span style="width:100px"><?php if($c->course_top == 1){echo '↑&nbsp;&nbsp';}?><?=$c->course_department?></span><span style="width:100px"><?=$c->course_code?></span><span style="width:350px"><?=$c->course_name?></span><span style="width: 80px"><?=$c->course_credits?></span><span style="width:120px; border-right:1px solid #999"><?=$c->course_language?></span><span style="width:100px">&nbsp;&nbsp;<?=$c->ji_code?></span><span style="width:100px"><?=$c->ji_category?></span><span style="width:80px"><?=$c->ji_credits?></span><span style="width:100px"><?=$c->course_starttime?></span><span style="width:100px"><?=$c->course_endtime?></span>
                <span style="width:50px">
                <a href="/manage/equivalence/course/edit/<?=$c->course_id;?>" target="_self" style="color:#09C">改</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if($c->course_status==1){?>
                <a onclick="return confirm('关闭该课程转学分？')" href="/manage/equivalence/course/close/<?=$c->course_id;?>" target="_self" title="当前状态：可转学分" style="color:#09C">关</a>
                <?php }else{?>
                <a onclick="return confirm('开启该课程转学分？')" href="/manage/equivalence/course/open/<?=$c->course_id;?>" target="_self" title="当前状态：不可转学分" style="color:#f00">开</a>
                <?php }?>
                </span>
            </div>
        </div>
    </li>
    <?php }?>
</div>
</div>

</div>

</body>
</html>
