<?php
class Pro_class extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function classdetail() 		//课程信息
    {
	    $this->load->database();
        $this->load->helper('url');
        $this->load->model('Mpro_class');
    	$class=$this->Mpro_class->getclass();
		$class['KCDM'] = strtolower($class["KCDM"]);
		var_dump($class);
		$data['class']=$class;
        $this->load->view('prof_app_courselist',$data);
    }
	
	public function class111()
	{
		$this->load->database();
		$this->load->helper('url');
		// $this->load->model('Mpro_class');
		$this->load->view('test');
	}
	
	public function viewmyapp()    // 申请该门课的ta
	{
		$id=$_POST['id'];
		$course_id=$_POST['course_id'];
	    $this->load->database();
        $this->load->helper('url');
        $this->load->model('Mpro_class');	
	    $list=$this->Mpro_class->getta($id,$course_id);
		for ($i=0;$i<count($list);$i++)
			{
				for ($j=0;$j<count($list);$j++)
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
	
	
	
	public function allowordeny()   // 通过、拒绝、面试
	{
		$id=$_POST['id'];
		$course_id=$_POST['course_id'];
		$choice=$_POST['choice'];
	    $this->load->database();
        $this->load->helper('url');
        $this->load->model('Mpro_class');
		if ($choise == 'pass')
		{
			$list=$this->Mpro_class->getta($id,$course_id);
			$data['list']=$list;
			$bool=$this->Mpro_class->Mallow($id,$course_id);
					# send email
		}
		if ($choise == 'reject')
		{
			$bool=$this->Mpro_class->Mdeny($id,$course_id);
					# send email
		}
		if ($choice == 'set_interview')
		{
			$interview_time=$_POST['interview_time'];
			$bool=$this->Mpro_class->Minterview($id,$course_id);
					# send email
		}
	}
		
		
	public function setcourseinfo()  //设置课程信息及开关申请
	{
        $this->load->helper(array('form', 'url'));
	    $this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|max_length[200]');
		$this->load->model('Mpro_class');
		if ($this->form_validation->run() == FALSE){
    		$class=$this->Mpro_class->getclass();
			$data['class']=$class;
			$this->load->view('prof_app_courselist',$data);
        }
		else{
			
			$BSID = $this->input->post('BSID');
			$status = $this->input->post('status');
			$email = $this->input->post('Email');
			$maxta = $this->input->post('maxta');
			$description = $this->input->post('description');
			$salary = $this->input->post('salary');
			$data=array(
			'status'=>$status,
			'maxta'=>$maxta,
			'salary'=>$salary,
			'email'=>$email,
			'BSID'=>$BSID
			);
			$dataa=array('KCJJ'=>$description,'BSID'=>$BSID);
			$bool=$this->Mpro_class->Mset($data,$dataa);
		//	$email = $this->input->post('email');
		//	$data=array('email'=>$email);
		//	$bool=$this->Mpro_class->Mset($data)		
		}
	}

	
	
	
	
		
}