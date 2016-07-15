<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="refresh" content="5;url=/ta/application/Srevice/home">
    <title>UM-SJTU JI</title>
    <link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
    <link href="/ji_style/home.css" type="text/css" rel="stylesheet" />
</head>
<meta charset="utf-8">
<title>Apply wokshop</title>
</head>
<body>
<table>
    <tr>
        <td>topic</td>
        <td>date</td>
        <td>time</td>
        <td>speaker</td>
        <td>duration</td>
        <td>place</td>
        <td>max student</td>
        <td>current student</td>
        <td></td>
    </tr>
<?php foreach($list as $item): ?>
    <?php if ($item->status == 1){ ?>
        <tr>
            <td><?=$item->topic?></td>
            <td><?=$item->date?></td>
            <td><?=$item->time?></td>
            <td><?=$item->speaker?></td>
            <td><?=$item->duration?></td>
            <td><?=$item->place?></td>
            <td><?=$item->maxstu?></td>
            <td><?=$item->curstu?></td>
            <td><button>apply</button></td>
        </tr>
    <?php } ?>
<?php endforeach;?>
</table>
</body>
</html>