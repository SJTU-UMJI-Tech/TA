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
		$this->load->model('Mta_application');
		//$this->Mta_site->redirect_login($this->data['type']);
	}
	
	private function validate_course($id)
	{
		$course = $this->Mta_application->get_course_by_id($id);
		if ($course->is_error())
		{
			$this->index();
		}
		if ($course->state > 1)
		{
			$this->index();
		}
		return $course;
	}
	
	public function index()
	{
		$data = $this->data;
		//$this->load->model('Mapply');
		//$list = $this->Mapply->getAll();
		//$data['list'] = $list;
		/**
		 * @TODO  Data Problem
		 * We don't have course BSID before the TA application
		 * Some alternative solutions will be developed in the future
		 * This part may be pushed into Mcourse
		 *
		 * Update 2016.7.21
		 * Use an internal id to identify the course
		 * BSID can be added after it is given by SJTU
		 */
		$data['open_list'] = $this->Mta_application->get_open_list();
		$data['id'] = $this->input->get('id');
		if ($data['id'] != '')
		{
			$data['course']=$this->validate_course($data['id']);
			//$data['class'] = $list;
			$this->load->view('ta/application/student/course', $data);
		}
		else
		{
			$this->load->view('ta/application/student/list', $data);
		}
	}
	
	public function detail()
	{
		$data = $this->data;
		$id = $this->input->get('id');
		$course = 0;
		
		
		$courseid = $this->input->get('KCDM');
		$sql = "SELECT * FROM ji_ta_appinfo LIMIT 1;";
		$res = $this->db->query($sql);
		$list = $res->result();
		$data['list'] = $list;
		$data['courseid'] = $courseid;
		$this->load->view('ta/application/student/detail', $data);
	}
	
	public function myapply()
	{
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Mapply');
		$id = '5133709242';
		$list = $this->Mapply->showmyapplication($id);
		$data['list'] = $list;
		$this->load->view('ta/application/student/myapply', $data);
	}
	
	
}
