<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apply extends TA_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'student';
		$this->data['page_name'] = 'TA Assistant System: Apply for TA';
		$this->data['banner_id'] = 2;
		//$this->Mta_site->redirect_login($this->data['type']);
	}
	
	public function index()
	{
		$data = $this->data;
		$this->load->model('Mapply');
		$list = $this->Mapply->getAll();
		$data['list'] = $list;
		/**
		 * @TODO  Data Problem
		 * We don't have course BSID before the TA application
		 * Some alternative solutions will be developed in the future
		 * This part may be pushed into Mcourse
		 */
		$data['KCDM'] = $this->input->get('KCDM');
		if ($data['KCDM'] != '')
		{
			/** @TODO Validate the course (request by GET) */
			$data['class'] = $list;
			$this->load->view('ta/application/student/course', $data);
		}
		else
		{
			$this->load->view('ta/application/student/list', $data);
		}
	}
	
	
}
