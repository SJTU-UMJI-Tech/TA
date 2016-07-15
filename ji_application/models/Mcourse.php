<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mcourse extends CI_Model
{
	/**
	 * Mcourse constructor.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->library('Course_obj');
	}

	/**
	 * @param int $BSID
	 * @return Course_obj
	 */
	public function get_course_by_id($BSID)
	{
		$query = $this->db->get_where('ji_course_open', array('BSID' => $BSID, 'SCBJ' => 'N'));
		$course = new Course_obj($query->row(0));
		return $course;
	}

	/**
	 * @param array  $value
	 * @param string $key
	 * @return array
	 */
	public function get_now_course($value, $key = 'BSID')
	{
		$course_list = array();
		if (!is_array($value))
		{
			$value = array($value);
		}
		else if (count($value) == 0)
		{
			return $course_list;
		}
		$query = $this->db->select('*')->from('ji_course_open')->where(array(
			                                                               'XQ'   => $this->Mta_site->site_config['ji_academic_term'],
			                                                               'XN'   => $this->Mta_site->site_config['ji_academic_year'],
			                                                               'SCBJ' => 'N'))
		                  ->where_in($key, $value)->get();

		foreach ($query->result() as $row)
		{
			$course = new Course_obj($row);
			if (!$course->is_error() && $course->XQ_JI == $this->Mta_site->site_config['ji_um_term'])
			{
				$course_list[] = $course;
			}
		}
		return $course_list;
	}

	/**
	 * @param int $BSID
	 * @return array
	 */
	public function get_course_ta($BSID)
	{
		$this->load->model('Mta');
		$query = $this->db->select('USER_ID')->from('ji_course_ta')->where(array(
			                                                                   'BSID' => $BSID,
			                                                                   'SCBJ' => 'N'))
		                  ->get();
		$user_list = array();
		foreach ($query->result() as $user)
		{
			$user_list[] = $user->USER_ID;
		}
		$ta_list = $this->Mta->get_ta_by_id($user_list);
		return $ta_list;
	}

	/**
	 * @param int $BSID
	 * @return array
	 */
	public function get_course_feedback($BSID)
	{
		$this->load->library('Feedback_obj');
		$query =
			$this->db->select('*')->from('ji_ta_feedback')->where(array('BSID' => $BSID))->get();
		$feedback_list = array();
		foreach ($query->result() as $result)
		{
			$feedback = new Feedback_obj($result);
			if (!$feedback->is_error())
			{
				$feedback_list[] = $feedback;
			}
		}
		return $feedback_list;
	}

	/**
	 * @param int $BSID
	 * @return array
	 */
	public function get_course_student($BSID)
	{
		$this->load->model('Mstudent');
		$query = $this->db->select('USER_ID')->from('ji_course_select')->where(array(
			                                                                       'BSID' => $BSID,
			                                                                       'SCBJ' => 'N'))
		                  ->get();
		$user_list = array();
		foreach ($query->result() as $user)
		{
			$user_list[] = $user->USER_ID;
		}
		$student_list = array();
		foreach ($user_list as $userid)
		{
			$student = $this->Mstudent->get_student_by_id($userid);
			if (!$student->is_error())
			{
				$student_list[] = $student;
			}
		}
		return $student_list;
	}

	/**
	 * @param int $BSID
	 * @return array
	 */
	public function get_course_question($BSID)
	{
		$this->load->library('Evaluation_obj');
		$query = $this->db->get_where('ji_ta_evaluation_question', array('BSID' => $BSID));
		$question_list = array();
		foreach ($query->result() as $row)
		{
			$question = new Evaluation_question_obj($row);
			if (!$question->is_error())
			{
				$question_list[] = $question;
			}
		}
		return $question_list;
	}

	public function get_course_answer($BSID)
	{
		$this->load->model('Mta_evaluation');
		$answer_list = $this->Mta_evaluation->get_answer($BSID, $_SESSION['userid']);
		return $answer_list;
	}

}