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
	/** @var int    varchar(50) TA ID */
	public $USER_ID;
	/** @var string varchar(20) 中文名 */
	public $name_ch;
	/** @var string varchar(20)	英文名 */
	public $name_en;
	/** @var string char(1) 	性别 */
	public $gender;
	/** @var string varchar(50) 学院 */
	public $department;
	/** @var string varchar(50) Email 地址 */
	public $email;
	/** @var string varchar(20) 手机号 */
	public $phone;
	/** @var string varchar(15)	QQ号 */
	public $qq;
	/** @var string timestamp	创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp	更新时间 */
	public $UPDATE_TIMESTAMP;
	
	
	/** -- The vars defined for other uses -- */
	/** @var array */
	public $course_list;
	/** @var array */
	public $feedback_list;
	/** @var array */
	public $answer_list;
	/** @var array */
	public $report_list;
	/** @var Student_obj */
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
	 * Get the name of the TA (according to the language)
	 * @return string
	 */
	public function get_name()
	{
		return $_SESSION['language'] == 'zh-cn' ? $this->name_ch : $this->name_en;
	}
	
	/**
	 * Set the courses of the TA
	 * @return $this
	 */
	public function set_course()
	{
		$this->CI->load->model('Mta');
		$this->course_list = $this->CI->Mta->get_ta_course($this->USER_ID);
		return $this;
	}
	
	/**
	 * Set the feedbacks of the TA
	 * @return $this
	 */
	public function set_feedback()
	{
		$this->CI->load->model('Mta');
		$this->feedback_list = $this->CI->Mta->get_ta_feedback($this->USER_ID);
		return $this;
	}
	
	/**
	 * Set the reports of the TA
	 * @return $this
	 */
	public function set_report()
	{
		$this->CI->load->model('Mta');
		$this->report_list = $this->CI->Mta->get_ta_report($this->USER_ID);
		return $this;
	}
	
	/**
	 * Set the students of the TA
	 * @return $this
	 */
	public function set_student()
	{
		$this->CI->load->model('Mstudent');
		$this->student = $this->CI->Mstudent->get_student_by_id($this->USER_ID);
		return $this;
	}
	
	/**
	 * Set the evaluation answer of the TA
	 * @param $BSID int
	 * @return $this
	 */
	public function set_answer($BSID)
	{
		$this->CI->load->model('Mta');
		$this->answer_list = $this->CI->Mta->get_ta_answer($this->USER_ID, $BSID);
		return $this;
	}
}