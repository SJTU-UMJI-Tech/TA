<?php
class MPro_class extends CI_Model
{
    public function getAll(){
//			$res = $this->db->query("SELECT * FROM testcourse;");
        $res = $this->db->get('testcourse');
        return $res->result();
    }
	
	 public function getappinfo(){
//			$res = $this->db->query("SELECT * FROM testcourse;");
        $res = $this->db->get('ji_ta_appinfo');
        return $res->result();
    }
	
	 public function getta($id,$course_id){
//			$res = $this->db->query("SELECT * FROM testcourse;");
        $res = $this->db->get('ji_ta_appinfo','id'==$id && 'app_course'==$course_id);
        return $res->result();
    }
	
	 public function getopenclass(){
//			$res = $this->db->query("SELECT * FROM testcourse;");
        $res = $this->db->get('ji_course_info','status'==1);
        return $res->result();
    }
	
	public function getcloseclass(){
//			$res = $this->db->query("SELECT * FROM testcourse;");
        $res = $this->db->get('ji_course_info','status'==0);
        return $res->result();
    }
	
	public function Mallow($id,$courseid)
	{
       $sql='UPDATE ji_ta_appinfo
	   set status = 1
	   WHERE student_id = ? AND app_course = ?';
	   $bool=$this->db->query($sql,array($id,$courseid));	
	}
	
	public function Mdeny($id,$courseid)
	{
		 $sql='UPDATE ji_ta_appinfo
	   set status = 2
	   WHERE student_id = ? AND app_course = ?';
	   $bool=$this->db->query($sql,array($id,$courseid));	
	}
	
	public function Mset($data)
	{
		$bool=$this->db->update('ji_courseinfo',$data,array('course_id'==$data['course_id']));
	}
	
	
	

}