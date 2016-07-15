<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>My Application</title>
	<link href="/ji_style/stu_app_common.css" type="text/css" rel="stylesheet" />
	<link href="/ji_style/stu_app_showmyapp.css" type="text/css" rel="stylesheet" />
	<script src="/ji_js/jquery-app.js"></script>
	<script src="/ji_js/stu_app_showmyapp.js"></script>
	<script src="/ji_js/stu_app_common.js"></script>
</head>
<body>
<?php
require 'stu_app_head.php';
?>
<div class="apply">
    <table class="all-content" width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="182px" class="sidebar">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="choose-course">
                    <tr>
                        <td>All<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                    </tr>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="choose-status">
                    <tr>
                        <td class="empty"></td>
                    </tr>
                    <tr>
                        <td>All<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                    </tr>
                    <tr>
                        <td>Decided<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                    </tr>
                    <tr>
                        <td>Undecided<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                    </tr>
                </table>
            </td>
            <td class="mainbar">
                <?php foreach ($list as $item): ?>
                    <div class="text-container">
                    <div class="personal-information">
                        <table width="88%">
							<tr>
								<td width="44%" colspan="2">Course ID: <span class="info courseid"><?php echo ucfirst($item->app_course); ?></span></td>
							</tr>
                            <tr>
                                <td width="44%" colspan="2">Status: <span class="info status">
                                        <?php
                                        switch ($item->status)
                                        {
                                            case -1:
                                                echo 'Reject';
                                                break;
											case 0:
												echo 'Undecided';
												break;
                                            case 1:
                                                echo 'Pass';
                                                break;
                                            case 2:
                                                echo 'Interview '.$item->interviewtime;
                                                break;
                                        }
                                        ?></span></td>
                            </tr>
                            <tr>
                                <td width="39%">Name: <span class="info"><?php echo ucwords($item->name); ?></span></td>
                                <td width="49%">Student ID: <span class="info studentid"><?php echo $item->student_id; ?></span></td>
                            </tr>
                            <tr>
                                <td>Gender: <span class="info"><?php echo ucfirst($item->gender); ?></span></td>
                                <td>Email: <span class="info"><?php echo $item->email; ?></span></td>
                            </tr>
                            <tr>
                                <td>Faculty: <span class="info"><?php echo ucwords($item->faculty); ?></span></td>
                                <td>Grade: <span class="info"><?php echo ucfirst($item->grade); ?></span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="extra-information">
                        <fieldset class="text-container-2 reject_reason">
                            <legend>Rejection Reason</legend>
                            <p><?php echo nl2br($item->rejectreason); ?></p>
                        </fieldset>
                        <fieldset class="text-container-2">
                            <legend>Self-Introduction</legend>
                            <p><?php echo $item->self_introduction; ?></p>
                        </fieldset>
                        <fieldset class="text-container-2">
                            <legend>Comment</legend>
                            <p><?php echo $item->comment; ?></p>
                        </fieldset>
                    </div>
                    <div class="choices">
                        <table width="72%" align="center">
                            <td><input type="submit" align="center" value="Delete" class="submit reprocess"></td>
                        </table>
                    </div>
                    <div align="center">
                        <img src="/ji_style/images/down.png" width="50px" class="up-down">
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="hidden isEmpty">
                    <div class="personal-information">
                        <table width="86%">
                            <tr>
                                <td width="43%" colspan="2" align="center">No Application</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
<div id="bg"></div>
<div class="box" id="reprocess-box">
    <p>Are you sure to delete this application?</p>
    <table width="80%" align="center">
        <td width="40%"><input type="submit" name="delete" align="center" value="Yes" class="submit" id="reprocess-yes" onclick="location='/ApplyTA/deleteapp?app_course=<?=$item->app_course?>&&id=<?=$item->student_id?>'"></td>
        <td width="40%"><input type="submit" align="center" value="No" class="submit no"></td>
    </table>
</div>
</body>
</html>
