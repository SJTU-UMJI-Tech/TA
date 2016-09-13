<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Application_record_obj extends My_obj
{
	/** -- The vars in the table `ji_application_record` -- */
	
	/** @var int    int(11)     ID */
	public $id;
	/** @var int    varchar(20) 用户 ID */
	public $USER_ID;
	/** @var int    varchar(100)课程 ID */
	public $course_id;
	/** @var int    int(4) */
	public $state;
	/** @var string text */
	public $apply_data;
	/** @var string text */
	public $addition;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp   更新时间 */
	public $UPDATE_TIMESTAMP;
	
	
	/** -- The vars defined for other uses -- */
	/** @var Course_application_obj */
	public $course;
	
	/**
	 * Application_record_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'id');
		if (!$this->is_error())
		{
			$this->apply_data = base64_decode($this->apply_data);
		}
	}
	
	/**
	 * @return $this
	 */
	public function set_course()
	{
		$this->CI->load->model('Mta_application');
		$this->course = $this->CI->Mta_application->get_course_by_id($this->course_id);
		return $this;
	}
	
}