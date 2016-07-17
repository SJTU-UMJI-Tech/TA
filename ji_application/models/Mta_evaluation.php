<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Mta_evaluation
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Evaluation_obj
 * @uses       Evaluation_question_obj
 * @uses       Evaluation_answer_obj
 * @uses       Evaluation_config_obj
 */
class Mta_evaluation extends CI_Model
{
	/**
	 * Mta_evaluation constructor.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->library('Evaluation_obj');
	}
	
	/**
	 * 使用 ID 获取答案
	 * @param int $id
	 * @return Evaluation_answer_obj
	 */
	public function get_answer_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_evaluation_answer', array('id' => $id));
		$answer = new Evaluation_answer_obj($query->row(0));
		return $answer;
	}
	
	/**
	 * 获取默认配置 ID
	 * @param int $id
	 * @return Evaluation_default_obj
	 */
	public function get_default_by_id($id)
	{
		$query = $this->db->get_where('ji_ta_evaluation_default', array('id' => $id));
		$answer = new Evaluation_default_obj($query->row(0));
		return $answer;
	}
	
	/**
	 * 获取配置信息（可通过ID或type）
	 * @param int|string $id
	 * @param bool       $all
	 * @return Evaluation_config_obj|array
	 */
	public function get_evaluation_config($id, $all = false)
	{
		if ($all)
		{
			$query = $this->db->select('*')->from('ji_ta_evaluation_config')->where(array('type' => $id))
			                  ->order_by('UPDATE_TIMESTAMP', 'DESC')->get();
			$config_list = array();
			foreach ($query->result() as $row)
			{
				$config = new Evaluation_config_obj($row);
				if (!$config->is_error())
				{
					if ($config->state < 2)
					{
						$config->add_array($config_list);
					}
				}
			}
			return $config_list;
		}
		if ($id == 'student' || $id == 'teacher')
		{
			$id = $this->Mta_site->site_config['ta_evaluation_config_' . $id];
		}
		$query = $this->db->get_where('ji_ta_evaluation_config', array('id' => $id));
		$config = new Evaluation_config_obj($query->row(0));
		return $config;
	}
	
	/**
	 * 设置配置状态
	 * @param int $id
	 * @param int $state
	 */
	public function set_config_state($id, $state)
	{
		$config = $this->get_evaluation_config($id);
		if (!$config->is_error())
		{
			if ($config->state == 0)
			{
				$this->db->update('ji_ta_evaluation_config', array('state' => $state), array('id' => $id));
			}
		}
	}
	
	/**
	 * 获取配置默认问题
	 * @param Evaluation_config_obj $config
	 * @return array
	 */
	public function get_defaults($config)
	{
		$data = array('choice' => array(), 'blank' => array());
		if (!$config->is_error())
		{
			$choice_list = explode(',', $config->choice_list);
			$blank_list = explode(',', $config->blank_list);
			$query = $this->db->select('*')->from('ji_ta_evaluation_default')
			                  ->where_in('id', array_merge($choice_list, $blank_list))->get();
			$question_list = array();
			foreach ($query->result() as $row)
			{
				$question = new Evaluation_default_obj($row);
				$question_list[$question->id] = $question;
			}
			for ($i = 0; $i < $config->choice; $i++)
			{
				$data['choice'][$i] = $question_list[$choice_list[$i]];
			}
			for ($i = 0; $i < $config->blank; $i++)
			{
				$data['blank'][$i] = $question_list[$blank_list[$i]];
			}
		}
		return $data;
	}
	
	/**
	 * 编辑默认问题
	 * @param int    $id
	 * @param string $content
	 */
	public function edit_default($id, $content)
	{
		$this->db->update('ji_ta_evaluation_default', array('content' => $content), array('id' => $id));
	}
	
	/**
	 * 创建默认问题
	 * @param string $type
	 * @param string $content
	 * @return int
	 */
	public function create_default($type, $content)
	{
		$data = array(
			'type'    => $type,
			'content' => $content
		);
		$this->db->insert('ji_ta_evaluation_default', $data);
		return $this->db->insert_id();
	}
	
	/**
	 * 编辑配置
	 * @param int    $id
	 * @param string $description
	 * @param array  $choice_list
	 * @param array  $blank_list
	 * @param int    $addition
	 * @param int    $USER_ID
	 */
	public function edit_config($id, $description, $choice_list, $blank_list, $addition, $USER_ID)
	{
		$data = array(
			'description' => $description,
			'choice_list' => implode(',', $choice_list),
			'choice'      => count($choice_list),
			'blank_list'  => implode(',', $blank_list),
			'blank'       => count($blank_list),
			'addition'    => $addition,
			'EDITOR_ID'   => $USER_ID
		);
		$this->db->update('ji_ta_evaluation_config', $data, array('id' => $id));
	}
	
	/**
	 * 创建配置
	 * @param        $type
	 * @param string $description
	 * @param array  $choice_list
	 * @param array  $blank_list
	 * @param int    $addition
	 * @param int    $USER_ID
	 * @return int
	 */
	public function create_config($type, $description, $choice_list, $blank_list, $addition, $USER_ID)
	{
		$data = array(
			'type'        => $type,
			'description' => $description,
			'choice_list' => implode(',', $choice_list),
			'choice'      => count($choice_list),
			'blank_list'  => implode(',', $blank_list),
			'blank'       => count($blank_list),
			'addition'    => $addition,
			'CREATER_ID'  => $USER_ID,
			'EDITOR_ID'   => $USER_ID
		);
		$this->db->insert('ji_ta_evaluation_config', $data);
		return $this->db->insert_id();
	}
	
	/**
	 * 设置默认配置
	 * @param int    $id
	 * @param string $type
	 */
	public function set_default_config($id, $type)
	{
		if ($this->get_evaluation_state() == 0)
		{
			$this->Mta_evaluation->set_config_state($id, 1);
		}
		$this->Mta_site->update_site_config(array('ta_evaluation_config_' . $type => $id));
	}
	
	/**
	 * 搜索默认问题
	 * @param string $type
	 * @param array  $keys
	 * @return array
	 */
	public function search_default($type, $keys)
	{
		$this->db->select('*')->from('ji_ta_evaluation_default')->where(array('type' => $type));
		foreach ($keys as $key)
		{
			$this->db->like('content', $key);
		}
		$query = $this->db->limit(10)->order_by('UPDATE_TIMESTAMP', 'DESC')->get();
		$question_list = array();
		foreach ($query->result() as $row)
		{
			$question_list[] = new Evaluation_default_obj($row);
		}
		return $question_list;
	}
	
	/**
	 * 创建附加问题
	 * @param int    $BSID
	 * @param string $type
	 * @param string $content
	 */
	public function create_question($BSID, $type, $content)
	{
		$data = array(
			'BSID'    => $BSID,
			'type'    => $type,
			'content' => $this->Mta_site->html_base64($content)
		);
		$this->db->insert('ji_ta_evaluation_question', $data);
	}
	
	/**
	 * 编辑附加问题
	 * @param int    $BSID
	 * @param string $type
	 * @param string $content
	 * @param int    $id
	 */
	public function edit_question($BSID, $type, $content, $id)
	{
		$data = array(
			'BSID'    => $BSID,
			'type'    => $type,
			'content' => $this->Mta_site->html_base64($content)
		);
		$this->db->update('ji_ta_evaluation_question', $data, array('id' => $id));
	}
	
	/**
	 * 创建答案
	 * @param int    $BSID
	 * @param int    $USER_ID
	 * @param int    $TA_ID
	 * @param string $type
	 * @param array  $content
	 */
	public function create_answer($BSID, $USER_ID, $TA_ID, $type, $content)
	{
		$data = array(
			'BSID'    => $BSID,
			'USER_ID' => $USER_ID,
			'TA_ID'   => $TA_ID,
			'content' => $this->Mta_site->html_base64(json_encode($content))
		);
		if ($type == 'student' || $type == 'teacher')
		{
			$data['config_id'] = $this->Mta_site->site_config['ta_evaluation_config_' . $type];
		}
		$this->db->insert('ji_ta_evaluation_answer', $data);
	}
	
	/**
	 * 获取答案
	 * @param int $BSID
	 * @param int $USER_ID
	 * @param int $TA_ID
	 * @return array
	 */
	public function get_answer($BSID, $USER_ID, $TA_ID = 0)
	{
		$this->db->select('*')->from('ji_ta_evaluation_answer')->where(array(
			                                                               'BSID'    => $BSID,
			                                                               'USER_ID' => $USER_ID,
		                                                               ));
		if (is_array($TA_ID))
		{
			$this->db->where_in('TA_ID', $TA_ID);
		}
		else if ($TA_ID != 0)
		{
			$this->db->where(array('TA_ID' => $TA_ID));
		}
		$answer_list = array();
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$answer = new Evaluation_answer_obj($row);
			if (!$answer->is_error())
			{
				$answer_list[] = $answer;
			}
		}
		return $answer_list;
	}
	
	/**
	 * 检查内容是否符合字数规定
	 * @param $content
	 * @return bool
	 */
	public function examine_content($content)
	{
		return strlen($content) >= $this->Mta_site->site_config['ta_evaluation_content_min'] &&
		       strlen($content) <= $this->Mta_site->site_config['ta_evaluation_content_max'];
	}
	
	/**
	 * 获取评教状态（-1：未开始；0：正在进行；1：已结束）
	 * @return int
	 */
	public function get_evaluation_state()
	{
		$start = strtotime($this->Mta_site->site_config['ta_evaluation_start']);
		$end = strtotime($this->Mta_site->site_config['ta_evaluation_end']);
		$now = strtotime(date('Y-m-d'));
		if ($now < $start)
		{
			return -1;
		}
		else if ($now > $end)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}