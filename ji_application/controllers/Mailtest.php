<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Mailtest extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mta_site');
		$this->load->model('Mta_mail');
	}
	
	function index()
	{
		echo base_url('ta/evaluation/teacher/feedback/check?id=1');
	}
	
}


