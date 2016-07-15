
<?php

$mysql_server = "localhost";
$mysql_username = "sar";
$mysql_password = "sar@123456";
$mysql_database = "student_advising_registration";

$conn = @mysql_connect($mysql_server,$mysql_username,$mysql_password) or die("Can't connect Mysql!");
mysql_query("set names utf8");

mysql_select_db($mysql_database,$conn);

function characet($data){
  if( !empty($data) ){
    $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
    if( $fileType != 'UTF-8'){
      $data = mb_convert_encoding($data ,'utf-8' , $fileType);
    }
  }
  return $data;
}
?>