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
	<form name="" action="/ta/application/Edit/modifycourse?BSID=<?=$list->BSID?>" method="post">
		课程代码<input type="text" class="am-form-field am-radius" name="KCDM" readonly="true" value="<?=$list->KCDM?>"/>
		<br />
		课程名称<input type="text" class="am-form-field am-radius" name="AuthorName" readonly="true" value="<?=$list->KCZWMC?>"/>
		<br />
		授课老师<input type="text" class="am-form-field am-radius" name="XM" readonly="true" value="<?=$list->XM?>"/>
		<br />
		授课学期<input type="text" class="am-form-field am-radius" name="XQ" readonly="true" value="<?=$list->XQ?>"/>
		<br />
		授课学年<input type="text" class="am-form-field am-radius" name="XN"readonly="true"  value="<?=$list->XN?>"/>
		<br />
		最大TA人数<input type="text" class="am-form-field am-radius" name="MaxTA" value="<?=$list->maxta?>"/>
		<br />
		已有TA申请人数<input type="text" class="am-form-field am-radius" name="CurTA" value="<?=$list->curta?>"/>
		<br />
		工资<input type="text" class="am-form-field am-radius" name="Salary" value="<?=$list->salary?>"/>
		<br />
		<input type="submit" class="am-btn am-btn-primary am-round" name="submit" value="submit"/>
		<input type="reset" class="am-btn am-btn-danger am-round" name="reset" value="reset"/>
	</form>
</body>
</html>