<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>UM-SJTU JI</title>
    <link href="/ji_style/stu_app_common.css" type="text/css" rel="stylesheet"/>
    <script src="/ji_js/jquery-app.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#strip-1').addClass('current');
            $('#button-1').addClass('current');
        });
    </script>
    <script src="/ji_js/stu_app_common.js"></script>
</head>
<meta charset="utf-8">
<title>Edit TA Recruitment Time</title>
</head>
<body>
<?php
require 'stu_app_head.php';
?>
<table border="1" class="apply">
    <tr>
        <td>TA申请开始时间</td>
        <td>TA申请结束时间</td>
    </tr>
    <tr>
        <?php foreach ($list as $item): ?>
            <td><?= $item->data ?></td>
        <?php endforeach; ?>
    </tr>
</table>
</body>
</html>