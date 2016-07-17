<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Teacher_obj
 *
 * The operations of teachers
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 */

class Teacher_obj extends My_obj
{
	public $user_name;
	public $user_enname;
	public $user_id;
	public $user_qq;
	public $user_type;
	public $user_department;
	public $user_office;
	public $user_position;
	public $user_enposition;
	public $user_country;
	public $user_tel;
	public $user_subtel;
	public $user_mobile;
	public $user_short;
	public $user_email;
	public $user_skype;
	public $user_room;
	public $user_status;
	
	/**
	 * Teacher_obj constructor.
	 * @param array $data
	 */
	public function __construct($data = array())
	{
		parent::__construct($data, 'student_id');
	}


}