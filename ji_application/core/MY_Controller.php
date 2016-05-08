<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TA_Controller extends CI_Controller
{
	public $site_config;
	public $data;
	
    public function __construct()
    {
        parent::__construct();

	    /** 设置语言 */
	    if (!isset($_SESSION['language']))
	    {
		    $_SESSION['language'] = $this->config->item('language');
	    }
	    else
	    {
		    $this->config->set_item('language', $_SESSION['language']);
	    }

	    $this->output->enable_profiler(TRUE);
		
        $this->load->model('Mta_site');
        $this->site_config = $this->Mta_site->get_site_config();
        $this->load->vars($this->site_config);

	    $this->data = array();
    }
	
	public function get_site_config($key)
	{
		return $this->site_config[$key];
	}
}