<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Mta_feedback
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mta_site
 * @uses       Feedback_obj
 * @uses       Feedback_reply_obj
 */
class Mta_feedback extends CI_Model
{
	/**
	 * Mta_feedback constructor.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mta_site');
		$this->load->library('Feedback_obj');
		$this->load->library('Feedback_reply_obj');
	}
	
	/**
	 * 使用 ID 获取投诉
	 * @param   int $id 投诉 ID
	 * @return  Feedback_obj
	 * @throws  Exception
	 */
	public function get_feedback_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_feedback', array('id' => $id));
		$feedback = new Feedback_obj($query->row(0));
		return $feedback;
	}
	
	/**
	 * 使用 ID 获取投诉回复
	 * @param   int $id 回复 ID
	 * @return  Feedback_reply_obj
	 */
	public function get_feedback_reply_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_feedback_reply', array('id' => $id));
		$reply = new Feedback_reply_obj($query->row(0));
		return $reply;
	}
	
	/**
	 * @param int $id
	 * @return array
	 */
	public function get_feedback_replys($id)
	{
		$query = $this->db->get_where('ji_ta_feedback_reply', array('feedback_id' => $id));
		$replys = array();
		foreach ($query->result() as $row)
		{
			$reply = new Feedback_reply_obj($row);
			if (!$reply->is_error())
			{
				$replys[] = $reply;
			}
		}
		return $replys;
	}
	
	
	/**
	 * 检查内容是否符合字数规定
	 * @param $content
	 * @return bool
	 */
	public function examine_content($content)
	{
		return strlen($content) >= $this->Mta_site->site_config['ta_feedback_content_min'] &&
		       strlen($content) <= $this->Mta_site->site_config['ta_feedback_content_max'];
	}
	
	public function get_reply_title($state)
	{
		$feedback = new Feedback_obj();
		$from = $to = '';
		$feedback->is_manage($state) ? $from = lang('ta_main_manage') :
			$to = lang('ta_main_manage');
		if ($feedback->is_student($state))
		{
			$from == '' ? $from = lang('ta_main_student') : $to = lang('ta_main_student');
		}
		else if ($feedback->is_teacher($state))
		{
			$from == '' ? $from = lang('ta_main_teacher') : $to = lang('ta_main_teacher');
		}
		return str_replace(array('{from}', '{to}'), array($from, $to),
		                   lang('ta_feedback_reply_title'));
	}
	
	public function get_state_array($identity, $state)
	{
		switch ($identity)
		{
		case Feedback_obj::STATE_TEACHER:
			switch ($state)
			{
			case 1: //applying
				return array(7, 15);
			case 2: //checking
				return array(5, 13);
			case 3: //disposed
				return array(8, 9, 10, 11, 12, 14);
			}
			break;
		case Feedback_obj::STATE_MANAGE:
			switch ($state)
			{
			case 1: //applying(student)
				return array(1, 9);
			case 2: //applying(teacher)
				return array(5, 13);
			case 3: //disposed
				return array(3, 7, 11, 15);
			case 4: //closed
				return array(0, 2, 4, 6, 8, 10, 12, 14);
			}
			break;
		}
		return NULL;
	}
	
	/**
	 * 显示投诉列表
	 * @param int   $user_id
	 * @param int   $identity
	 * @param array $state
	 * @return array
	 */
	public function show_list($user_id, $identity, $state = array(Feedback_obj::STATE_CLOSED))
	{
		switch ($identity)
		{
		case Feedback_obj::STATE_STUDENT:
			$this->db->select('*')->from('ji_ta_feedback')->where('user_id', $user_id)
			         ->order_by('CREATE_TIMESTAMP', 'DESC');
			break;
		case Feedback_obj::STATE_TEACHER:
			$this->load->model('Mteacher');
			$this->load->library('Course_obj');
			$course_list = array();
			foreach ($this->Mteacher->get_now_course($user_id) as $course)
			{
				array_push($course_list, $course->BSID);
			}
			if (count($course_list) == 0)
			{
				return array();
			}
			$this->db->select('*')->from('ji_ta_feedback')->where_in('state', $state)
			         ->where_in('BSID', $course_list)->order_by('BSID', 'ASC')
			         ->order_by('CREATE_TIMESTAMP', 'DESC');
			break;
		case Feedback_obj::STATE_MANAGE:
			$query = $this->db->get_where('ji_user', array('user_id' => $user_id));
			if ($query->num_rows() != 1)
			{
				return array();
			}
			$this->db->select('*')->from('ji_ta_feedback')->where_in('state', $state)
			         ->order_by('CREATE_TIMESTAMP', 'DESC');
			break;
		}
		$feedback_list = array();
		foreach ($this->db->get()->result() as $result)
		{
			$feedback = new Feedback_obj($result);
			if (!$feedback->is_error())
			{
				array_push($feedback_list, $feedback);
			}
		}
		return $feedback_list;
	}
	
	/**
	 * 学生创建投诉
	 * @param array $data
	 *              ta_id       => (str)    TA ID
	 *              user_id     => (str)    投诉者 ID
	 *              BSID        => (str)    课程 ID
	 *              topic       => (str)    标题
	 *              content     => (str)    内容
	 *              anonymous   => (bool)   是否匿名
	 * @return int
	 */
	public function create($data)
	{
		$data['title'] = $this->Mta_site->html_base64($data['title']);
		$data['content'] = $this->Mta_site->html_base64($data['content']);
		$reply_data = array(
			'user_id' => $data['user_id'],
			'content' => $data['content'],
			'state'   => Feedback_obj::STATE_CLOSED | Feedback_obj::STATE_NOT_MANAGE |
			             Feedback_obj::STATE_STUDENT);
		unset($data['content']);
		$data['state'] = Feedback_obj::STATE_OPEN | Feedback_obj::STATE_NOT_MANAGE |
		                 Feedback_obj::STATE_STUDENT | Feedback_obj::STATE_NOT_PROCESSED;
		$this->db->insert('ji_ta_feedback', $data);
		$reply_data['feedback_id'] = $this->db->insert_id();
		$this->db->insert('ji_ta_feedback_reply', $reply_data);
		return $reply_data['feedback_id'];
	}
	
	/**
	 * 关闭投诉
	 * @param int $id
	 * @return bool
	 */
	public function close($id)
	{
		$feedback = $this->get_feedback_by_id($id);
		if ($feedback->is_error())
		{
			return false;
		}
		$feedback->set_state(Feedback_obj::STATE_CLOSED,
		                     Feedback_obj::STATE_MANAGE | Feedback_obj::STATE_TEACHER |
		                     Feedback_obj::STATE_PROCESSED);
		$this->db->update('ji_ta_feedback', array('state' => $feedback->state), array('id' => $id));
		return true;
	}
	
	/**
	 * 回复投诉
	 * @param int    $id
	 * @param int    $identity
	 * @param int    $user_id
	 * @param string $content
	 * @param bool   $change_flag
	 * @param string $picture_name
	 * @return bool
	 */
	public function reply($id, $identity, $user_id, $content, $change_flag = false, $picture_name = '')
	{
		/** initialize */
		$feedback = $this->get_feedback_by_id($id);
		if ($feedback->is_error())
		{
			return false;
		}
		$reply_data = array(
			'feedback_id' => $id,
			'user_id'     => $user_id,
			'content'     => $this->Mta_site->html_base64($content),
			'picture'     => $picture_name);
		
		switch ($identity)
		{
			/** student and teacher can only reply to the manage */
		case Feedback_obj::STATE_STUDENT:
			$reply_data['state'] = Feedback_obj::STATE_CLOSED | Feedback_obj::STATE_NOT_MANAGE |
			                       Feedback_obj::STATE_STUDENT;
			$feedback->set_state(Feedback_obj::STATE_OPEN | Feedback_obj::STATE_NOT_MANAGE |
			                     Feedback_obj::STATE_STUDENT, Feedback_obj::STATE_PROCESSED);
			break;
		case Feedback_obj::STATE_TEACHER:
			$reply_data['state'] = Feedback_obj::STATE_CLOSED | Feedback_obj::STATE_NOT_MANAGE |
			                       Feedback_obj::STATE_TEACHER;
			$feedback->set_state(Feedback_obj::STATE_OPEN | Feedback_obj::STATE_NOT_MANAGE |
			                     Feedback_obj::STATE_TEACHER | Feedback_obj::STATE_PROCESSED);
			break;
		case Feedback_obj::STATE_MANAGE:
			
			if (!$change_flag)
			{
				$reply_data['state'] = Feedback_obj::STATE_OPEN | Feedback_obj::STATE_MANAGE |
				                       ($feedback->is_student() ? Feedback_obj::STATE_STUDENT : Feedback_obj::STATE_TEACHER);
				$feedback->set_state(Feedback_obj::STATE_OPEN | Feedback_obj::STATE_MANAGE,
				                     Feedback_obj::STATE_TEACHER | Feedback_obj::STATE_PROCESSED);
				break;
			}
			$feedback->set_replys(Feedback_obj::STATE_MANAGE);
			if ($feedback->is_student())
			{
				/** set all of student's reply available to teacher */
				foreach ($feedback->replys as $reply)
				{
					/** @var $reply Feedback_reply_obj */
					if ($feedback->is_student($reply->state) && !$feedback->is_open($reply->state))
					{
						$this->db->update('ji_ta_feedback_reply', array(
							'state' => $reply->state | Feedback_obj::STATE_OPEN),
						                  array('id' => $reply->id));
					}
				}
				/** Mail the teacher */
				$this->load->model('Mta_mail');
				$this->load->model('Mcourse');
				$course =$this->Mcourse->get_course_by_id($id);
				$course->set_teacher();
				/** @TODO The format of the email */
				
			}
			else
			{
				/** set last of teacher's reply avaiable to student */
				foreach (array_reverse($feedback->replys) as $reply)
				{
					/** @var $reply Feedback_reply_obj */
					if ($feedback->is_teacher($reply->state) &&
					    !$feedback->is_manage($reply->state)
					)
					{
						$this->db->update('ji_ta_feedback_reply', array(
							'state' => $reply->state | Feedback_obj::STATE_OPEN),
						                  array('id' => $reply->id));
						break;
					}
				}
				/** Mail the student */
				/** @TODO Don't have the email of the student
				 *  In the table `jbxx` in sync
				 */
			}
			
			$reply_data['state'] = Feedback_obj::STATE_CLOSED | Feedback_obj::STATE_MANAGE |
			                       ($feedback->is_student() ? Feedback_obj::STATE_TEACHER : Feedback_obj::STATE_STUDENT);
			$feedback->set_state(Feedback_obj::STATE_OPEN | Feedback_obj::STATE_MANAGE |
			                     ($feedback->is_student() ? Feedback_obj::STATE_TEACHER : Feedback_obj::STATE_STUDENT),
			                     Feedback_obj::STATE_PROCESSED);
			break;
		}
		
		/** finalize */
		$this->db->insert('ji_ta_feedback_reply', $reply_data);
		$this->db->update('ji_ta_feedback', array('state' => $feedback->state), array('id' => $id));
	}
	
}