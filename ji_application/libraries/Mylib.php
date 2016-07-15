<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mylib {

	function __construct() {
	}

	public function addlog($action,$time,$id,$model,$name,$institute){//增加事件记录
		$this->db->query("insert into ji_user_log set `log_action`='".$action."',`log_time`='".$time."',`user_id`='".$id."',`log_model`='".$model."',`user_name`='".$name."',`user_institute`='".$institute."'");
	}
	public function test(){
		echo 'test';
		}
	//public function resizeImage($im,$maxwidth,$maxheight,$name,$filetype){
	
	
	
	
	
}