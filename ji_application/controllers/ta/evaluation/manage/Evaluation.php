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
		$data['edit_type'] = $this->input->get('type');
		if ($data['edit_type'] != 'student' && $data['edit_type'] != 'teacher')
		{
			$this->redirect();
		}
		if ($data['id'] != '')
		{
			if ($data['id'] <= 0)
			{
				$data['config'] = new Evaluation_config_obj();
				$data['config']->state = 0;
				$data['config']->id = 0;
				$data['config']->description = '';
				$data['config']->type = $data['edit_type'];
				$data['config']->addition = 2;
				$data['choice_list'] = array();
				$data['blank_list'] = array();
				$this->load->view('ta/evaluation/evaluation/edit_config', $data);
				return;
			}
			$data['config'] = $this->Mta_evaluation->get_evaluation_config($data['id']);
			if (!$data['config']->is_error())
			{
				$question = $this->Mta_evaluation->get_defaults($data['config']);
				$data['choice_list'] = $question['choice'];
				$data['blank_list'] = $question['blank'];
				$this->load->view('ta/evaluation/evaluation/edit_config', $data);
				return;
			}
		}
		$data['config_list'] = $this->Mta_evaluation->get_evaluation_config($data['edit_type'], true);
		$this->load->view('ta/evaluation/evaluation/view_config', $data);
	}
	
	public function search_question()
	{
		$type = $this->input->get('type');
		$key = $this->input->get('key');
		$keys = explode(' ', $key);
		foreach ($keys as $index => $value)
		{
			if ($value == '')
			{
				unset($keys[$index]);
			}
		}
		$data = $this->Mta_evaluation->search_default($type, $keys);
		echo json_encode($data);
		exit();
	}
	
	public function delete()
	{
		$type = $this->input->get('type');
		$id = $this->input->get('id');
		if ($this->Mta_site->site_config['ta_evaluation_config_' . $type] != $id)
		{
			$this->Mta_evaluation->set_config_state($id, 2);
		}
		redirect(base_url('ta/evaluation/manage/evaluation/edit?type=' . $type));
	}
	
	public function lock()
	{
		$type = $this->input->get('type');
		$id = $this->input->get('id');
		$this->Mta_evaluation->set_config_state($id, 1);
		redirect(base_url('ta/evaluation/manage/evaluation/edit?type=' . $type));
	}
	
	
	public function submit()
	{
		//echo 1;
		$data = json_decode($this->input->post('json'));
		/** Validate the input questions */
		foreach ($data->question as $index => $question)
		{
			if ($question->id > 0)
			{
				$question_obj = $this->Mta_evaluation->get_default_by_id($question->id);
				if ($question_obj->is_error())
				{
					echo 'question id validation error';
					exit();
				}
				if ($question_obj->type != $question->type)
				{
					echo 'question type validation error';
					exit();
				}
				if ($question_obj->state > 0 && $question_obj->content != $question->content)
				{
					echo 'question state validation error';
					exit();
				}
			}
			else if ($question->type != 'choice' && $question->type != 'blank')
			{
				echo 'question type validation error';
				exit();
			}
		}
		/** Validate the input config */
		if ($data->id > 0)
		{
			$config = $this->Mta_evaluation->get_evaluation_config($data->id);
			if ($config->is_error())
			{
				echo 'config id validation error';
				exit();
			}
			if ($config->type != $data->type)
			{
				echo 'config type validation error';
				exit();
			}
			if ($config->state != 0)
			{
				echo 'config state validation error';
				exit();
			}
		}
		else if ($data->type != 'student' && $data->type != 'teacher')
		{
			echo 'config type validation error';
			exit();
		}
		/** Update and create the questions */
		$choice_list = array();
		$blank_list = array();
		foreach ($data->question as $index => $question)
		{
			if ($question->id > 0)
			{
				$this->Mta_evaluation->edit_default($question->id, $question->content);
			}
			else
			{
				$question->id = $this->Mta_evaluation->create_default($question->type, $question->content);
			}
			if ($question->type == 'choice')
			{
				$choice_list[] = $question->id;
			}
			else
			{
				$blank_list[] = $question->id;
			}
		}
		/** Update or create the config */
		if ($data->id > 0)
		{
			$this->Mta_evaluation->edit_config($data->id, $data->description, $choice_list, $blank_list, $data->addition, $_SESSION['userid']);
		}
		else
		{
			$data->id = $this->Mta_evaluation->create_config($data->type, $data->description, $choice_list,
			                                                 $blank_list, $data->addition, $_SESSION['userid']);
		}
		if ($data->active == 'true')
		{
			$this->Mta_evaluation->set_default_config($data->id, $data->type);
		}
		echo 'success';
		exit();
	}
	
	public function settime()
	{
		$start = $this->input->get('start');
		$end = $this->input->get('end');
		
		if ($start > 0 && strtotime($end) > strtotime($start))
		{
			$this->Mta_evaluation->set_config_state($this->Mta_site->site_config['ta_evaluation_config_student'], 1);
			$this->Mta_evaluation->set_config_state($this->Mta_site->site_config['ta_evaluation_config_teacher'], 1);
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
