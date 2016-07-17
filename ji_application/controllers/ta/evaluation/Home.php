<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Home
 *
 * Controller ta/evaluation
 *
 * @category   ta
 * @package    ta/evaluation
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 */
class Home extends TA_Controller 
{
	/**
	 * Home constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->Mta_site->redirect_login('');
	}
	
	/**
	 * Index page
	 */
	public function index()
	{
		$data['page_name'] = 'TA Evaluation System';
		$this->load->view('ta/evaluation/index', $data);
	}
}
