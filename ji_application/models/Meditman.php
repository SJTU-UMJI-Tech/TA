<?php
	class Meditman extends CI_Model{
	
		public function gettime(){
			$res=$this->db->select('obj,data')
				->from('ji_ta_config')
				->where('obj','ta_recruitment_start')
				->or_where('obj','ta_recruitment_end')
				->get();
			return $res->result();
		}
		
		public function searchtime($obj){
			$sql='select * from ji_ta_config where obj = ?';
			$res=$this->db->query($sql,array($obj));
			return $res->result();
		}
		
		public function edittime($data,$obj){
			$bool=$this->db->update('ji_ta_config',$data,array('obj'=>$obj));
			return $bool;
		}
	
		public function getxqxn(){
			$res=$this->db->select('obj,data')
				->from('ji_common_config')
				->where('obj','ji_academic_year')
				->or_where('obj','ji_academic_term')
				->get();
			return $res->result();
		}
		
		
		public function savexqxn($data,$obj){
			$bool=$this->db->update('ji_common_config',$data,array('obj'=>$obj));
			return $bool;
		}
		
		public function getcourseinfo($xq,$xn){
			$sql='SELECT * 
FROM ji_course_info
RIGHT JOIN kkxx ON ji_course_info.BSID = kkxx.BSID WHERE xq= ? and xn = ? ';
			$res=$this->db->query($sql, array($xq,$xn));
			return $res->result();
		}
		
		public function searchcourseinfo($xq,$xn,$cid){
			if ($cid == null){
				if ($xq == 0) {
					if ($xn == 0) {
						$sql = 'SELECT * FROM ji_course_info RIGHT JOIN kkxx on ji_course_info.BSID = kkxx.BSID';
						$res = $this->db->query($sql);
					} else {
						$sql = 'SELECT * FROM ji_course_info RIGHT JOIN kkxx on ji_course_info.BSID = kkxx.BSID WHERE xn = ?';
						$res = $this->db->query($sql, array($xn));
					}
				} else {
					if ($xn == 0) {
						$sql = 'SELECT * FROM ji_course_info RIGHT JOIN kkxx on ji_course_info.BSID = kkxx.BSID WHERE xq = ?';
						$res = $this->db->query($sql, array($xq));
					} else {
						$sql = 'SELECT * FROM ji_course_info RIGHT JOIN kkxx on ji_course_info.BSID = kkxx.BSID WHERE xq = ? and xn = ?';
						$res = $this->db->query($sql, array($xq, $xn));
					}
				}
			} else {
				if ($xq == 0) {
					if ($xn == 0) {
						$sql = 'SELECT * FROM ji_course_info RIGHT JOIN kkxx on ji_course_info.BSID = kkxx.BSID WHERE kkxx.KCDM = ?';
						$res = $this->db->query($sql, array($cid));
					} else {
						$sql = 'SELECT * FROM ji_course_info RIGHT JOIN kkxx on ji_course_info.BSID = kkxx.BSID WHERE xn = ? and kkxx.KCDM = ?';
						$res = $this->db->query($sql, array($xn, $cid));
					}
				} else {
					if ($xn == 0) {
						$sql = 'SELECT * FROM ji_course_info RIGHT JOIN kkxx on ji_course_info.BSID = kkxx.BSID WHERE xq = ? and kkxx.KCDM = ?';
						$res = $this->db->query($sql, array($xq, $cid));
					} else {
						$sql = 'SELECT * FROM ji_course_info RIGHT JOIN kkxx on ji_course_info.BSID = kkxx.BSID WHERE xq = ? and xn = ? and kkxx.KCDM = ?';
						$res = $this->db->query($sql, array($xq, $xn, $cid));
					}
				}
			}
			return $res->result();
		}

		public function showstuapp($type,$id){
			if ($type == 0){
				$sql='SELECT * FROM ji_ta_appinfo WHERE student_id = ?';
			} else if ($type == 1){
				$res=$this->db->query('SELECT student_id FROM ji_students WHERE student_name = ?',array($id))->result();
				$id = $res[0]->student_id;
				$sql='SELECT * FROM ji_ta_appinfo WHERE student_id = ?';
			} else {
				$sql='SELECT * FROM ji_ta_appinfo WHERE ji_ta_appinfo.name = ?';
			}
			$res=$this->db->query($sql,array($id));
			return $res->result();
		}

		public function saveworkshop($data){
			$bool=$this->db->insert('ji_ta_workshop', $data);
			return $bool;
		}

		public function showcurrent(){
			$sql='SELECT * FROM ji_ta_workshop WHERE status=1';
			$res=$this->db->query($sql);
			return $res->result();
		}

		public function showclosed(){
			$sql='SELECT * FROM ji_ta_workshop WHERE status=0';
			$res=$this->db->query($sql);
			return $res->result();
		}

		public function editstatus($id,$type){
			if ($type == 'p'){
				$sql='UPDATE ji_ta_appinfo set status = 1 where id = ?';
			} else {
				$sql='UPDATE ji_ta_appinfo set status = -1 where id = ?';
			}
			$bool=$this->db->query($sql,array($id));
			return $bool;
		}
	}
?>