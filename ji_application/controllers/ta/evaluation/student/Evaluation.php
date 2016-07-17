<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Evaluation
 *
 * Controller ta/evaluation/student/evaluation
 *
 * @category   ta
 * @package    ta/evaluation/student
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mstudent
 * @uses       Mta_evaluation
 * @uses       Mta
 * @uses       Mcourse
 * @uses       Evaluation_obj
 */
class Evaluation extends TA_Controller
{
	
	/**
	 * Evaluation constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'student';
		$this->data['page_name'] = 'TA Evaluation System: TA Evaluation';
		$this->data['banner_id'] = 2;
		$this->Mta_site->redirect_login($this->data['type']);
		$this->load->model('Mstudent');
		$this->load->model('Mta_evaluation');
		$this->load->library('Evaluation_obj');
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
		$course = $this->Mstudent->is_now_course($_SESSION['userid'], $BSID);
		if ($course->is_error())
		{
			$this->index();
		}
		return $course;
	}
	
	/**
	 * View the evaluation list
	 */
	public function view()
	{
		$data = $this->data;
		$this->load->library('Course_obj');
		$this->load->library('Ta_obj');
		$data['course_list'] = $this->Mstudent->get_now_course($_SESSION['userid']);
		foreach ($data['course_list'] as $course)
		{
			/** @var $course Course_obj */
			$course->set_ta();
			foreach ($course->ta_list as $ta)
			{
				/** @var $ta Ta_obj */
				$ta->set_answer($course->BSID);
			}
		}
		$data['edit_max'] = $this->Mta_site->site_config['ta_evaluation_edit_max'];
		$this->load->view('ta/evaluation/evaluation/list', $data);
	}
	
	/**
	 * Evaluate a TA
	 * @param int $BSID
	 */
	public function evaluate($BSID)
	{
		$data = $this->data;
		if ($data['state'] < 0)
		{
			$this->index();
		}
		$data['course'] = $this->validate_course($BSID);
		$data['course']->set_ta();
		$data['ta'] = NULL;
		foreach ($data['course']->ta_list as $ta)
		{
			/** @var $ta Ta_obj */
			if ($ta->USER_ID == $this->input->get('ta_id'))
			{
				$data['ta'] = $ta;
				break;
			}
		}
		if ($data['ta'] == NULL)
		{
			$this->index();
		}
		$data['ta']->set_answer($BSID);
		$answer_count = count($data['ta']->answer_list);
		if ($answer_count == 0)
		{
			if ($data['state'] == 1)
			{
				$this->index();
			}
			else
			{
				$data['answer'] = json_encode(array());
				$data['operation'] = 'evaluate';
			}
		}
		else
		{
			$data['answer'] = json_encode($data['ta']->answer_list[$answer_count - 1]->content);
			$data['operation'] = $answer_count >=
			                     $this->Mta_site->site_config['ta_evaluation_edit_max'] ? 'review' : 'edit';
		}
		$data['course']->set_question();
		$config = $this->Mta_evaluation->get_evaluation_config($this->data['type']);
		$default = $this->Mta_evaluation->get_defaults($config);
		$data['choice_list'] = $default['choice'];
		$data['blank_list'] = $default['blank'];
		$this->load->view('ta/evaluation/evaluation/evaluation', $data);
	}
	
	/**
	 * Make an evaluation through ajax
	 *
	 * @return string result
	 */
	public function answer()
	{
		$BSID = $this->input->post('BSID');
		$ta_id = $this->input->post('ta_id');
		$course = $this->validate_course($BSID);
		$course->set_ta();
		$ta = NULL;
		foreach ($course->ta_list as $_ta)
		{
			/** @var $_ta Ta_obj */
			if ($_ta->USER_ID == $ta_id)
			{
				$ta = $_ta;
				break;
			}
		}
		if ($ta == NULL)
		{
			echo 'TA not found!';
			exit();
		}
		$ta->set_answer($BSID);
		if (count($course->answer_list) >= $this->Mta_site->site_config['ta_evaluation_edit_max'])
		{
			echo 'You have no chance to edit';
			exit();
		}
		$course->set_question();
		$answer_list = $this->input->post('answer');
		$data = array('choice' => array(), 'blank' => array(), 'addition' => array());
		foreach ($answer_list as $answer)
		{
			if ($answer['num'] <= 0)
			{
				continue;
			}
			switch ($answer['type'])
			{
			case 'choice':
			case 'blank':
			case 'addition':
				if ($this->Mta_evaluation->examine_content($answer['answer']))
				{
					$data[$answer['type']][$answer['num']] = $answer['answer'];
				}
				else
				{
					echo 'content error';
					exit();
				}
			}
		}
		$config = $this->Mta_evaluation->get_evaluation_config($this->data['type']);
		if ($config->is_error())
		{
			echo 'config error';
			exit();
		}
		$config = array(
			'choice'   => $config->choice,
			'blank'    => $config->blank,
			'addition' => count($course->question_list));
		foreach ($config as $key => $value)
		{
			for ($index = 1; $index <= $value; $index++)
			{
				if (!isset($data[$key][$index]))
				{
					echo 'validation error';
					exit();
				}
			}
		}
		$this->Mta_evaluation->create_answer($BSID, $_SESSION['userid'], $ta_id,
		                                     $this->data['type'], $data);
		echo 'success';
		exit();
	}
}
