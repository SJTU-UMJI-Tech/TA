<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mteacher extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
	    $this->load->model('Mta_site');
	    $this->load->library('Teacher_obj');
    }
	
	/**
	 * @param $id
	 * @return array
	 */
	public function get_now_course($id)
	{
		$this->load->model('Mcourse');
		$this->load->library('Course_obj');
		$course_list = $this->Mcourse->get_now_course($id, 'USER_ID');
		return $course_list;
	}

	/**
	 * @param $user_id
	 * @param $BSID
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