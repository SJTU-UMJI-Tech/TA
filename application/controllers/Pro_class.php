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
    	$list=$this->MPro_class->getclass();
		$data['class']=$list;
        $this->load->view('stu_app_head');
        $this->load->view('viewproclass',$data);
		#需要教授的信息 ID		
		//example
    }
	
	public function viewmyapp()
	{
		$id=$_POST['id'];
		$course_id=$_POST['course_id'];
	    $this->load->database();
        $this->load->helper('url');
        $this->load->model('MPro_class');	
	    $list=$this->MPro_class->getta($id,$course_id);
		for ($i=0;i<count($list);$i++)
			{
				for ($j=0;i<count($list);$j++)
				{
					if ($list[$j]['app-time']>$list[$j+1]['app-time'])
					{
						$t=$list[$j]['app-time'];
						$list[$j]['app-time']==$list[$j+1]['app-time'];
						$list[$j+1]['app-time']=$t;
					}	
				}
			}
		$data['application']=$list;
		if ($data['application']==0)
        $this->load->view('application',$data);
		if ($data['application']!=0)
		 $this->load->view('application2',$data);
	}
	
	
	
	public function allowordeny()
	{
		$id=$_POST['id'];
		$course_id=$_POST['course_id'];
		$choice=$_POST['choice'];
	    $this->load->database();
        $this->load->helper('url');
        $this->load->model('MPro_class');
		if ($choise == 'pass')
		{
			$list=$this->MPro_class->getta($id,$course_id);
			$data['list']=$list;
			$bool=$this->MPro_class->Mallow($id,$course_id);
					# send email
		}
		if ($choise == 'reject')
		{
			$bool=$this->MPro_class->Mdeny($id,$course_id);
					# send email
		}
		if ($choice == 'set_interview')
		{
			$interview_time=$_POST['interview_time'];
			$bool=$this->MPro_class->Minterview($id,$course_id);
					# send email
		}
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
			$course_id=$_POST['courseid'];
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