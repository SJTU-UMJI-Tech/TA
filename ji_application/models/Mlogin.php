<?php

class Mlogin extends CI_Model{
	function validateuser($user,$pwd){//模拟验证用户
		$q = $this
			->db
			->where('user_id',$user)
			->where('user_password',md5($pwd))
			->limit(1)
			->get('ji_user');
		if($q->num_rows > 0){
			$user = $q->row_array();
			$updatetime = array(
				'user_lastlogin' => $user['user_logintime'],
				'user_logintime' => date("Y-m-d G:i:s")
			);
			$this->db->where('id',$user['id']);
			$this->db->update('ji_user',$updatetime);
			$_SESSION['userid'] = $user['id'];
			return $q->row();
		}
		return false;
	}
	function addlog($action,$time,$id,$model,$name,$institute){//增加事件记录
		$this->db->query("insert into ji_user_log set `log_action`='".$action."',`log_time`='".$time."',`user_id`='".$id."',`log_model`='".$model."',`user_name`='".$name."',`user_institute`='".$institute."'");
	}
}