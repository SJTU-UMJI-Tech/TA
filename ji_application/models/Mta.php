<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Mta
 *
 * @category   common
 * @package    common
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mcourse
 * @uses       Mta_evaluation
 * @uses       Ta_obj
 * @uses       Feedback_obj
 */
class Mta extends CI_Model
{
	const TABLE = 'ji_ta_info';
	
	/**
	 * Mta constructor.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->library('Ta_obj');
	}
	
	/**
	 * 使用 ID 获取 TA
	 * @param int|array $id
	 * @return Ta_obj|array
	 */
	public function get_ta_by_id($id)
	{
		if (!is_array($id))
		{
			$query = $this->db->get_where($this::TABLE, array('USER_ID' => $id));
			$ta = new Ta_obj($query->row(0));
			return $ta;
		}
		if (count($id) == 0)
		{
			return array();
		}
		$query = $this->db->select('*')->from($this::TABLE)->where_in('USER_ID', $id)->get();
		$ta_list = array();
		foreach ($query->result() as $row)
		{
			$ta = new Ta_obj($row);
			if (!$ta->is_error())
			{
				$ta_list[] = $ta;
			}
		}
		return $ta_list;
	}
	
	/**
	 * 获取所有 TA
	 * @return array
	 */
	public function get_all_ta()
	{
		$query = $this->db->get($this::TABLE);
		$ta_list = array();
		foreach ($query->result() as $row)
		{
			$ta = new Ta_obj($row);
			if (!$ta->is_error())
			{
				$ta_list[] = $ta;
			}
		}
		return $ta_list;
	}
	
	/**
	 * 获取 TA 课程
	 * @param $id
	 * @return array
	 */
	public function get_ta_course($id)
	{
		$this->load->model('Mcourse');
		$query =
			$this->db->select('BSID')->from('ji_course_ta')->where(array('USER_ID' => $id))->get();
		$course_list = array();
		foreach ($query->result() as $course)
		{
			$course_list[] = $course->BSID;
		}
		$list = array();
		foreach ($course_list as $BSID)
		{
			$course = $this->Mcourse->get_course_by_id($BSID);
			if (!$course->is_error())
			{
				$list[] = $course;
			}
		}
		return $list;
	}
	
	/**
	 * 获取 TA 投诉
	 * @param int $id
	 * @return array
	 */
	public function get_ta_feedback($id)
	{
		$this->load->library('Feedback_obj');
		$query = $this->db->select('*')->from('ji_ta_feedback')->where(array('ta_id' => $id))->get();
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
	 * 获取 TA 评教答案
	 * @param int $id
	 * @param int $BSID
	 * @return array
	 */
	public function get_ta_answer($id, $BSID)
	{
		$this->load->model('Mta_evaluation');
		$answer_list = $this->Mta_evaluation->get_answer($BSID, $_SESSION['userid'], $id);
		return $answer_list;
	}
	
	/**
	 * 获取 TA 报告
	 * @param int $id
	 * @return array
	 */
	public function get_ta_report($id)
	{
		
		$report_list = array();
		
		return $report_list;
	}
	
	public function update_ta_info($id, $name_en, $gender, $email, $phone, $skype, $address = '')
	{
		$data = array(
			'name_en' => $name_en,
			'gender'  => $gender,
			'email'   => $email,
			'phone'   => $phone,
			'skype'   => $skype,
			'address' => $address
		);
		$ta = $this->get_ta_by_id($id);
		if ($ta->is_error())
		{
			$data['USER_ID'] = $id;
			$this->db->insert($this::TABLE, $data);
		}
		else
		{
			echo 2;
			exit();
			$this->db->update($this::TABLE, $data, array('USER_ID' => $id));
		}
	}
	
	
}