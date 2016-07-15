<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Processed Applications</title>
    <script type="text/javascript" src="/ji_js/jquery-app.js"></script>
    <script type="text/javascript" src="/ji_js/prof_app_applications2.js"></script>
    <script type="text/javascript" src="/ji_js/jquery.simple-dtpicker.js"></script>
    <script type="text/javascript" src="/ji_js/prof_app.js"></script>
    <link type="text/css" href="/ji_style/jquery.simple-dtpicker.css" rel="stylesheet"/>
    <link href="/ji_style/prof_app.css" rel="stylesheet" type="text/css" media="all"/>
</head>
<body>
<?php
require "prof_app_head.php";
?>
<div class="apply">
    <table class="all-content" width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="167px" class="sidebar">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="choose-course">
                    <tr>
                        <td class="empty"></td>
                    </tr>
                    <tr>
                        <td>All<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                    </tr>
                    <?php foreach ($class as $class_item): ?>
                        <tr>
                            <td><?php echo ucfirst(strtolower($class_item->KCDM)); ?><img src="/ji_style/images/arrow.png" height="17"
                                                                                     class="hidden"></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="choose-status">
                    <tr>
                        <td class="empty"></td>
                    </tr>
                    <tr>
                        <td>All<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                    </tr>
                    <tr>
                        <td>Pass<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                    </tr>
                    <tr>
                        <td>Interview<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                    </tr>
                    <tr>
                        <td>Reject<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                    </tr>
                </table>
            </td>
            <td class="mainbar">
                <table class="navbar" width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr class="strip">
                        <td width="50%" id="strip-5" class="notspace"></td>
                        <td width="50%" id="strip-6" class="notspace current"></td>
                    </tr>
                    <tr class="button">
                        <td id="button-5" class="notspace"><a href="/ta/application/Teacher/viewunprocessed"><img src="/ji_style/images/unprocessed.png"
                                                                                                    height="15"> Unprocessed</a>
                        </td>
                        <td id="button-6" class="notspace current"><a href="/ta/application/Teacher/viewprocessed"><img src="/ji_style/images/processed.png" height="15">
                            Processed</a></td>
                    </tr>
                </table>
                <?php foreach ($application as $application_item): ?>
                    <form action="/ta/application/Teacher/process" method="post">
                        <input style="display: none" name="id" value="<?=$application_item->id?>">
                        <input style="display: none" name="status" value=0>
                        <div class="text-container">
                            <div class="personal-information">
                                <table width="86%">
                                    <tr>
                                        <td width="43%" colspan="2">Course ID: <span class="info courseid"><?php echo ucfirst($application_item->app_course); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td width="43%" colspan="2">Status: <span class="info status">
                                                <?php
                                                switch ($application_item->status)
                                                {
                                                    case -1:
                                                        echo 'Reject';
                                                        break;
                                                    case 1:
                                                        echo 'Pass';
                                                        break;
                                                    case 2:
                                                        echo 'Interview '.$application_item->interviewtime;
                                                        break;
                                                }
                                                ?></span></td>
                                    </tr>
                                    <tr>
                                        <td width="43%">Name: <span class="info"><?php echo ucwords($application_item->name); ?></span></td>
                                        <td width="43%">Student ID: <span class="info studentid"><?php echo $application_item->student_id; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Gender: <span class="info"><?php echo ucfirst($application_item->gender); ?></span></td>
                                        <td>Email: <span class="info"><?php echo $application_item->email; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td>Faculty: <span class="info"><?php echo ucwords($application_item->faculty); ?></span></td>
                                        <td>Grade: <span class="info"><?php echo ucfirst($application_item->grade); ?></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Application Time: <span class="info"><?php echo $application_item->app_time; ?></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="extra-information">
                                <fieldset class="text-container-2 reject_reason">
                                    <legend>Rejection Reason</legend>
                                    <p><?php echo nl2br($application_item->rejectreason); ?></p>
                                </fieldset>
                                <fieldset class="text-container-2">
                                    <legend>Self-Introduction</legend>
                                    <p><?php echo $application_item->self_introduction; ?></p>
                                </fieldset>
                                <fieldset class="text-container-2">
                                    <legend>Comment</legend>
                                    <p><?php echo $application_item->comment; ?></p>
                                </fieldset>
                            </div>
                            <div class="choices">
                                <table width="72%" align="center">
                                    <td><input type="button" align="center" value="Reprocess" class="submit reprocess"></td>
                                </table>
                            </div>
                            <div align="center">
                                <img src="/ji_style/images/down.png" width="50px" class="up-down">
                            </div>
                        </div>
                        <div class="box" id="reprocess-box">
                            <p>Are you sure to reprocess this application?</p>
                            <table width="80%" align="center">
                                <td width="40%"><input type="submit" align="center" value="Yes" class="submit" id="reprocess-yes"></td>
                                <td width="40%"><input type="button" align="center" value="No" class="submit no"></td>
                            </table>
                        </div>
                    </form>
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

</body>
</html>
