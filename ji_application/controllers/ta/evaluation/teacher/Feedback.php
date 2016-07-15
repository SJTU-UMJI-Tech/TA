<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends TA_Controller
{
	/**
	 * Feedback constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'teacher';
		$this->data['page_name'] = 'TA Evaluation System: Feedbacks';
		$this->data['banner_id'] = 3;
		$this->Mta_site->redirect_login($this->data['type']);
		$this->load->model('Mta_feedback');
		$this->load->library('Feedback_obj');
	}
	
	/**
	 * The index page will be redirected to the view list
	 * @param int $state
	 * @param int $id
	 */
	public function index($state = 1, $id = 1)
	{
		redirect(base_url('ta/evaluation/teacher/feedback/view/' . $state . '/' . $id));
	}
	
	/**
	 * Teacher check the view list
	 *
	 * @param string $state
	 * @uses CI_Pagination
	 */
	public function view($state)
	{
		/** initialize */
		$data = $this->data;
		$state_array = $this->Mta_feedback->get_state_array(Feedback_obj::STATE_TEACHER, $state);
		if ($state_array == NULL)
		{
			$this->index(min(max($state, 1), 3));
		}
		$data['list'] =
			$this->Mta_feedback->show_list($_SESSION['userid'], Feedback_obj::STATE_TEACHER,
			                               $state_array);

		/** pagination */
		$this->load->library('pagination');
		$config['use_page_numbers'] = true;
		$config['prefix'] = 'ta/evaluation/teacher/feedback/view/' . $state . '/';
		$config['first_url'] = '1';
		$config['total_rows'] = count($data['list']);
		$config['per_page'] = 20;
		$this->pagination->initialize($config);
		
		$current_page = floor(min(max($this->uri->segment(7), 1),
		                          ($config['total_rows'] - 1) / $config['per_page'] + 1));
		if ($this->uri->segment(7) != $current_page)
		{
			$this->index($state, $current_page);
		}
		$data['list'] = array_slice($data['list'], ($current_page - 1) * $config['per_page'],
		                            $config['per_page']);
		$data['page_id'] = $current_page;
		$data['state_id'] = $state;

		/** finalize */
		foreach ($data['list'] as $feedback)
		{
			/** @var $feedback Feedback_obj */
			$feedback->set_ta()->set_course();
		}
		$this->load->view('ta/evaluation/feedback/list', $data);
	}

	/**
	 * Teacher check one feedback
	 *
	 * @param int $id feedback_id
	 */
	public function check($id)
	{
		$data = $this->data;
		$data['feedback'] = $this->Mta_feedback->get_feedback_by_id($id);
		$data['state_id'] = $this->input->get('state');
		$data['page_id'] = $this->input->get('page');

		if ($data['feedback']->is_error())
		{
			$this->index();
		}

		$this->load->model('Mteacher');
		$this->load->library('Course_obj');

		$data['feedback']->set_ta()->set_course()->set_replys(Feedback_obj::STATE_TEACHER);


		foreach ($this->Mteacher->get_now_course($_SESSION['userid']) as $course)
		{
			if ($course->BSID == $data['feedback']->BSID)
			{
				$data['state'] = $data['feedback']->get_state_str();

				$this->load->view('ta/evaluation/feedback/check', $data);
				return;
			}
		}
		$this->index();

	}

	/**
	 * reply a feddback through ajax
	 *
	 * @echo string result
	 */
	public function reply()
	{
		$this->load->model('Mteacher');
		$this->load->library('Course_obj');
		$id = $this->input->post('id');
		$user_id = $_SESSION['userid'];
		$content = $this->input->post('content');

		$feedback = $this->Mta_feedback->get_feedback_by_id($id);
		if ($feedback->is_error())
		{
			echo 'error feedback id';
		}
		else
		{
			foreach ($this->Mteacher->get_now_course($_SESSION['userid']) as $course)
			{
				if ($course->BSID == $feedback->BSID)
				{
					if (!$feedback->is_manage())
					{
						echo "can't reply twice";
					}
					else if (!$this->Mta_feedback->examine_content($content))
					{
						echo "the content is too short or too long";
					}
					else
					{
						$this->Mta_feedback->reply($id, Feedback_obj::STATE_TEACHER, $user_id,
						                           $content);
						echo 'success';
					}
					exit();
				}
			}
		}
		echo 'error user id';
		exit();
	}

	
}
