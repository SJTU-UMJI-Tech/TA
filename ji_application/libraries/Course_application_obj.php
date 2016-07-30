<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Course_application_obj extends My_obj
{
	/** -- The vars in the table `ji_ta_application_open` -- */

	/** @var int    int(11)     ID */
	public $id;
	/** @var int    varchar(100)课程编号 */
	public $BSID;
	/** @var int    varchar(20) 用户 ID */
	public $USER_ID;
	/** @var string varchar(255)课程中文名称 */
	public $KCZWMC;
	/** @var string varchar(10) 课程代码 */
	public $KCDM;
	/** @var string varchar(160)课程简介 */
	public $KCJJ;
	/** @var int    varchar(9)  学年 */
	public $XN;
	/** @var int    varchar(10) JI 学期 */
	public $XQ_JI;
	/** @var string varchar(50) 教师姓名 */
	public $XM;
	/** @var int    int(11)      */
	public $num_plan;
	/** @var int    int(11)      */
	public $num_apply;
	/** @var int    int(11)      */
	public $salary;
	/** @var int    int(4)       */
	public $state;
	/** @var string timestamp   创建时间 */
	public $CREATE_TIMESTAMP;
	/** @var string timestamp   更新时间 */
	public $UPDATE_TIMESTAMP;


	/** -- The vars defined for other uses -- */
	
	
	/**
	 * Course_application_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'id');
	}
	
}