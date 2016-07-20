<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends TA_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'student';
		$this->data['page_name'] = 'TA Assistant System: Student Homepage';
		$this->data['banner_id'] = 1;
		//$this->Mta_site->redirect_login($this->data['type']);
	}
	
	public function index()
	{
		$data = $this->data;
		$this->load->view('ta/application/student/homepage', $data);
	}
}
