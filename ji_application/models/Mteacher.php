<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Mteacher
 *
 * @category   common
 * @package    common
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Teacher_obj
 * @uses       Mcourse
 */
class Mteacher extends CI_Model
{
	/**
	 * Mteacher constructor.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->library('Teacher_obj');
	}
	
	/**
	 * 使用 ID 获取老师
	 * @param int $id
	 * @return Teacher_obj
	 */
	public function get_teacher_by_id($id)
	{
		$query = $this->db->get_where('ji_user_detail', array('user_id' => $id));
		$teacher = new Teacher_obj($query->row(0));
		return $teacher;
	}
	
	/**
	 * 获取当前课程
	 * @param int $id
	 * @return array
	 */
	public function get_now_course($id)
	{
		$this->load->model('Mcourse');
		$course_list = $this->Mcourse->get_now_course($id, 'USER_ID');
		return $course_list;
	}
	
	/**
	 * 是否为当前课程
	 * @param int $user_id
	 * @param int $BSID
	 * @return bool
	 */
	public function is_now_course($user_id, $BSID)
	{
		foreach ($this->get_now_course($user_id) as $course)
		{
			if ($course->BSID == $BSID)
			{
				return true;
			}
		}
		return false;
	}
}