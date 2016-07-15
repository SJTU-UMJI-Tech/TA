<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Evaluation_obj
 * virtual class
 */
class Evaluation_obj
{
}

/**
 * Class Evaluation_question_obj
 *
 * The operations of ta evaluation questions
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 */
class Evaluation_question_obj extends My_obj
{
	/** -- The vars in the table `ji_ta_evaluation_question` -- */
	
	/** @var int    int(11)     评教问题 ID */
	public $id;
	/** @var int    varchar(50) 课程 ID */
	public $BSID;
	/** @var string varchar(10) 类型(choice/blank) */
	public $type;
	/** @var string TEXT        内容 */
	public $content;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	
	
	/** -- The vars defined for other uses -- */
	
	
	/**
	 * Evaluation_question_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'id');
		if (!$this->is_error())
		{
			$this->content = base64_decode($this->content);
		}
	}

}

/**
 * Class Evaluation_answer_obj
 *
 * The operations of ta evaluation answers
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 */
class Evaluation_answer_obj extends My_obj
{
	/** -- The vars in the table `ji_ta_evaluation_answer` -- */
	
	/** @var int    int(11)     评教问题 ID */
	public $id;
	/** @var int    varchar(50) 课程 ID */
	public $BSID;
	/** @var int    varchar(50) 用户 ID */
	public $USER_ID;
	/** @var string varchar(50) 助教 ID */
	public $TA_ID;
	/** @var int    int(11)     配置 ID */
	public $config_id;
	/** @var string TEXT        回答 */
	public $content;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp   修改时间 */
	public $UPDATE_TIMESTAMP;

	
	/** -- The vars defined for other uses -- */
	
	
	/**
	 * Evaluation_answer_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'id');
		if (!$this->is_error())
		{
			$this->content = json_decode(base64_decode($this->content), true);
		}
	}
	
}

/**
 * Class Evaluation_config_obj
 *
 * The operations of ta evaluation configs
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 */
class Evaluation_config_obj extends My_obj
{
	/** -- The vars in the table `ji_ta_evaluation_config` -- */

	/** @var int    int(11)     评教配置 ID */
	public $id;
	public $name;
	public $CREATER_ID;
	public $EDITOR_ID;
	/** @var string varchar(10) 配置类型 */
	public $type;
	/** @var int    int(11)     选择题数量 */
	public $choice;
	/** @var string TEXT        选择题列表 */
	public $choice_list;
	/** @var int    int(11)     填空题数量 */
	public $blank;
	/** @var string TEXT        填空题列表 */
	public $blank_list;
	/** @var int    int(11)     最大附加问题数量 */
	public $addition;
	/** @var int    int(4)      状态 */
	public $state;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp   修改时间 */
	public $UPDATE_TIMESTAMP;


	/** -- The vars defined for other uses -- */
	public $creater;
	public $editor;

	/**
	 * Evaluation_config_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'id');
		if(!$this->is_error())
		{
			$this->CI->load->model('Mmanage');
			$this->creater=$this->CI->Mmanage->get_manage_by_id($this->CREATER_ID);
			if($this->CREATER_ID==$this->EDITOR_ID)
			{
				$this->editor=$this->creater;
			}
			else
			{
				$this->editor=$this->CI->Mmanage->get_manage_by_id($this->EDITOR_ID);
			}
		}
	}

}


/**
 * Class Evaluation_default_obj
 *
 * The operations of ta evaluation default questions
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 */
class Evaluation_default_obj extends My_obj
{
	/** -- The vars in the table `ji_ta_evaluation_config` -- */

	/** @var int    int(11)     评教问题 ID */
	public $id;
	/** @var string varchar(10) 类型(choice/blank) */
	public $type;
	/** @var string TEXT        内容 */
	public $content;
	/** @var int    int(4)      状态 */
	public $state;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp   修改时间 */
	public $UPDATE_TIMESTAMP;


	/** -- The vars defined for other uses -- */


	/**
	 * Evaluation_config_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'id');
		if (!$this->is_error())
		{
			$this->content = base64_decode($this->content);
		}
		else
		{
			$this->content = '';
		}
	}

}