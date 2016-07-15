<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course List</title>
    <script type="text/javascript" src="/ji_js/jquery-app.js"></script>
    <script type="text/javascript" src="/ji_js/prof_app_courselist.js"></script>
    <script type="text/javascript" src="/ji_js/prof_app.js"></script>
    <link href="/ji_style/prof_app.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
<?php
require "prof_app_head.php";
?>
<div class="list">
    <table class="all-content" width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="167px" class="sidebar">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="choose-course">
                    <?php foreach ($class as $class_item): ?>
                        <tr>
                            <td><?php echo ucfirst(strtolower($class_item->KCDM)); ?><img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </td>
            <td class="mainbar">
                <form action="/ta/application/Teacher/setstatus" method="post">
                    <fieldset class="text-container application-status">
                        <legend>Application Status</legend>
                        <div align="center">
                            <h3>Application of <span class="courseid"></span> Teaching Assistant is <span class="status">Close</span>.
                            </h3>
                            <input type="button" align="center" value="" class="submit change">
                            <input id="form_status" type="text" name="status" value="" class="hidden">
                            <input id="form_BSID" type="text" name="BSID" value="" class="hidden">
                            <input type="text" name="choice" value="change" class="hidden">
                        </div>
                    </fieldset>
                    <div class="box" id="change-box">
                        <div class="text">
                            <p class="question">Are you sure to change the status?</p>
                        </div>
                        <table width="80%" align="center">
                            <td width="40%"><input type="submit" align="center" value="Yes" class="submit" id="change-yes"></td>
                            <td width="40%"><input type="button" align="center" value="No" class="submit no"></td>
                        </table>
                    </div>
                </form>
                <form action="/ta/application/Teacher/setcourseinfo" method="post">
                    <fieldset class="text-container course-information">
                        <legend>Course Information</legend>
                        <table width="100%">
                            <td width="100%">
                                <ul>
                                    <li>Course ID: <input class="readonly course_id input_text" value="" size="12" readonly></li>
                                    <li>Course Title: <input class="readonly course_title input_text" value="" size="20" readonly></li>
                                    <li>Professor's Name: <input class="readonly name input_text" value="" size="12" readonly>
                                    </li>
                                    <li>Professor's Email: <input type="text" name="email" class="readonly email input_text" value="" size="20"
                                                                  readonly><img src="/ji_style/images/modify.png"
                                                                                height="25"></li>
                                    <li>Academic Year: <input class="readonly year input_text" value="" size="12"
                                                              readonly="readonly"></li>
                                    <li>Semester: <input class="readonly semester input_text" value="" size="6" readonly></li>
                                    <li>Max TA Number: <input type="text" name="maxta" class="readonly max input_text" value="" size="1" readonly><img
                                            src="/ji_style/images/modify.png" height="25"></li>
                                    <li>Current TA Number: <input class="readonly current input_text" value="" size="1" readonly></li>
                                    <li>Salary: <input type="text" name="salary" class="readonly salary input_text" value="" size="4" readonly><img
                                            src="/ji_style/images/modify.png" height="25"></li>
                                    <input id="form_BSID2" type="text" name="BSID" value="" class="hidden">
                                    <input type="text" name="choice" value="modify" class="hidden">
                                    <li>Description: <img src="/ji_style/images/modify.png" height="25"><br/></li>
                                </ul>
                            </td>
                        </table>
                        <div align="center">
                            <textarea name="description" rows="10" class="readonly description" readonly></textarea>
                        </div>
                        <div class="submit modify" align="center">
                            <p>Submit</p>
                        </div>
                    </fieldset>
                    <div class="box" id="modify-box">
                        <div class="text">
                            <p class="question">Are you sure to submit the modification?</p>
                        </div>
                        <table width="80%" align="center">
                            <td width="40%"><input type="submit" align="center" value="Yes" class="submit" id="modify-yes"></td>
                            <td width="40%"><input type="button" align="center" value="No" class="submit no"></td>
                        </table>
                    </div>
                    <div class="box" id="modify-box2">
                        <div class="text">
                            <p class="question">The modification hasn't be saved yet.<br/>Do you want to save it?</p>
                        </div>
                        <table width="80%" align="center">
                            <td width="40%"><input type="submit" align="center" value="Yes" class="submit" id="modify-yes2"></td>
                            <td width="40%"><input type="button" align="center" value="No" class="submit no" id="modify-no2"></td>
                        </table>
                    </div>
                </form>
            </td>
        </tr>
    </table>
</div>
<div id="bg"></div>
<div id="bg2" class="hidden"></div>
<div class="hidden" id="class_data">
    <?php foreach ($class as $class_item): ?>
        <p id="<?=strtolower($class_item->KCDM)?>" status="<?=$class_item->status?>" KCDM="<?=strtolower($class_item->KCDM)?>" KCZWMC="<?=$class_item->KCZWMC?>" XM="<?=$class_item->XM?>" XQ="<?=$class_item->XQ?>" XN="<?=$class_item->XN?>" KCJJ="<?=$class_item->KCJJ?>" maxta="<?=$class_item->maxta?>" curta="<?=$class_item->curta?>" salary="<?=$class_item->salary?>" email="<?=$class_item->email?>" BSID="<?=$class_item->BSID?>"></p>
    <?php endforeach; ?>
</div>
</body>
</html>