<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Mstudent
 *
 * @category   common
 * @package    common
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mstudent
 * @uses       Mcourse
 * @uses       Student_obj
 */
class Mstudent extends CI_Model
{
	/**
	 * Mstudent constructor.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->library('Student_obj');
	}
	
	/**
	 * 使用 ID 获取学生
	 * @param int $id
	 * @return Student_obj
	 */
	public function get_student_by_id($id)
	{
		$query = $this->db->get_where('ji_students', array('student_id' => $id));
		$student = new Student_obj($query->row(0));
		return $student;
	}
	
	/**
	 * 获取所有课程
	 * @param int $id
	 * @return array
	 */
	public function get_all_course($id)
	{
		$query = $this->db->select('BSID')->from('ji_course_select')
		                  ->where(array('USER_ID' => $id, 'SCBJ' => 'N'))->get();
		return $query->result();
	}
	
	/**
	 * 获取当前课程
	 * @param $id
	 * @return array
	 */
	public function get_now_course($id)
	{
		$this->load->model('Mcourse');
		$course_list = array();
		foreach ($this->get_all_course($id) as $course)
		{
			$course_list[] = $course->BSID;
		}
		$course_list = $this->Mcourse->get_now_course($course_list);
		return $course_list;
	}
	
	/**
	 * 是否是当前课程
	 * @param int $user_id
	 * @param int $BSID
	 * @return Course_obj
	 */
	public function is_now_course($user_id, $BSID)
	{
		foreach ($this->get_now_course($user_id) as $course)
		{
			if ($course->BSID == $BSID)
			{
				return $course;
			}
		}
		return new Course_obj();
	}
}