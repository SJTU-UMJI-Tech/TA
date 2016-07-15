<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mta_search extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		//$this->load->model('Mta_site');
	}
	
	public function search_ta($keys)
	{
		$this->load->library('Ta_obj');
		$this->db->select('*')->from('ji_ta_info');
		foreach ($keys as $key)
		{
			$this->db->group_start()->or_like('USER_ID', $key)->or_like('name_ch', $key)
			         ->or_like('name_en', $key)->or_like('email', $key)->or_like('phone', $key)
			         ->group_end();
		}
		$query = $this->db->limit(50)->order_by('USER_ID', 'ASC')->get();
		$ta_list = array();
		foreach ($query->result() as $row)
		{
			$ta_list[] = new Ta_obj($row);
		}
		return $ta_list;
	}

	public function search_course($keys)
	{
		$this->load->library('Course_obj');
		$this->db->select('*')->from('ji_course_open');
		foreach ($keys as $key)
		{
			$this->db->group_start()->or_like('XN', $key)->or_like('XQ', $key)
			         ->or_like('KCDM', $key)->or_like('KCZWMC', $key)->or_like('XM', $key)
			         ->or_like('BSID', $key)->group_end();
		}
		$query = $this->db->limit(50)->order_by('KCDM', 'ASC')->order_by('XM', 'ASC')
		                  ->order_by('CREATE_TIMESTAMP', 'DESC')->get();
		$course_list = array();
		foreach ($query->result() as $row)
		{
			$course_list[] = new Course_obj($row);
		}
		return $course_list;
	}
}