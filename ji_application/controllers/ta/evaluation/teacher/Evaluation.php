<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends TA_Controller
{
	/**
	 * Evaluation constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'teacher';
		$this->data['page_name'] = 'TA Evaluation System: Evaluation Setup';
		$this->data['banner_id'] = 2;
		$this->Mta_site->redirect_login($this->data['type']);
		$this->load->model('Mta_evaluation');
		$this->load->model('Mteacher');
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
			redirect(base_url('ta/evaluation/teacher/evaluation/view'));
		}
		else
		{
			redirect(base_url('ta/evaluation/teacher/evaluation/check/' . $BSID));
		}
	}

	/**
	 * @param int $BSID
	 * @return Course_obj
	 */
	private function validate_course($BSID)
	{
		$this->load->model('Mcourse');
		if (!$this->Mteacher->is_now_course($_SESSION['userid'], $BSID))
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
		$this->load->library('Ta_obj');
		$data['course_list'] = $this->Mteacher->get_now_course($_SESSION['userid']);
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
		$data['config'] = $this->Mta_evaluation->get_evaluation_config('student');
		$this->load->view('ta/evaluation/evaluation/list', $data);
	}

	public function check($BSID)
	{
		$data = $this->data;
		$data['course'] = $this->validate_course($BSID);

		$data['course']->set_ta()->set_question();
		$this->load->view('ta/evaluation/evaluation/check', $data);
	}

	/**
	 * Add a question
	 * @param $BSID
	 */
	public function add($BSID)
	{
		$data = $this->data;
		$data['course'] = $this->validate_course($BSID);

		$data['course']->set_ta()->set_question();

		if (count($data['course']->question_list) >= 2)
		{
			$this->index($BSID);
		}

		$this->load->view('ta/evaluation/evaluation/add_question', $data);
	}

	/**
	 * Evaluate TA(s)
	 * @param $BSID
	 */
	public function evaluate($BSID)
	{
		$data = $this->data;
		$data['course'] = $this->validate_course($BSID);
		$data['course']->set_ta();
		$data['choice_list'] = array();
		for ($index = 0; $index < 5; $index++)
		{
			$data['choice_list'][] = new stdClass();
		}
		$this->load->view('ta/evaluation/evaluation/evaluation', $data);
	}

	/**
	 * Add a question through ajax
	 *
	 * @echo string result
	 */
	public function question()
	{
		$content = $this->input->get('content');
		$type = $this->input->get('type');
		if ($type != 'choice' && $type != 'blank')
		{
			echo 'error question type';
			exit();
		}
		if (!$this->Mta_evaluation->examine_content($content))
		{
			echo "the content is too short or too long";
			exit();
		}
		$BSID = $this->input->get('BSID');
		if (!$this->Mteacher->is_now_course($_SESSION['userid'], $BSID))
		{
			echo 'error';
			exit();
		}
		$this->load->model('Mcourse');
		$question_list = $this->Mcourse->get_course_question($BSID);
		if (count($question_list) >= 2)
		{
			echo 'You have added two question!';
			exit();
		}
		$this->Mta_evaluation->create_question($BSID, $type, $content);
		echo 'success';
		exit();
	}

	public function answer()
	{
		echo json_decode($this->input->post('answer'));
		exit();
	}
}
