<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Search
 *
 * Controller ta/evaluation/manage/search
 *
 * @category   ta
 * @package    ta/evaluation/manage
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mta_search
 * @uses       Mta
 * @uses       Mcourse
 */
class Search extends TA_Controller
{
	
	/**
	 * Search constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'manage';
		$this->data['page_name'] = 'TA Evaluation System: Course';
		$this->data['banner_id'] = 3;
		$this->Mta_site->redirect_login($this->data['type']);
		$this->load->model('Mta_search');
	}
	
	/**
	 * Index page
	 */
	public function index()
	{
		$data = $this->data;
		$data['key'] = $this->input->get('key');
		$data['target'] = $this->input->get('type');
		$this->load->view('ta/evaluation/search/index', $data);
	}
	
	/**
	 * Redirect to the index page
	 */
	private function redirect()
	{
		redirect(base_url('ta/evaluation/manage/search'));
	}
	
	/**
	 * Check the info of a course
	 * @param int $id
	 */
	public function course($id)
	{
		$data = $this->data;
		
		$this->load->model('Mcourse');
		$data['course'] = $this->Mcourse->get_course_by_id($id);
		if ($data['course']->is_error())
		{
			$this->redirect();
		}
		
		$data['course']->set_ta()->set_feedback()->set_student();
		$data['key'] = $this->input->get('key');
		$data['target'] = $this->input->get('type');
		if ($data['target'] == 'course' || $data['target'] == 'ta')
		{
			$data['return'] = 'url="?type=' . $data['target'] . '&key=' . $data['key'] . '" back="2"';
		}
		else if ($data['target'] == 'feedback')
		{
			$data['return'] = 'url="/feedback/check/' . $data['key'] . '" back="3"';
		}
		
		$this->load->view('ta/evaluation/search/course', $data);
		
	}
	
	/**
	 * Check the info of a TA
	 * @param int $id
	 */
	public function ta($id)
	{
		$data = $this->data;
		
		$this->load->model('Mta');
		$data['ta'] = $this->Mta->get_ta_by_id($id);
		if ($data['ta']->is_error())
		{
			$this->redirect();
		}
		
		$data['ta']->set_course()->set_feedback();
		$data['key'] = $this->input->get('key');
		$data['target'] = $this->input->get('type');
		if ($data['target'] == 'course' || $data['target'] == 'ta')
		{
			$data['return'] = 'url="?type=' . $data['target'] . '&key=' . $data['key'] . '" back="2"';
		}
		else if ($data['target'] == 'feedback')
		{
			$data['return'] = 'url="/feedback/check/' . $data['key'] . '" back="3"';
		}
		
		$this->load->view('ta/evaluation/search/ta', $data);
	}
	
	/**
	 * search through ajax
	 *
	 * @echo string result
	 */
	public function view()
	{
		$item = $this->input->get('item');
		$key = $this->input->get('key');
		$keys = explode(' ', $key);
		foreach ($keys as $index => $value)
		{
			if ($value == '')
			{
				unset($keys[$index]);
			}
		}
		$data = array();
		if ($item == 'course')
		{
			$data = $this->Mta_search->search_course($keys);
		}
		else if ($item == 'ta')
		{
			$data = $this->Mta_search->search_ta($keys);
		}
		echo json_encode($data);
		exit();
	}
	
	
}
