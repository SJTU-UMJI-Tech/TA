<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends TA_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->Mta_site->redirect_login('');
	}
	
	public function index()
	{
		$data['page_name'] = 'TA Evaluation System';
		$this->load->view('ta/evaluation/index', $data);
	}
}
