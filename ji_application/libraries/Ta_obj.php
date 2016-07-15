<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ta_obj
 *
 * The operations of TAs
 *
 * @category   ji
 * @package    ji
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mta
 * @uses       Mstudent
 */
class Ta_obj extends My_obj
{
	/** -- The vars in the table `ji_ta_info` -- */
	public $USER_ID;            // varchar(20) 	TA ID
	public $name_ch;            // varchar(20) 	中文名
	public $name_en;            // varchar(20)	英文名
	public $gender;                // char(1) 		性别
	public $department;            // varchar(50) 	学院
	public $email;                // varchar(50)  管理员回复 ID
	public $phone;                // varchar(20)  教师回复 ID
	public $qq;                    // varchar(15)	投诉状态
	public $CREATE_TIMESTAMP;    // timestamp	创建时间
	public $UPDATE_TIMESTAMP;    // timestamp 	更新时间
	
	public $course_list;
	public $feedback_list;
	public $answer_list;
	public $report_list;
	
	/** @var $student Student_obj */
	public $student;
	
	/**
	 * Ta_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'USER_ID');
	}

	/**
	 * @return string
	 */
	public function get_name()
	{
		return $_SESSION['language'] == 'zh-cn' ? $this->name_ch : $this->name_en;
	}
	
	public function set_course()
	{
		$this->CI->load->model('Mta');
		$this->course_list = $this->CI->Mta->get_ta_course($this->USER_ID);
		return $this;
	}
	
	public function set_feedback()
	{
		$this->CI->load->model('Mta');
		$this->feedback_list = $this->CI->Mta->get_ta_feedback($this->USER_ID);
		return $this;
	}
	
	public function set_report()
	{
		$this->CI->load->model('Mta');
		$this->report_list = $this->CI->Mta->get_ta_report($this->USER_ID);
		return $this;
	}

	public function set_student()
	{
		$this->CI->load->model('Mstudent');
		$this->student = $this->CI->Mstudent->get_student_by_id($this->USER_ID);
		return $this;
	}
	
	public function set_answer($BSID)
	{
		$this->CI->load->model('Mta');
		$this->answer_list = $this->CI->Mta->get_ta_answer($this->USER_ID, $BSID);
		return $this;
	}
}