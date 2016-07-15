<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>UM-SJTU JI</title>
    <link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
    <link href="/ji_style/home.css" type="text/css" rel="stylesheet" />
</head>
<meta charset="utf-8">
<title>Edit TA Recruitment Time</title>
</head>

<body>

<table border="1">
    <tr>
        <td>主题</td>
        <td>日期</td>
        <td>时间</td>
        <td>演讲者</td>
        <td>时长</td>
        <td>地点</td>
        <td>最大人数</td>
    </tr>
    <?php foreach($list as $item): ?>
        <?php if($item->status==0){?>
            <tr>
                <td><?=$item->topic?></td>
                <td><?=$item->date?></td>
                <td><?=$item->time?></td>
                <td><?=$item->speaker?></td>
                <td><?=$item->duration?></td>
                <td><?=$item->place?></td>
                <td><?=$item->maxstu?></td>
            </tr>
        <?php }?>
    <?php endforeach;?>
</table>

</body>
</html>