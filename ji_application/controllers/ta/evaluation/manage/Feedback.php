<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Feedback
 *
 * Controller ta/evaluation/manage/feedback
 *
 * @category   ta
 * @package    ta/evaluation/manage
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mmanage
 * @uses       Mta_feedback
 * @uses       Feedback_obj
 */
class Feedback extends TA_Controller
{
	/**
	 * Feedback constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'manage';
		$this->data['page_name'] = 'TA Evaluation System: Feedbacks';
		$this->data['banner_id'] = 4;
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
		redirect(base_url('ta/evaluation/manage/feedback/view/' . $state . '/' . $id));
	}

	/**
	 * Manage check the view list
	 *
	 * @param string $state
	 * @uses CI_Pagination
	 */
	public function view($state)
	{
		/** initialize */
		$data = $this->data;

		$state_array = $this->Mta_feedback->get_state_array(Feedback_obj::STATE_MANAGE, $state);
		if ($state_array == NULL)
		{
			$this->index(min(max($state, 1), 4));
		}
		$data['list'] =
			$this->Mta_feedback->show_list($_SESSION['userid'], Feedback_obj::STATE_MANAGE,
			                               $state_array);

		/** pagination */
		$this->load->library('pagination');
		$config['use_page_numbers'] = true;
		$config['prefix'] = 'ta/evaluation/manage/feedback/view/' . $state . '/';
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
	 * Manage check one feedback
	 *
	 * @param int $id feedback_id
	 */
	public function check($id)
	{
		$data = $this->data;
		$data['feedback'] = $this->Mta_feedback->get_feedback_by_id($id);
		if ($data['feedback']->is_error())
		{
			$this->index();
		}

		$data['state_id'] = $this->input->get('state');
		$data['page_id'] = $this->input->get('page');
		$data['feedback']->set_ta()->set_course()->set_replys(Feedback_obj::STATE_MANAGE);


		$this->load->model('Mmanage');
		if ($this->Mmanage->get_manage_by_id($_SESSION['userid'])->user_id == NULL)
		{
			$this->index();
		}

		$data['state'] = $data['feedback']->get_state_str();
		$this->load->view('ta/evaluation/feedback/check', $data);
	}

	/**
	 * reply a feddback through ajax
	 *
	 * @echo string result
	 */
	public function reply()
	{
		$this->load->model('Mmanage');
		$this->load->library('Course_obj');
		$id = $this->input->post('id');
		$user_id = $_SESSION['userid'];
		$content = $this->input->post('content');
		$change_flag = $this->input->post('change_flag') == 'true' ? 1 : 0;

		$feedback = $this->Mta_feedback->get_feedback_by_id($id);
		if ($feedback->is_error())
		{
			echo 'error feedback id';
		}
		else if ($this->Mmanage->get_manage_by_id($user_id)->user_id == NULL)
		{
			echo 'error user id';
		}
		else if ($feedback->is_manage())
		{
			echo "can't reply twice";
		}
		else if (!$this->Mta_feedback->examine_content($content))
		{
			echo 'The content must be ' . $this->Mta_site->site_config['ta_feedback_content_min'] .
			     '-' . $this->Mta_site->site_config['ta_feedback_content_max'] . ' letters';
		}
		else
		{
			$this->Mta_feedback->reply($id, Feedback_obj::STATE_MANAGE, $user_id, $content,
			                           $change_flag);
			echo 'success';
		}
		exit();
	}
	
	/**
	 * close a feedback through ajax
	 *
	 * @echo string result
	 */
	public function close()
	{
		$this->load->model('Mmanage');
		$id = $this->input->get('id');
		$feedback = $this->Mta_feedback->get_feedback_by_id($id);
		if ($feedback->is_error())
		{
			echo 'error feedback id';
		}
		else if ($this->Mmanage->get_manage_by_id($_SESSION['userid'])->user_id == NULL)
		{
			echo 'error user id';
		}
		else
		{
			$this->Mta_feedback->close($id);
			echo 'success';
		}
		exit();
	}
	
}
