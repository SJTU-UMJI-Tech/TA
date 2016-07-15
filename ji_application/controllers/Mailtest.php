<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailtest extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Mta_site');
		$this->load->model('Mta_mail');
	}
	
	//发送测试邮件
	public function index()
	{
		$data = array
		(
			$to => $this->input->get('email'),
			$name => 'student_name',
			$title => 'title',
			$body => 'body',
		);
		echo $this->Mta_mail->send($this->input->get('email'),'hi','hi');

		
	}
	
	public function feedback()
	{
		echo 1;
		$this->load->model('Mta_feedback');
		
		print_r($this->Mta_feedback->admin_manage_feedback(array('id'=>2, 'manage'=>false, 'content'=>'222')));
		
		
	}
	
	public function aaa()
	{
		echo 1;
	}
	
	
}


