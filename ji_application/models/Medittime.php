<?php
	class Medittime extends CI_Model{
	
		//get all the articles
		public function getAll(){
			$sql="SELECT data FROM ji_ta_config WHERE obj='ta_recruitment_end' or obj='ta_recruitment_start' ORDER BY data";
			$res=$this->db->query($sql);
			return $res->result();
		}
		
		public function search($obj){
			$sql='select * from ji_ta_config where obj = ?';
			$res=$this->db->query($sql,array($obj));
//			$res=$this->db->select('data')
//				->from('ji_ta_config')
//				->where('obj',$obj)
//				->get();
			return $res->result();
		}
		
		public function edit($data,$obj){
			$bool=$this->db->update('ji_ta_config',$data,array('obj'=>$obj));
			return $bool;
		}
	}
?>