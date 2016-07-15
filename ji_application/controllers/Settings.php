<?php if (!defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Settings extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function language()
	{
		$language = $this->input->get('lang');
		$url = $this->input->get('url');
		switch ($language)
		{
		case 'english':
		case 'zh-cn':
			$_SESSION['language'] = $language;
			break;
		}
		redirect(base_url(base64_decode($url)));
	}
	
}


