<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mta_application extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('Course_application_obj');
	}
	
	/**
	 * 使用 ID 获取课程
	 * @param int $id
	 * @return Course_application_obj
	 */
	public function get_course_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_application_open', array('id' => $id));
		$course = new Course_application_obj($query->row(0));
		return $course;
	}
	
	public function get_open_list()
	{
		$query = $this->db->select('*')->from('ji_ta_application_open')
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
	
	
}