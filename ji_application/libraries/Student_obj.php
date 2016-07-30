<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Student_obj
 *
 * The operations of students
 *
 * @category   ji
 * @package    ji
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Student_detail_obj
 */
class Student_obj extends My_obj
{
	/** -- The vars in the table `jbxx` -- */
	/** @var int    varchar(50) JAccount 账号 */
	public $ACCOUNT;
	/** @var int    varchar(50) 姓名 */
	public $USER_NAME;
	/** @var int    varchar(50) 用户类型 */
	public $USER_STYLE;
	/** @var int    varchar(50) 学号 */
	public $USER_ID;
	/** @var int    varchar(24) 出生日期 */
	public $CSRQ;
	/** @var int    varchar(100)邮箱 */
	public $EMAIL;
	/** @var int    char(1)     删除标记 */
	public $SCBJ;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp   更新时间 */
	public $UPDATE_TIMESTAMP;
	
	/** -- The vars defined for other uses -- */
	/** @var Student_detail_obj */
	public $detail;
	
	public function __construct($data = array())
	{
		parent::__construct($data, 'USER_ID');
	}
	
	/**
	 * @return $this
	 */
	public function set_detail()
	{
		$this->CI->load->model('Mstudent');
		$this->detail = $this->CI->Mstudent->get_student_detail_by_id($this->USER_ID);
		return $this;
	}
}

/**
 * Class Student_detail_obj
 *
 * The secondary information of students
 *
 * @category   ji
 * @package    ji
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 */
class Student_detail_obj extends My_obj
{
	/** -- The vars in the table `ji_students` -- */
	
	/** @var int    varchar(12) 学号 */
	public $student_id;
	/** @var string varchar(50) 姓名 */
	public $student_name;
	/** @var string varchar(50) 班号 */
	public $student_bh;
	/** @var string varchar(50) 校内专业代码 */
	public $student_xnzydm;
	/** @var string varchar(50) 校内专业名称 */
	public $student_xnzymc;
	/** @var string varchar(50) 国标专业代码 */
	public $student_gbzydm;
	/** @var string varchar(50) 院系 */
	public $student_yx;
	/** @var string varchar(50) 入学年级 */
	public $student_rxnj;
	/** @var string varchar(50) 机构代码 */
	public $student_jgdm;
	/** @var string varchar(50) 学生类别代码 */
	public $student_xslbdm;
	/** @var string varchar(50) 学生类别名称 */
	public $student_xslbmc;
	/** @var string varchar(50) 学生类别明细代码 */
	public $student_xslbmxdm;
	/** @var string varchar(50) 学生类别明细名称 */
	public $student_xslbmxmc;
	/** @var string varchar(50) 是否在校 */
	public $student_sfzx;
	
	public function __construct($data = array())
	{
		parent::__construct($data, 'student_id');
	}
}