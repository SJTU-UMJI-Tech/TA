<?php
class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
		//session_start();
		$this->load->model('Mlogin');
		$this->load->helper('form');
		
	}
	public function index(){
		if(isset($_SESSION['jaccount'])){//sjtu账户认证
			$getuser = $this->db->query("select * from ji_user where user_id='".$_SESSION['jaccount']['id']."' and user_status=1")->result();
			if($getuser){
				$_SESSION['user']=$_SESSION['jaccount']['id'];
				$this->Mlogin->addlog('Jaccount成功后台登陆',now,$_SESSION['user'],'manage',$_SESSION['user'],'JI');
				header('Location:/manage/home');
			}else{
				$data['logout'] = 1;
			}
		}else{$data['logout'] = 1;}
		$this->load->library('form_validation');//验证数据格式
		$this->form_validation->set_rules('username','username','required');
		$this->form_validation->set_rules('password','password','required');
		$data['url'] = $this->input->get('url');
		$this->load->view('login',$data);
		
	}
	function validate(){//验证用户
		
		$user = $this->input->post('username');
		$pwd = $this->input->post('password');
		$res = $this->Mlogin->validateuser($user,$pwd);
		if($res !== false){
			$_SESSION['user']=$user;
			$this->Mlogin->addlog('成功后台登陆',now,$_SESSION['user'],'manage',$_SESSION['user'],'JI');
			redirect('manage/home');
		}else{
			$this->Mlogin->addlog('失败后台登陆',now,'名字：'.$user.'密码：'.$pwd,'manage',$user,$_SERVER["REMOTE_ADDR"]);
			echo "账户或密码错误，请重新<a href='/login'>登录</a>";	
		}
	}
	
	function test()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$url = $this->input->get('url');
		$_SESSION['userid'] = $username;
		$_SESSION['usertype'] = $password;
		redirect(base_url(base64_decode($url)));
		
	}
	
	function logout(){
		session_destroy();
		header('Location:/jaccount_logout.php');
	}
}?>