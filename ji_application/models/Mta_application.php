<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mta_application extends CI_Model
{
	const TABLE_OPEN   = 'ji_ta_application_open';
	const TABLE_RECORD = 'ji_ta_application_record';
	
	/**
	 * Mta_application constructor.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->library('Course_application_obj');
		$this->load->library('Application_record_obj');
	}
	
	/**
	 * 使用 ID 获取课程
	 * @param int $id
	 * @return Course_application_obj
	 */
	public function get_course_by_id($id)
	{
		$query = $this->db->get_where($this::TABLE_OPEN, array('id' => $id));
		$course = new Course_application_obj($query->row(0));
		return $course;
	}
	
	/**
	 * @param int|string $USER_ID
	 * @param int|string $course_id
	 * @param string     $apply_data
	 * @param int        $state
	 */
	public function create_student_apply($USER_ID, $course_id, $apply_data, $state)
	{
		$data = array(
			'USER_ID'    => $USER_ID,
			'course_id'  => $course_id,
			'apply_data' => base64_encode($apply_data),
			'state'      => $state
		);
		$this->db->insert($this::TABLE_RECORD, $data);
	}
	
	/**
	 * @param int    $id
	 * @param string $apply_data
	 * @param int    $state
	 */
	public function update_student_apply($id, $apply_data, $state)
	{
		$this->db->update($this::TABLE_RECORD, array(
			'state'      => $state,
			'apply_data' => base64_encode($apply_data)
		), array('id' => $id));
	}
	
	
	/**
	 * @param int|string $user_id
	 * @param int|string $course_id
	 * @return array|Application_record_obj
	 */
	public function get_student_apply($user_id, $course_id = '')
	{
		if ($course_id != '')
		{
			$query = $this->db->get_where($this::TABLE_RECORD, array(
				'USER_ID' => $user_id, 'course_id' => $course_id
			));
			return new Application_record_obj($query->row(0));
		}
		$query = $this->db->get_where($this::TABLE_RECORD, array('USER_ID' => $user_id));
		$apply_list = array();
		foreach ($query->result() as $row)
		{
			$record = new Application_record_obj($row);
			if (!$record->is_error())
			{
				$apply_list[] = $record;
			}
		}
		return $apply_list;
	}
	
	/**
	 * @return array
	 */
	public function get_open_list()
	{
		$query = $this->db->select('*')->from($this::TABLE_OPEN)
		                  ->where(array(
			                          'XN'    => $this->Mta_site->site_config['ta_application_year'],
			                          'XQ_JI' => $this->Mta_site->site_config['ta_application_term']
		                          ))
		                  ->get();
		$open_list = array();
		foreach ($query->result() as $row)
		{
			$open = new Course_application_obj($row);
			if (!$open->is_error())
			{
				$open_list[] = $open;
			}
		}
		return $open_list;
	}
	
	/**
	 * 获取申请状态（-1：未开始；0：正在进行；1：已结束）
	 * @return int
	 */
	public function get_evaluation_state()
	{
		$start = strtotime($this->Mta_site->site_config['ta_recruitment_start']);
		$end = strtotime($this->Mta_site->site_config['ta_recruitment_end']);
		$now = strtotime(date('Y-m-d'));
		if ($now < $start)
		{
			return -1;
		}
		else if ($now > $end)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}