<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends TA_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'student';
		$this->data['page_name'] = 'TA Evaluation System: TA Evaluation';
		$this->data['banner_id'] = 2;
		$this->Mta_site->redirect_login($this->data['type']);
		$this->load->model('Mstudent');
		$this->load->model('Mta_evaluation');
		$this->data['state'] = $this->Mta_evaluation->get_evaluation_state();

	}
	
	/**
	 * @param int $BSID
	 * Evaluation homepage
	 */
	public function index($BSID = 0)
	{
		if ($BSID == 0)
		{
			redirect(base_url('ta/evaluation/student/evaluation/view'));
		}
		else
		{
			redirect(base_url('ta/evaluation/student/evaluation/evaluate/' . $BSID));
		}
	}
	
	/**
	 * @param int $BSID
	 * @return Course_obj
	 */
	private function validate_course($BSID)
	{
		$this->load->model('Mcourse');
		if (!$this->Mstudent->is_now_course($_SESSION['userid'], $BSID))
		{
			$this->index();
		}
		$course = $this->Mcourse->get_course_by_id($BSID);
		if ($course->is_error())
		{
			$this->index();
		}
		return $course;
	}
	
	public function view()
	{
		$data = $this->data;
		$this->load->library('Course_obj');
		$data['course_list'] = $this->Mstudent->get_now_course($_SESSION['userid']);
		foreach ($data['course_list'] as $course)
		{
			/** @var $course Course_obj */
			$course->set_ta()->set_question();
		}

		$this->load->view('ta/evaluation/evaluation/list', $data);
	}

	public function evaluate($BSID)
	{
		$data = $this->data;
		if ($data['state'] != 0)
		{
			$this->index();
		}
		$data['course'] = $this->validate_course($BSID);
		$data['course']->set_ta()->set_question();
		$data['choice_list'] = array();
		for ($index = 0; $index < 5; $index++)
		{
			$data['choice_list'][] = new stdClass();
		}
		$this->load->view('ta/evaluation/evaluation/evaluation', $data);
	}
	
}
