<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Mcn');
	}
	public function index(){
		$data['pages'] = $this->Mcn->get_new_pages();
		$data['files'] = $this->Mcn->get_it_files();
		$this->load->view('show/home',$data);
	}
	public function help(){// home/help/3
		$data['help'] = $this->Mcn->get_help();
		$this->load->view('show/help',$data);
	}
}
