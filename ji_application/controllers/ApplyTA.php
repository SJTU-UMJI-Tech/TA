<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
* 朱凯慈
* 2016/4/14
* 学生端所有方法
*/
class ApplyTA extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	public function home(){
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Medittime');
		$list=$this->Medittime->getAll();
		$data['list']=$list;
		$this->load->view('stu_app_head');
		$this->load->view('stu_app_showapptime',$data);
	}
	
	public function apply()
	{	
		$this->load->database();
		$this->load->helper('url');			
		$this->load->model('Mapply');
		$list=$this->Mapply->getAll();
		$data['list']=$list;
		$this->load->view('stu_app_head');
		$this->load->view('stu_app_apply',$data);
	}
	
	public function applydetail()
	{
		$courseid=$_GET['courseid'];
//		echo $courseid;
//此处应该从session读取申请者数据，现在用ji_ta_appinfo的信息代替测试
		$sql="SELECT * FROM ji_ta_appinfo LIMIT 1;";
		$res = $this->db->query($sql);
		$list=$res->result();
		$data['list']=$list;
		$data['courseid']=$courseid;
//		var_dump($data);
		$this->load->view('stu_app_head');
		$this->load->view('stu_app_applydetail',$data);
	}
	
	public function saveinfo(){
		$this->load->database();
		$this->load->model('Mapply');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('introduction', 'Self-introduction', 'required|min_length[3]|max_length[200]');
		$this->form_validation->set_rules('comment', 'Comment', 'required|max_length[200]');
		
		if ($this->form_validation->run() == FALSE){
            $courseid=$_GET['courseid'];
//			echo $courseid;
//此处应该从session读取申请者数据，现在用ji_ta_appinfo的信息代替测试
			$sql="SELECT * FROM ji_ta_appinfo LIMIT 1;";
			$res = $this->db->query($sql);
			$list=$res->result();
			$data['list']=$list;
			$data['courseid']=$courseid;
//			var_dump($data);
			$this->load->view('stu_app_head');
			$this->load->view('applydetail',$data);
        }
		else {
			$courseid=$_GET['courseid'];
			$today=date("Y-m-d H:i:s");
			$data=array(
				'name'=>$_POST['name'],
				'student_id'=>$_POST['studentid'],
				'app_course'=>$_POST['courseid'],
				'app_date'=>$today,
				'action_type'=>"apply"
			);
			$dataa=array(
				'name'=>$_POST['name'],
				'student_id'=>$_POST['studentid'],
				'gender'=>$_POST['sex'],
				'faculty'=>$_POST['faculty'],
				'grade'=>$_POST['Grade'],
				'app_course'=>$courseid,
				'self_introduction'=>$_POST['introduction'],
				'comment'=>$_POST['comment'],
				'email'=>$_POST['email'],
				'app-time'=>$today
			);
			$bool=$this->Mapply->saveapplyrecord($data);
			$bool1=$this->Mapply->saveapplyinfo($dataa);
			if ($bool){
				if($bool1){
					$this->load->view('stu_app_head');
					$this->load->view('stu_app_applysuccess');
				}
			}
		}
	}
	
	
	public function myapplication(){
		$this->load->database();
		$this->load->helper('url');			
		$this->load->model('Mapply');
		$id='5133709242';
		$list=$this->Mapply->showmyapplication($id);
		$data['list']=$list;
		$this->load->view('stu_app_head');
		$this->load->view('stu_app_showmyapp',$data);
	}
	
	public function deleteapp(){
		$course_id=$_GET['app_course'];
		$id=$_GET['id'];
		$this->load->database();
		$this->load->helper('url');			
		$this->load->model('Mapply');
		$bool=$this->Mapply->deleteappinfo($id,$course_id);
		$today=date("Y-m-d H:i:s");
		$data=array(
			'student_id'=>$id,
			'app_course'=>$course_id,
			'app_date'=>$today,
			'action_type'=>"delete"
		);
		$bool1=$this->Mapply->savedeleteinfo($data);
		if($bool){
			$this->load->view('stu_app_head');
			$this->load->view('stu_app_deletesuccess');
		}
	}
	
}
?>