<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends TA_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'teacher';
		$this->data['page_name'] = 'TA Evaluation System: TA Report';
		$this->data['banner_id'] = 4;
		$this->Mta_site->redirect_login($this->data['type']);
	}
	
	public function index()
	{
		$data = $this->data;
		$this->load->view('ta/evaluation/report/teacher', $data);
	}
}
