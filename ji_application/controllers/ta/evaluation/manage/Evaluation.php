<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends TA_Controller
{
	
	/**
	 * Evaluation constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'manage';
		$this->data['page_name'] = 'TA Evaluation System: TA Evaluation';
		$this->data['banner_id'] = 2;
		$this->Mta_site->redirect_login($this->data['type']);
		$this->load->model('Mta_evaluation');
		$this->load->model('Mmanage');
		$this->load->library('Evaluation_obj');
		$this->data['state'] = $this->Mta_evaluation->get_evaluation_state();
		
	}

	public function index()
	{
		$data = $this->data;
		$this->load->view('ta/evaluation/evaluation/manage', $data);
	}
	
	private function redirect()
	{
		redirect(base_url('ta/evaluation/manage/evaluation'));
	}
	
	
	public function edit()
	{
		$data = $this->data;
		$data['id'] = $this->input->get('id');
		if ($data['id'] != '')
		{
			$data['config'] = $this->Mta_evaluation->get_evaluation_config($data['id']);
			if (!$data['config']->is_error())
			{
				$question = $this->Mta_evaluation->get_question($data['config']);
				$data['choice_list'] = $question['choice'];
				$data['blank_list'] = $question['blank'];
				$this->load->view('ta/evaluation/evaluation/edit_config', $data);
				return;
			}
		}
		$data['edit_type'] = $this->input->get('type');
		if ($data['edit_type'] != 'student' && $data['edit_type'] != 'teacher')
		{
			$this->redirect();
		}
		$data['config_list'] = $this->Mta_evaluation->get_evaluation_config($data['edit_type'], true);
		$this->load->view('ta/evaluation/evaluation/view_config', $data);
	}
	
	public function settime()
	{
		$start = $this->input->get('start');
		$end = $this->input->get('end');
		
		if ($start > 0 && strtotime($end) > strtotime($start))
		{
			
			$this->Mta_site->update_site_config(array(
				                                    'ta_evaluation_start' => $start,
				                                    'ta_evaluation_end'   => $end
			                                    ));
			echo 'success';
			exit();
		}
		echo lang('ta_evaluation_time_error');
		exit();
	}
}
