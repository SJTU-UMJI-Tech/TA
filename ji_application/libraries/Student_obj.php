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
 */
class Student_obj extends My_obj
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
	/** @var string varchar(50) 学生类别明细名称*/
	public $student_xslbmxmc;
	/** @var string varchar(50) 是否在校 */
	public $student_sfzx;

	public function __construct($data = array())
	{
		parent::__construct($data, 'student_id');
	}


}