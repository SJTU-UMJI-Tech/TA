<link href="style.css" rel="stylesheet" type="text/css" />
<style>
.warning { margin:20px; line-height:100px; font-size:20px;}
</style>
<?php
include("include.php");
$student_id = $_POST['student_id'];
$id = $_POST['id'];//获取身份证号
$student_name = $_POST['student_name'];
$student_name = $_POST['student_name'];
$student_phone = $_POST['student_phone'];
$advisor_id = $_POST['advisor_id'];


$sqlid = "select * from id where student_id='".$student_id."' and id='".$id."' limit 1";
$result = mysql_query($sqlid,$conn);
$rs = mysql_fetch_assoc($result);//获取学生ID和身份证的信息

$getstudent = "select * from student where student_id='".$rs['student_id']."' limit 1";
$resultstudent = mysql_query($getstudent,$conn);
$rs2 = mysql_fetch_assoc($resultstudent);//是否允许该学生选老师

$getadvisor = "select * from advisor where advisor_id='".$advisor_id."'";
$resultadvisor = mysql_query($getadvisor,$conn);
$ad = mysql_fetch_assoc($resultadvisor);//获取该学生选取的该老师的信息

if($rs2['student_major']!=$ad['advisor_major']){echo "<body><div class='warning'>Warning: You are not in the ".$ad['advisor_major']." list.  "."<a href='index.php'>Back</a></div></body>"; die;}

if($rs2['student_status']==1){//如果允许该学生选老师

	if($id != $rs['id']){//如果获取到的身份证ID和数据库中的不一样
		if($rs['id']!=''){
			echo "<body><div class='warning'>Warning: Wrong!Please try it again.  "."<a href='index.php'>Back</a></div></body>";
		}
	}else{
		if($rs2['advisor_id']!='0'){
			if($advisor_id != $rs2['advisor_id']){
				$sqladvisor = "update `advisor` set advisor_count=`advisor_count`-1 where advisor_id=".$rs2['advisor_id']."";
				mysql_query($sqladvisor,$conn);//计数加1
				$sqladvisor2 = "update `advisor` set advisor_count=`advisor_count`+1 where advisor_id=".$advisor_id."";
				mysql_query($sqladvisor2,$conn);//计数加1
			}
		}else{
			$sqladvisor3 = "update `advisor` set advisor_count=`advisor_count`+1 where advisor_id=".$advisor_id."";
			mysql_query($sqladvisor3,$conn);//计数加1
		}
		
		$sqlstudent = "update `student` set student_name='".$student_name."',student_phone='".$student_phone."',advisor_id='".$advisor_id."' where student_id='".$student_id."'";
		mysql_query($sqlstudent,$conn);//更新学生表信息
	
		echo "<body><div class='warning'>Submission Completed！<a href='index.php'>Back</a></div></body>";
	}
}elseif($rs2['student_status']==2){
	echo "<body><div class='warning'>Submission Completed，<a href='index.php'>Back</a></div></body>";	
}else{
echo "<body><div class='warning'>Warning: Wrong!Please try it again，<a href='index.php'>Back</a></div></body>";	
}
?>