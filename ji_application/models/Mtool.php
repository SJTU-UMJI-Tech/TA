<?php
class Mtool extends CI_Model{
	function get_lucky_member($number){//随机获取STAFF和FACULTY
		return $this->db->query("SELECT * FROM `ji_tool_lucky` where status=0 order by rand() limit ".$number."")->result();
	}
	function get_lucky_member_asc(){//正序获取所有的同事
		return $this->db->query("SELECT * FROM `ji_tool_lucky` where status=0")->result();
	}
	function get_lucky_member_desc(){//倒序获取所有的同事
		return $this->db->query("SELECT * FROM `ji_tool_lucky` where status=0 order by id desc")->result();
	}
}
?>