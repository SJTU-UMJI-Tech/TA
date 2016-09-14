<?php
	class Mapply extends CI_Model{
		
		public function getAll(){
			//debug_print_backtrace();
//			$res = $this->db->query("SELECT * FROM testcourse;");
			//$res = $this->db->get('testcourse');
			$sql = 'SELECT * FROM ji_course_info INNER JOIN kkxx WHERE ji_course_info.BSID = kkxx.BSID ORDER BY ji_course_info.KCDM';
			$res = $this->db->query($sql);
			return $res->result();
		}
				
		public function saveapplyinfo($data){
			$bool=$this->db->insert('ji_ta_appinfo',$data);
			return $bool;
		}
		
		public function saveapplyrecord($data){
			$bool=$this->db->insert('ji_ta_apprecord',$data);
			return $bool;
		}
		
		public function showmyapplication($id){
			$sql='SELECT * FROM ji_ta_appinfo WHERE student_id = ?';
			$res=$this->db->query($sql,array($id));
			return $res->result();
		}
		
		public function deleteappinfo($id,$courseid){
//			$bool=$this->db->delete('ji_ta_appinfo',array('id'=>$id,'app_course'=>$course_id));
			$sql='DELETE FROM ji_ta_appinfo WHERE student_id = ? AND app_course = ?';
			$bool=$this->db->query($sql,array($id,$courseid));
			return $bool;
		}
		
		public function savedeleteinfo($data){
			$bool=$this->db->insert('ji_ta_apprecord',$data);
			return $bool;
		}

		public function showworkshop(){
			$query = $this->db->get('ji_ta_workshop');
			return $query->result();
		}
		
		public function gettainfo($xq,$xn,$courseid){
			$sql='SELECT * FROM ji_ta_appinfo WHERE xq=? AND xn=? AND app_course=? AND status=1';
			$query=$this->db->query($sql,array($xq,$xn,$courseid));
			return $query->result();
		}

		public function applyworkshop($id,$student_id){
			$sql='INSERT INTO ji_ta_workshopdetail(student_id,workshopid) VALUES(?,?)';
			$bool=$this->db->query($sql,array($student_id,$id));
			return $bool;
		}
	}
?>