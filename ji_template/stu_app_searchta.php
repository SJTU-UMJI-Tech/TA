<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Apply for TA</title>
    <link href="/ji_style/stu_app_common.css" type="text/css" rel="stylesheet"/>
    <style type="text/css">
        .submit {
            width: 100px;
            height: 30px;
            font-size: 15px;
        }
    </style>
    <script src="/ji_js/jquery-app.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#strip-4').addClass('current');
            $('#button-4').addClass('current');
        });
    </script>
    <script src="/ji_js/stu_app_common.js"></script>
</head>
<meta charset="utf-8">
<title>Apply for Ta</title>
</head>
<body>
<?php
require 'stu_app_head.php';
?>
<div class="apply">
    <div align="center">
        <form action="/ta/application/Student/showtainfo" method="post">
            Course ID(please input capital letter such as VG100)
            <input type="text" name="classid">
            <br/>
            <button type="submit" class="submit">Search</button>
        </form>
    </div>
</div>
</body>
</html>