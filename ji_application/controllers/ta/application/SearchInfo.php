<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchInfo extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	public function home(){
		$this->load->model('Meditman');
		$xqxn=$this->Meditman->getxqxn();
		$xq=$xqxn[0]->data;
		$xn=$xqxn[1]->data;
		$list=$this->Meditman->getcourseinfo($xq,$xn);
		$data['list']=$list;
		$this->load->view('manager_app_header');
		$this->load->view('manager_app_showcourse',$data);
	}

	public function searchcourse(){
		$xq=$this->input->post('xq');
		$xn=$this->input->post('xn');
		$kcdm=$this->input->post('kcdm');
		$this->load->model('Meditman');
		$list = $this->Meditman->searchcourseinfo($xq,$xn,$kcdm);
//		echo $xq." ".$xn." ".$kcdm;

		echo "<table border='1'><tr>";

		echo "<td>课程代码</td><td>课程名称</td><td>授课老师</td><td>授课学期</td><td>授课学年</td><td>最大TA人数</td>";
		echo "<td>已有TA申请人数</td><td>工资</td><td></td></tr>";

		foreach($list as $item){
			echo "<tr>";
				echo "<td>".$item->KCDM."</td>";
				echo "<td>".$item->KCZWMC."</td>";
				echo "<td>".$item->XM."</td>";
				echo "<td>".$item->XQ."</td>";
				echo "<td>".$item->XN."</td>";
				echo "<td>".$item->maxta."</td>";
				echo "<td>".$item->curta."</td>";
				echo "<td>".$item->salary."</td>";
				echo "<td><input type='button' name='modify' value='修改' id='tz' mb='".$item->KCDM."' /></td>";
			echo "</tr>";
		}

		echo "</table>";
	}


	public function searchstudent(){
		$type=$this->input->post('type');
		$stuinfo=$this->input->post('content');
		$this->load->model('Meditman');
		$list = $this->Meditman->showstuapp($type,$stuinfo);
//		var_dump($list);

		echo "<table class='all-content' width='100%' align='center' border='1'><tr>";
		echo "<td>Applied course</td><td>XQ</td><td>XN</td><td>Status</td><td>Name</td><td>Student ID</td><td>Gender</td><td>Email</td>";
		echo "<td>Faculty</td><td>Grade</td><td>Seif-introduction</td><td>Comment</td><td></td><td></td></tr>";
		foreach($list as $item){
			echo "<tr>";
			echo "<td>".$item->app_course."</td>";
			echo "<td>".$item->xq."</td>";
			echo "<td>".$item->xn."</td>";
			echo "<td>".$item->status."</td>";
			echo "<td>".$item->name."</td>";
			echo "<td>".$item->student_id."</td>";
			echo "<td>".$item->gender."</td>";
			echo "<td>".$item->email."</td>";
			echo "<td>".$item->faculty."</td>";
			echo "<td>".$item->grade."</td>";
			echo "<td>".$item->self_introduction."</td>";
			echo "<td>".$item->comment."</td>";
			if ($item->status==0){
				echo "<td>"."<button name='tz' appid=".$item->id." type='p'>Pass</button>"."</td>";
				echo "<td>"."<button name='tz' appid=".$item->id." type='r'>Reject</button>"."</td>";
			} else {
				echo "<td></td>";
				echo "<td></td>";
			}
			echo "</tr>";
		}
	
		echo "</table>";

	}
}
?>