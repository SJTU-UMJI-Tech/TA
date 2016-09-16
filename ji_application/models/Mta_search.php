<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Mta_search
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Ta_obj
 * @uses       Course_obj
 */
class Mta_search extends CI_Model
{
	/**
	 * Mta_search constructor.
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 搜索 TA
	 * @param array $keys
	 * @return array
	 */
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
	
	/**
	 * 搜索课程
	 * @param array $keys
	 * @return array
	 */
	public function search_course($keys)
	{
		$this->load->library('Course_obj');
		$this->db->select('*')->from('kkxx');
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