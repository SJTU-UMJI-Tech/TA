		<div style="    line-height: 40px;    color: #DA1F34;">Courses can only be transferred for those who enrolled BEFORE (not including) the expiry date or semester. </div>
		<?php foreach($courses as $c){?>
        <li>
            <div style="clear:both">
            	<span style="width:100px" title="<?=$c->course_id?>"><!--<?php if($c->course_top == 1){echo '↑&nbsp;&nbsp';}?>--><?=$c->course_department?>&nbsp;</span><span style="width:120px"><?=$c->course_code?></span><span style="width:120px"><?=$c->course_name?>&nbsp;</span><span style="width: 60px"><?php if($c->course_credits!=0){echo $c->course_credits;}?>&nbsp;</span><span style="width:100px; border-right:1px solid #999"><?=$c->course_language?>&nbsp;</span><span style="width:200px; margin-left:5px;" title="<?=$c->ji_code?>"><?=$c->ji_category?>&nbsp;<br /><?=$c->ji_remarks?></span><span style="width:80px">&nbsp;<?=$c->ji_code?>&nbsp;</span><span style="width:60px"><?php if($c->ji_credits!=0){echo $c->ji_credits;}?>&nbsp;</span><span style="width:120px"><?=$c->course_starttime?>&nbsp;</span><span style="width:100px" class="right p"><p>Courses can only be transferred for those who enrolled BEFORE (not including) the expiry date or semester. </p><?=$c->course_endtime?>&nbsp;</span>
        	</div>
        </li>
        <?php }?>
		