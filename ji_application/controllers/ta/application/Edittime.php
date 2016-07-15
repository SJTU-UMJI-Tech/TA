<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edittime extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index()
	{	
//		echo 'hho';		
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('Medittime');
		$list=$this->Medittime->getAll();
//		var_dump($list);
		$data['list']=$list;
		$this->load->view('stu_app_head');
		$this->load->view('edittime',$data);
	}
}
?>