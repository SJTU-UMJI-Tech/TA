<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//时间
class Time extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}
	public function countup(){
		$this->load->view('tool/countup');
	}
	public function index(){
		$this->load->view('tool/countup');
	}
	public function countdown(){
		$this->load->view('tool/countdown');
	}
}
