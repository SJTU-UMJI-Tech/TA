<?php
class Mmanage extends CI_Model{
	function addlog($action,$time,$id,$model,$name,$institute){//增加事件记录
		$this->db->query("insert into ji_user_log set `log_action`='".$action."',`log_time`='".$time."',`user_id`='".$id."',`log_model`='".$model."',`user_name`='".$name."',`user_institute`='".$institute."'");
	}
	function get_config_cn(){
		return $this->db->query('SELECT * FROM `ji_config` where id=1')->row_array();
	}
	function get_config_en(){
		return $this->db->query('SELECT * FROM `ji_config` where id=2')->row_array();
	}
	function get_finishmodules(){//获取所有已开发完毕的模块
		return $this->db->query("select * from `ji_user_module` where module_id != 1 and module_status=1")->result();
	}
	function get_onmodules(){//获取所有正在开发的模块
		return $this->db->query("select * from `ji_user_module` where module_id != 1 and module_status=0")->result();
	}
	function get_mymodules(){//普通用户获取自己的模块
		return $this->db->query("select * from `ji_user_permission` where user_id='".$_SESSION['user']."'")->result();
	}
	function get_allmodules(){//获取所有已开发完毕的模块
		return $this->db->query("select * from `ji_user_module` where module_id != 1")->result();
	}
	function get_user(){//获取当前登录的用户
		return $this->db->query("SELECT * FROM `ji_user` where user_id='".$_SESSION['user']."'")->row_array();
	}
	function get_users(){//获取所有可用的用户
		return $this->db->query("SELECT * FROM `ji_user`")->result();
	}
	function get_user_permissions(){//获取当前用户的所有权限
		return $this->db->query("select * from ji_user_permission where user_id='".$_SESSION['user']."'")->result();	
	}
	public function get_manage_by_id($id)
	{
		$query = $this->db->get_where('ji_user', array('user_id'=>$id));
		if ($query->num_rows() == 1)
		{
			return $query->row(0);
		}
		return NULL;
	}
}
?>