<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Course_obj
 *
 * The operations of courses
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mcourse
 */
class Course_obj extends My_obj
{
	/** -- The vars in the table `kkxx` -- */
	
	/** @var int    varchar(20) 用户 ID */
	public $USER_ID;
	/** @var int    varchar(100)课程编号 */
	public $BSID;
	/** @var int    varchar(9)  学年 */
	public $XN;
	/** @var int    int(11)     学期 */
	public $XQ;
	/** @var int    varchar(10) JI 学期 */
	public $XQ_JI;
	/** @var string varchar(255)课程中文名称 */
	public $KCZWMC;
	/** @var string varchar(10) 课程代码 */
	public $KCDM;
	/** @var string varchar(160)课程简介 */
	public $KCJJ;
	/** @var int    varchar(50) 学工号 */
	public $XGH;
	/** @var string varchar(50) 教师姓名 */
	public $XM;
	/** @var int    char(1)     删除标记 */
	public $SCBJ;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp   更新时间 */
	public $UPDATE_TIMESTAMP;
	
	
	/** -- The vars defined for other uses -- */
	/** @var Teacher_obj */
	public $teacher;
	/** @var array */
	public $ta_list;
	/** @var array */
	public $student_list;
	/** @var array */
	public $feedback_list;
	/** @var array */
	public $question_list;
	/** @var array */
	public $answer_list;
	
	
	/**
	 * Course_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'BSID');
		if (!$this->is_error())
		{
			switch ($this->XQ_JI)
			{
			case 'FA':
			case 'SP':
			case 'SU':
				break;
			default:
				$this->XQ_JI = $this->XQ == 1 ? 'FA' : 'SU';
			}
		}
	}
	
	/**
	 * Set the teacher of the course
	 * @return $this
	 */
	public function set_teacher()
	{
		$this->CI->load->model('Mteacher');
		$this->teacher = $this->CI->Mteacher->get_teacher_by_id($this->USER_ID);
		return $this;
	}
	
	/**
	 * Set the TAs in the course
	 * @return $this
	 */
	public function set_ta()
	{
		$this->CI->load->model('Mcourse');
		$this->ta_list = $this->CI->Mcourse->get_course_ta($this->BSID);
		return $this;
	}
	
	/**
	 * Set the students in the course
	 * @return $this
	 */
	public function set_student()
	{
		$this->CI->load->model('Mcourse');
		$this->student_list = $this->CI->Mcourse->get_course_student($this->BSID);
		return $this;
	}
	
	/**
	 * Set the feedbacks in the course
	 * @return $this
	 */
	public function set_feedback()
	{
		$this->CI->load->model('Mcourse');
		$this->feedback_list = $this->CI->Mcourse->get_course_feedback($this->BSID);
		return $this;
	}
	
	/**
	 * Set the additional evaluation questions in the course
	 * @return $this
	 */
	public function set_question()
	{
		$this->CI->load->model('Mcourse');
		$this->question_list = $this->CI->Mcourse->get_course_question($this->BSID);
		return $this;
	}
	
	/**
	 * Set the evaluation answers in the course
	 * @return $this
	 */
	public function set_answer()
	{
		$this->CI->load->model('Mcourse');
		$this->answer_list = $this->CI->Mcourse->get_course_answer($this->BSID);
		return $this;
	}
}