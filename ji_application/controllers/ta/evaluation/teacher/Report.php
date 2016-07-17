<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Report
 *
 * Controller ta/evaluation/teacher/report
 *
 * @category   ta
 * @package    ta/evaluation/teacher
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       PHPExcel
 */
class Report extends TA_Controller
{
	/**
	 * Report constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'teacher';
		$this->data['page_name'] = 'TA Evaluation System: TA Report';
		$this->data['banner_id'] = 4;
		$this->Mta_site->redirect_login($this->data['type']);
	}
	
	/**
	 * Index page
	 */
	public function index()
	{
		$data = $this->data;
		$this->load->view('ta/evaluation/report/teacher', $data);
	}
}
