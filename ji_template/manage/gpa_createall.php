<div id="mmain" class="mmain">
	<h2>GPA</h2><a class="maina" href="/manage/gpa"><span>查询GPA</span></a><a class="maina" href="/manage/gpa_createall"><span>批量GPA生成</span></a><a class="maina" href="/manage/gpa_createone"><span>单个GPA生成</span></a>
    <div class="gpa">
        <div class="create">
        <form action="" method="post">
            <select name="student_grade">
              <option<?php if($student_grade=='f10'){echo " selected='selected'";}?> value="f10">F10级</option>
              <option<?php if($student_grade=='f11'){echo " selected='selected'";}?> value="f11">F11级</option>
              <option<?php if($student_grade=='f12'){echo " selected='selected'";}?> value="f12">F12级</option>
              <option<?php if($student_grade=='f13'){echo " selected='selected'";}?> value="f13">F13级</option>
              <option<?php if($student_grade=='f14'){echo " selected='selected'";}?> value="f14">F14级</option>
              <option<?php if($student_grade=='f15'){echo " selected='selected'";}?> value="f15">F15级</option>
            </select>
            <select name="gpa_xn">
              <option<?php if($xn=='0'){echo " selected='selected'";}?> value="0">学年</option>
              <option<?php if($xn=='2010-2011'){echo " selected='selected'";}?> value="2010-2011">2010-2011</option>
              <option<?php if($xn=='2011-2012'){echo " selected='selected'";}?> value="2011-2012">2011-2012</option>
              <option<?php if($xn=='2012-2013'){echo " selected='selected'";}?> value="2012-2013">2012-2013</option>
              <option<?php if($xn=='2013-2014'){echo " selected='selected'";}?> value="2013-2014">2013-2014</option>
              <option<?php if($xn=='2014-2015'){echo " selected='selected'";}?> value="2014-2015">2014-2015</option>
              <option<?php if($xn=='2015-2016'){echo " selected='selected'";}?> value="2015-2016">2015-2016</option>
            </select>
            <select name="gpa_xq">
              <option<?php if($xq=='0'){echo " selected='selected'";}?> value="0">学期</option>
              <option<?php if($xq=='1'){echo " selected='selected'";}?> value="1">1</option>
              <option<?php if($xq=='2'){echo " selected='selected'";}?> value="2">2</option>
            </select>
            <select name="gpa_num">
              <option<?php if($start=='0'){echo " selected='selected'";}?> value="0">第0-500个</option>
              
            </select>
            <input name="submit" type="submit" value="生成" />
        </form>
        </div>
        <?php echo $notice;?>
        <?php echo $updatelog;?>
        <?php echo $addnewlog;?>
    </div>
</div>

</div>

</body>
</html>
