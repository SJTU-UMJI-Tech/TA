<?php
class Mtest extends CI_Model{
	var $va = array(
		'username' => 'trim|required2',
		'email' => 'trim2'
	);
	function __construct(){
		parent::__construct();
		//$validation2 = array(
		//	'username' => 'trim|required2',
		//	'email' => 'trim2'
		//);	
	}
	public function validation(){
		return $validation = array(
			'username' => 'trim|required',
			'email' => 'trim'
		);	
	}
	public function get_validation(){
		//global $validation;
		$va = $this->Mtest->validation();
		return $re = $va['username'];	
	}
	public function get_va(){
		global $va;
		echo $va='2';
		//return $this->Mtest->$va;
		
	}
}
?>