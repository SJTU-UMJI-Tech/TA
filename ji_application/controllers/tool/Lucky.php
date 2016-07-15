<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//时间
class Lucky extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Mtool');
	}
	public function index(){
		
		$data['asc'] = $this->Mtool->get_lucky_member_asc();
		$data['desc'] = $this->Mtool->get_lucky_member_desc();
		$this->load->view('tool/lucky',$data);
	}
	public function getmember($number){
		$member = $this->Mtool->get_lucky_member($number);
		foreach($member as $m){
			echo "<img src='/ji_upload/tool/lucky/".$m->image.".jpg' />";
			if(isset($_SESSION['jaccount']) && $_SESSION['jaccount']['id']==master){//权限判断
				$this->db->query("update ji_tool_lucky set status=1 where id=".$m->id."");
			}
		}	
	}
}
