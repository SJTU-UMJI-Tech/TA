<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data['1'] = 1;
		$this->load->view('ta/evaluation/student/index', $data);
		echo "11";
	}
}
