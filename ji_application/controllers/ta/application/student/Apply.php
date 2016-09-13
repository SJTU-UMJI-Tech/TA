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
	
	/**
	 * @param $id
	 * @return Course_application_obj
	 */
	private function validate_course($id)
	{
		$course = $this->Mta_application->get_course_by_id($id);
		if ($course->is_error())
		{
			$this->redirect();
		}
		if ($course->state > 1)
		{
			$this->redirect();
		}
		return $course;
	}
	
	public function index()
	{
		$data = $this->data;
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
			$data['course'] = $this->validate_course($data['id']);
			//$data['class'] = $list;
			$this->load->view('ta/application/student/course', $data);
		}
		else
		{
			$this->load->view('ta/application/student/list', $data);
		}
	}
	
	private function redirect()
	{
		redirect('ta/application/student/apply');
	}
	
	public function detail()
	{
		$this->load->model('Mstudent');
		$this->load->model('Mta');
		$data = $this->data;
		$id = $this->input->get('id');
		$_SESSION['userid'] = '515370910207';
		
		$data['course'] = $this->validate_course($id);
		
		$data['student'] = $this->Mstudent->get_student_by_id($_SESSION['userid']);
		if ($data['student']->is_error())
		{
			$this->redirect();
		}
		$data['student']->set_detail();
		
		$data['ta'] = $this->Mta->get_ta_by_id($_SESSION['userid']);
		if (!$data['ta']->is_error())
		{
			$data['ta']->set_course();
		}
		
		$data['apply'] = $this->Mta_application->get_student_apply($_SESSION['userid'], $id);
		
		$this->load->view('ta/application/student/detail', $data);
	}
	
	public function submit()
	{
		$course_id = $this->input->post('course_id');
		/** Examine the course */
		$course = $this->Mta_application->get_course_by_id($course_id);
		if ($course->is_error())
		{
			echo 'Course unfound!';
			exit();
		}
		/** Examine and set the state of application*/
		$apply = $this->Mta_application->get_student_apply($_SESSION['userid'], $course_id);
		if (!$apply->is_error())
		{
			if ($apply->state != 0)
			{
				echo 'You can\'t edit it anymore!';
				exit();
			}
		}
		$state = $this->input->post('mode') == 'submit';
		/** Examine the necessary information */
		$apply_data = $this->input->post('json');
		$data = json_decode($apply_data, true);
		$required = array(
			'english-name'      => 'English name',
			'phone'             => 'Phone',
			'gender'            => 'Gender',
			'email'             => 'Email',
			'skype'             => 'Skype account',
			'honorcode-access'  => 'Permission of accessing honor code',
			'honorcode-violate' => 'Honor code violation'
		);
		$processed = array();
		foreach ($data as $content)
		{
			if (is_array($content))
			{
				foreach ($content as $name => $item)
				{
					if (!is_array($item) && array_key_exists($name, $required))
					{
						if ($item != '')
						{
							unset($required[$name]);
						}
					}
				}
			}
		}
		if (count($required) > 0)
		{
			foreach ($required as $item)
			{
				echo $item . ' not completed';
				exit();
			}
		}
		/** Update the application */
		if ($apply->is_error())
		{
			$this->Mta_application->create_student_apply($_SESSION['userid'], $course_id, $apply_data, $state);
		}
		else
		{
			$this->Mta_application->update_student_apply($apply->id, $apply_data, $state);
		}
		
		/** Update the information of TA */
		$this->load->model('Mta');
		$this->Mta->update_ta_info($_SESSION['userid'], $data['basic']['english-name'], $data['basic']['gender'],
		                           $data['basic']['email'], $data['basic']['phone'], $data['basic']['skype'],
		                           isset($data['basic']['address']) ? $data['basic']['address'] : NULL);
		echo 'success';
		exit();
	}
	
	public function myapply()
	{
		$this->load->model('Mapply');
		$_SESSION['user_id'] = '515370910207';
		$data['list'] = $this->Mta_application->get_student_apply($_SESSION['user_id']);
		foreach ($data['list'] as $record)
		{
			/** @var $record Application_record_obj */
			$record->set_course();
		}
		$this->load->view('ta/application/student/myapply', $data);
	}
	
	private function temp()
	{
		$query = $this->db->get('ji_ta_config');
		$new = array();
		foreach ($query->result() as $item)
		{
			$new[] = array(
				'name'   => $item->obj,
				'key'    => $item->data,
				'module' => 'ta'
			);
		}
		print_r($new);
		$this->db->insert_batch('ji_option', $new);
	}
}
