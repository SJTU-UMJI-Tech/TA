<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
* �쿭��
* 2016/4/14
* ѧ�������з���
*/
class Student extends TA_Controller {
	public function __construct(){
		parent::__construct();
		//session_start();
		$_SESSION['id']='5133709242';
	}
	
	public function home(){
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Medittime');
		$list=$this->Medittime->getAll();
		$data['list']=$list;
		print_r($list);
		$this->load->view('stu_app_showapptime',$data);
	}
	
	public function apply()
	{	
		$this->load->database();
		$this->load->helper('url');			
		$this->load->model('Mapply');
		$list=$this->Mapply->getAll();
		$data['list']=$list;
		$this->load->view('stu_app_apply',$data);
	}
	
	public function applydetail()
	{
		$courseid=$_GET['courseid'];
//		echo $courseid;
//�˴�Ӧ�ô�session��ȡ���������ݣ�������ji_ta_appinfo����Ϣ�������
		$sql="SELECT * FROM ji_ta_appinfo LIMIT 1;";
		$res = $this->db->query($sql);
		$list=$res->result();
		$data['list']=$list;
		$data['courseid']=$courseid;
//		var_dump($data);
		$this->load->view('stu_app_applydetail',$data);
	}
	
	public function saveinfo(){
		$this->load->database();
		$this->load->model('Mapply');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('introduction', 'Self-introduction', 'required|min_length[20]|max_length[1000]');
		$this->form_validation->set_rules('comment', 'Comment', 'required|max_length[500]');
		/*
		if ($this->form_validation->run() == FALSE) {
			$courseid = $_GET['courseid'];
//			echo $courseid;
//�˴�Ӧ�ô�session��ȡ���������ݣ�������ji_ta_appinfo����Ϣ�������
			$sql = "SELECT * FROM ji_ta_appinfo LIMIT 1;";
			$res = $this->db->query($sql);
			$list = $res->result();
			$data['list'] = $list;
			$data['courseid'] = $courseid;
			$this->load->view('applydetail', $data);
		} else {
		*/

		//xuyao session
		$stu_id='5133709242';
		$file_path='./ji_upload/ta/apply/'.$stu_id.'/';
		if (!file_exists($file_path))
		{
			mkdir($file_path);
		}
		$config['upload_path'] = $file_path;
		$config['allowed_types'] = 'png|pdf|jpg';//文件类型
		$config['max_size'] = 10000000;
		$config['max_width'] = 1024;
		$config['max_height'] = 768;
		$config['file_name'] = $stu_id . time();
		$this->load->library('upload',$config);
		$status=$this->upload->do_upload('upfile');
		$wrong=$this->upload->display_errors();
		if ($wrong){
			echo $wrong;
		}
		if (!$status) {
			echo 'fail';
			exit();
		}
		$upload_data = $this->upload->data();
		echo $upload_data['file_name'];


		$this->load->model('Meditman');
			$xqxn=$this->Meditman->getxqxn();
			$xq=$xqxn[0]->data;
			$xn=$xqxn[1]->data;
			$courseid = $_GET['courseid'];
			$today = date("Y-m-d H:i:s");
			$data = array(
				'name' => $_POST['name'],
				'student_id' => $_POST['studentid'],
				'app_course' => $_POST['courseid'],
				'app_date' => $today,
				'action_type' => "apply"
			);
			$dataa = array(
				'name' => $_POST['name'],
				'student_id' => $_POST['studentid'],
				'gender' => $_POST['sex'],
				'faculty' => $_POST['faculty'],
				'grade' => $_POST['Grade'],
				'app_course' => $courseid,
				'self_introduction' => $_POST['introduction'],
				'comment' => $_POST['comment'],
				'email' => $_POST['email'],
				'app_time' => $today,
				'xq'=>$xq,
				'xn'=>$xn
			);
			$bool = $this->Mapply->saveapplyrecord($data);
			$bool1 = $this->Mapply->saveapplyinfo($dataa);

			if ($bool) {
				if ($bool1) {
					$this->load->view('stu_app_applysuccess');
				}
			}
//		}
	}

	public function myapplication(){
		$this->load->database();
		$this->load->helper('url');			
		$this->load->model('Mapply');
		$id='5133709242';
		$list=$this->Mapply->showmyapplication($id);
		$data['list']=$list;
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
			$this->load->view('stu_app_deletesuccess');
		}
	}

	public function viewcourseinfo()        //课程信息
	{
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Mapply');
		$class = $this->Mapply->getAll();
		$data['class'] = $class;
		$KCDM = $_GET['KCDM'];
		$data['KCDM'] = $KCDM;
		$this->load->view('stu_app_courseinfo', $data);
	}

	public function service(){
		$this->load->view('stu_app_service');
	}

	public function searchta(){
		$this->load->view('stu_app_searchta');
	}

	public function showtainfo(){
		$this->load->model('Meditman');
		$xqxn=$this->Meditman->getxqxn();
		$xq=$xqxn[0]->data;
		$xn=$xqxn[1]->data;
		$courseid=strtoupper($this->input->post('classid'));
		$this->load->model('Mapply');
		$list=$this->Mapply->gettainfo($xq,$xn,$courseid);
		$data['list']=$list;
		$data['courseid'] = ucfirst(strtolower($courseid));
		$this->load->view('stu_app_showtainfo',$data);
	}

	public function showworkshop(){
		$this->load->model('Mapply');
		$list=$this->Mapply->showworkshop();
		$data['list']=$list;
		$this->load->view('stu_app_workshopinfo',$data);
	}

	public function saveworkshop(){
		$id=$this->input->get('id');
		$this->load->model('Mapply');
		$student_id='5133709242';
		$bool=$this->Mapply->applyworkshop($id,$student_id);
		if ($bool){
			$this->load->view('stu_app_applyworksuc');
		}
	}
}
?>