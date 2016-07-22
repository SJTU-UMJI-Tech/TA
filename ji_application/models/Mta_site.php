<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Mta_site
 *
 * @category   ta
 * @package    ta
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 */
class Mta_site extends CI_Model
{
	/** @var array */
	public $site_config;
	
	/**
	 * Mta_site constructor.
	 */
	function __construct()
	{
		parent::__construct();
		
	}
	
	/**
	 * 获取所有的网站设置项
	 * @return array
	 */
	public function get_site_config()
	{
		$query = $this->db->select('name,key')->from('ji_option')
		                  ->where(array('module' => 'global'))
		                  ->or_where(array('module' => 'ta'))->get();
		$settings = $query->result_array();
		foreach ($settings as $setting)
		{
			$data[$setting['name']] = $setting['key'];
		}
		$mtime = explode(' ', microtime());
		$startTime = floor(($mtime[1] + $mtime[0]) * 1000);
		$data['server_time'] = $startTime;
		$this->site_config = $data;
		return $data;
	}
	
	/**
	 * 更新网站设置
	 * @param   array $data
	 * @return  bool
	 */
	public function update_site_config($data)
	{
		$update_data = array();
		foreach ($data as $key => $value)
		{
			$update_data[] = array(
				'name' => $key,
				'key'  => $value
			);
		}
		return $this->db->update_batch('ji_option', $update_data, 'name');
	}
	
	/**
	 * 净化 HTML
	 * @param string $string
	 * @return string
	 */
	public function html_purify($string)
	{
		return preg_replace("/<([a-zA-Z]+)[^>]*>/", "", $string);
	}
	
	/**
	 * BASE64 加密 HTML（净化）
	 * @param string $string
	 * @return string
	 */
	public function html_base64($string)
	{
		return base64_encode($this->html_purify($string));
	}
	
	/**
	 * 输出学期名
	 * @return string
	 */
	public function print_semester()
	{
		$semester_name = array(
			'FA' => 'Fall',
			'SP' => 'Spring',
			'SU' => 'Summer'
		);
		return substr($this->site_config['ji_academic_year'], 0, 4) . ' ' .
		       $semester_name[$this->site_config['ji_um_term']];
	}
	
	/**
	 * 重定向登录
	 * @param string $type
	 */
	public function redirect_login($type)
	{
		/** @TODO rewrite */
		if (!isset($_SESSION['userid']) || $_SESSION['userid'] == '')
		{
			if ($type == '')
			{
				return;
			}
			redirect(base_url('login?url=' . base64_encode($_SERVER["REQUEST_URI"])));
		}
		if ($type != $_SESSION['usertype'])
		{
			switch ($_SESSION['usertype'])
			{
			case 'student':
			case 'teacher':
			case 'manage':
				redirect(base_url('ta/evaluation/' . $_SESSION['usertype']));
				break;
			default:
				unset($_SESSION['userid']);
				redirect(base_url('ta/evaluation/'));
				break;
			}
			
		}
	}
}

