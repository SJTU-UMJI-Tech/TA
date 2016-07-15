<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EdittimeDetail extends CI_Controller {

	public function modify(){	
		$this->load->database();
		$this->load->model('Medittime');
		$obj = $_GET['obj'];
//		var_dump($obj);
		$list = $this->Medittime->search($obj);
		$data['list']=$list;
//		var_dump($data);
		$this->load->view('stu_app_head');
		$this->load->view('edittime_detail',$data);
	}
	
	public function save(){
		$this->load->database();
		$this->load->model('Medittime');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		$this->form_validation->set_rules('time', 'time', 'callback_checktime');
//		$pattern="(\d)(\d)(\d)(\d)-[0-1]?[1-9]-[1-31]";
		$obj = $_GET['obj'];
		$get=$_POST["time"];
//		echo $get;
//		preg_match($pattern,$get,$result); 
//		echo $result;
		$data=array(
			'data'=>$_POST["time"]
		);
		$bool=$this->Medittime->edit($data,$obj);
//		echo $bool;
//		$a=$this->form_validation->run();
//		echo $a;
		if ($this->form_validation->run() == false)
        {
			$this->load->view('stu_app_head');
            $this->load->view('edittime_detail');
        }
        else
        {
			$this->load->view('stu_app_head');
            $this->load->view('editsuccess');			
        }
	}

	public function checktime($str)
    {
		$pattern="^[0-9]{4}-(((0[13578]|(10|12))-(0[1-9]|[1-2][0-9]|3[0-1]))|(02-(0[1-9]|[1-2][0-9]))|((0[469]|11)-(0[1-9]|[1-2][0-9]|30)))$";
        if (preg_match ( $patten, $str ))
        {
            $this->form_validation->set_message('checktime', '时间格式为yyyy-mm-dd');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
?>