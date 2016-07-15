<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Mstudent extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mta_site');
		$this->load->library('Student_obj');
	}

	public function get_student_by_id($id)
	{
		$query = $this->db->get_where('ji_students', array('student_id' => $id));
		$student = new Student_obj($query->row(0));
		return $student;
	}

	public function get_all_course($id)
	{
		$query = $this->db->select('BSID')->from('ji_course_select')->where(array(
			                                                                    'USER_ID' => $id,
			                                                                    'SCBJ'    => 'N'))
		                  ->get();
		return $query->result();
	}

	/**
	 * @param $id
	 * @return array
	 */
	public function get_now_course($id)
	{
		$this->load->model('Mcourse');
		$this->load->library('Course_obj');
		foreach ($this->get_all_course($id) as $course)
		{
			$course_list[] = $course->BSID;
		}
		$course_list = $this->Mcourse->get_now_course($course_list);
		return $course_list;
	}

	/**
	 * @param $user_id
	 * @param $BSID
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