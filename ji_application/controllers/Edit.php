<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function home(){
		$this->load->view('manager_app_header');
		$this->load->view('manager_app_edititem');
	}
	
	public function editxqxn(){
		$this->load->model('Meditman');
		$list=$this->Meditman->getxqxn();
		$data['list']=$list;
		$this->load->view('manager_app_header');
		$this->load->view('manager_app_editxqxn',$data);
	}
	
	public function savexqxn(){
		$this->load->database();
		$this->load->model('Meditman');
		$nxn='ji_academic_year';
		$nxq='ji_academic_term';
//		var_dump($nxq);
		$dataxn=array(
			'data'=>$_POST["xxn"]
		);
		$bool=$this->Meditman->savexqxn($dataxn, $nxn);
		$dataxq=array(
			'data'=>$_POST["xxq"]
		);
		$bool1=$this->Meditman->savexqxn($dataxq,$nxq);
//		$sql="UPDATE  ji_ta_config SET  data = ? WHERE  obj = ?";
//		$bool2=$this->db->query($sql,array($data,$obj));
//		echo $bool2;
		if(($bool)&&($bool1)){
			$this->load->view('manager_app_header');
			$this->load->view('manager_app_edititem');
		}
	}
	
	public function editcourse(){//��δ���
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Meditman');
		$xqxn=$this->Meditman->getxqxn();
		$xq=$xqxn[0]->data;
		$xn=$xqxn[1]->data;
		$cid=$this->input->get('cid');
		$list=$this->Meditman->searchcourseinfo($xq,$xn,$cid);
		$data['list']=$list[0];
//		print_r($list);
		$this->load->view('manager_app_header');
		$this->load->view('manager_app_editcourse',$data);
	}
	
	public function modifycourse(){
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Meditman');
	}
	
	public function edittime()
	{	
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Meditman');
		$list=$this->Meditman->gettime();
		$data['list']=$list;
		$this->load->view('manager_app_header');
		$this->load->view('edittime',$data);
	}
	
	public function modifytime(){	
		$this->load->database();
		$this->load->model('Meditman');
		$obj = $_GET['obj'];
//		var_dump($obj);
		$list = $this->Meditman->searchtime($obj);
		$data['list']=$list;
//		var_dump($data);
		$this->load->view('manager_app_header');
		$this->load->view('edittime_detail',$data);
	}
	
	public function savetime(){
		$this->load->database();
		$this->load->model('Meditman');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$obj = $_GET['obj'];
		$get=$_POST["time"];
		$data=array(
			'data'=>$_POST["time"]
		);
		$bool=$this->Meditman->edittime($data,$obj);
		if($bool){
			$this->load->view('manager_app_header');
            $this->load->view('editsuccess');			
 		}
	}
}
?>