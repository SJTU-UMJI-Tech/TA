<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Service</title>
    <link href="/ji_style/stu_app_common.css" type="text/css" rel="stylesheet"/>
    <link href="/ji_style/stu_app_service.css" type="text/css" rel="stylesheet"/>
    <script src="/ji_js/jquery-app.js"></script>
    <script src="/ji_js/stu_app_service.js"></script>
    <script src="/ji_js/stu_app_common.js"></script>
</head>
<body>
<?php
require 'stu_app_head.php';
?>
<div class="apply">
    <table class="all-content" width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="270px" class="sidebar">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="choose-course">
                    <tr>
                        <td>Search TA Information<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                    </tr>
                    <tr>
                        <td>Search Workshop<img src="/ji_style/images/arrow.png" height="17" class="hidden"></td>
                    </tr>
                </table>
            </td>
            <td class="mainbar">
                <div align="center" class="searchta">
                    <form action="/ta/application/Student/showtainfo" method="post">
                        Course ID:
                        <input type="text" name="classid" class="inputid">
                        <br/>
                        <button type="submit" class="submit">Search</button>
                    </form>
                </div>
                <div align="center" class="showworkshop hidden">

                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>