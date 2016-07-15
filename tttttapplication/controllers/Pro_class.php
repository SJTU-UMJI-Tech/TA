<?php
class Pro_class extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function classdetail()
    {
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('MPro_class');
        $list1=$this->MPro_class->getopenclass();
    	$list0=$this->MPro_class->getcloseclass();
		$data['openclass']=$list1;
		$data['closeclass']=$list0;
        $this->load->view('stu_app_head');
        $this->load->view('viewproclass',$data);
    }
	
	public function viewmyapp()
	{
		$id=$_GET['id'];
		$course_id=$_GET['course_id'];
	    $this->load->database();
        $this->load->helper('url');
        $this->load->model('MPro_class');	
	    $list=$this->MPro_class->getta($id,$course_id);
		$data['list']=$list;
		$this->load->view('stu_app_head');
        $this->load->view('myapp',$data);	
	}
	
	
	
	
	
	public function allow()
	{
		$id=$_GET['id'];
		$course_id=$_GET['course_id'];
	    $this->load->database();
        $this->load->helper('url');
        $this->load->model('MPro_class');
		$list=$this->MPro_class->getta($id,$course_id);
		$bool=$this->MPro_class->Mallow($id,$course_id);
		$this->load->view('stu_app_head');
        $this->load->view('appallow',$data);
		# send email
	}
	
	public function deny()
	{
		$id=$_GET['id'];
		$course_id=$_GET['course_id'];
	    $this->load->database();
        $this->load->helper('url');
        $this->load->model('MPro_class');
	    $bool=$this->MPro_class->Mdeny($id,$course_id);
		$this->load->view('stu_app_head');
        $this->load->view('appdeny',$data);
		# send email
	}
	
	public function setcourseinfo()
	{
		$this->load->database();
        $this->load->helper('url');
        $this->load->helper(array('form', 'url'));
	    $this->load->library('form_validation');
		$this->form_validation->set_rules('course_introduction', 'Course-introduction', 'required|max_length[200]');
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
			$this->load->view('classdetail',$data);
        }
		else{
			$course_id=$_GET['courseid'];
			$dara=array(
			'course_id'=>$_POST['course_id'],
			'course_name'=>$_POST['course_name'],
			'professor_name'=>$_POST['professor_name'],
			'xq'=>$_POST['xq'],
			'xn'=>$_POST['xn'],
			'course_instruction'=>$_POST['course_instruction'],
			'maxta'=>$_POST['maxta'],
			'curta'=>$_POST['curta'],
			'salary'=>$_POST['salary'],
			'status'=>$_POST['status'],
			);
			$bool=$this->MPro_class->Mset($data);
			if($bool)
			{
				$this->load->view('stu_app_head');
				$this->load->view('setsuccess');
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
		
}