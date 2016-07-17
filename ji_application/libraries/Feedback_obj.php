<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Feedback_obj
 *
 * The operations of ta feedbacks
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mta_feedback
 * @uses       Mcourse
 * @uses       Mta
 * @uses       Feedback_reply_obj
 */
class Feedback_obj extends My_obj
{
	/** -- The vars in the table `ji_ta_feedback` -- */
	
	/** @var int    int(11)     投诉 ID */
	public $id;
	/** @var int    varchar(50) TA ID */
	public $ta_id;
	/** @var int    varchar(50) 投诉者 ID */
	public $user_id;
	/** @var int    varchar(50) 课程 ID */
	public $BSID;
	/** @var string text        投诉标题 */
	public $title;
	/** @var bool   tinyint(1)  是否匿名 */
	public $anonymous;
	/** @var int    int(4)      投诉状态 */
	public $state;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp   更新时间 */
	public $UPDATE_TIMESTAMP;
	
	/** -- The vars defined for other uses -- */
	
	/** @var Ta_obj */
	public $ta;
	/** @var Course_obj */
	public $course;
	/** @var array */
	public $replys;
	
	/** -- The constants of $state, processed in binary -- */
	
	const STATE_CLOSED        = 0x00;
	const STATE_OPEN          = 0x01;
	const STATE_NOT_MANAGE    = 0x00;
	const STATE_MANAGE        = 0x02;
	const STATE_STUDENT       = 0x00;
	const STATE_TEACHER       = 0x04;
	const STATE_NOT_PROCESSED = 0x00;
	const STATE_PROCESSED     = 0x08;
	
	/**
	 * Feedback_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'id');
		if (!$this->is_error())
		{
			$this->title = base64_decode($this->title);
		}
	}
	
	/**
	 * Return whether the feedback is open, which means, can be appended by student/teacher
	 * @param int $state
	 * @return bool
	 */
	public function is_open($state = NULL)
	{
		$state == NULL ? $state = $this->state : NULL;
		return $state == ($state | $this::STATE_OPEN);
	}
	
	/**
	 * Return whether the feedback is to be processed by manage
	 * @param int $state
	 * @return bool
	 */
	public function is_manage($state = NULL)
	{
		$state == NULL ? $state = $this->state : NULL;
		return $state == ($state | $this::STATE_MANAGE);
	}
	
	/**
	 * Return whether the feedback is to be processed by teacher
	 * @param int $state
	 * @return bool
	 */
	public function is_teacher($state = NULL)
	{
		$state == NULL ? $state = $this->state : NULL;
		return $state == ($state | $this::STATE_TEACHER);
	}
	
	/**
	 * Return whether the feedback is to be processed by student
	 * @param int $state
	 * @return bool
	 */
	public function is_student($state = NULL)
	{
		return !$this->is_teacher($state);
	}
	
	/**
	 * Return whether the feedback has been proceesed by manage,
	 * which means, can be shown in teacher's list
	 * @param int $state
	 * @return bool
	 */
	public function is_processed($state = NULL)
	{
		$state == NULL ? $state = $this->state : NULL;
		return $state == ($state | $this::STATE_PROCESSED);
	}
	
	
	public function is_type($type, $state = NULL)
	{
		return ($this->is_student($state) && $type == 'student') ||
		       (!$this->is_manage($state) && $type == 'manage') ||
		       ($this->is_teacher($state) && $this->is_manage($state) &&
		        $type == 'teacher');
	}
	
	/**
	 * Return the string describing the state of the feedback
	 * @return string
	 */
	public function get_state_str()
	{
		$this->CI->load->language('ta_main');
		if (!$this->is_open())
		{
			return lang('ta_feedback_state_closed');
		}
		if ($this->is_manage())
		{
			return $this->is_student() ? lang('ta_feedback_state_manage_student') :
				lang('ta_feedback_state_manage_teacher');
		}
		else
		{
			return $this->is_student() ? lang('ta_feedback_state_student') :
				lang('ta_feedback_state_teacher');
		}
	}
	
	/**
	 * Set the ta of the feedback
	 * @return $this
	 */
	public function set_ta()
	{
		$this->CI->load->model('Mta');
		$this->ta = $this->CI->Mta->get_ta_by_id($this->ta_id);
		return $this;
	}
	
	/**
	 * Set the course of the feedback
	 * @return $this
	 */
	public function set_course()
	{
		$this->CI->load->model('Mcourse');
		$this->course = $this->CI->Mcourse->get_course_by_id($this->BSID);
		return $this;
	}
	
	/**
	 * Set the replys of the feedback
	 * @param int $state
	 * @return $this
	 */
	public function set_replys($state)
	{
		$this->CI->load->model('Mta_feedback');
		$this->CI->load->library('Feedback_reply_obj');
		$this->replys = $this->CI->Mta_feedback->get_feedback_replys($this->id);
		foreach ($this->replys as $key => $reply)
		{
			/** @var Feedback_reply_obj $reply */
			switch ($state)
			{
			case $this::STATE_STUDENT:
				if ($this->is_teacher($reply->state) && !$this->is_open($reply->state))
				{
					unset($this->replys[$key]);
				}
				break;
			case $this::STATE_TEACHER:
				if ($this->is_student($reply->state) && !$this->is_open($reply->state))
				{
					unset($this->replys[$key]);
				}
				break;
			case $this::STATE_MANAGE:
				break;
			}
		}
		return $this;
	}
	
	/**
	 * Set the state of the feedback
	 * @param int $alter
	 * @param int $preserve
	 * @return $this
	 */
	public function set_state($alter, $preserve = 0x00)
	{
		$this->state &= $preserve;
		$this->state |= $alter;
		return $this;
	}
	
}