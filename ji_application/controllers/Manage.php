<?php
/*禁止任何人私自出售本程序，购买正版，联系Q 525562633*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller{
	public function __construct(){
		session_start();
		if(!isset($_SESSION['user'])){
			header("Location:/login");
		}
		parent::__construct();
		$this->load->model('Mmanage');
	}
	function home(){//网站后台首页
		$my['module'] = 'home';
		$data['finishmodules'] = $this->Mmanage->get_finishmodules();
		$data['onmodules'] = $this->Mmanage->get_onmodules();
		$this->load->view('manage/header',$my);
		$this->load->view('manage/home',$data);
	}
	function config(){//网站配置
		$data['cn'] = $this->Mmanage->get_config_cn();
		$data['en'] = $this->Mmanage->get_config_en();
		$my['module'] = 'config';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/config',$data);
	}
	function config_save_cn(){//保存配置
		$saveconfig = array(
			'site_name' => $this->input->post('site_name'),
			'site_title' => $this->input->post('site_title'),
			'site_keywords' => $this->input->post('site_keywords'),
			'site_descript' => $this->input->post('site_descript')
		);
		$this->db->where('id','1');
		$this->db->update('ji_config',$saveconfig);

		echo "<script language='javascript'>alert('中文网站配置修改成功'); window.location.href='config';</script>";
	}
	function config_save_en(){//保存配置
		$saveconfig = array(
			'site_name' => $this->input->post('site_name'),
			'site_title' => $this->input->post('site_title'),
			'site_keywords' => $this->input->post('site_keywords'),
			'site_descript' => $this->input->post('site_descript')
		);
		$this->db->where('id','2');
		$this->db->update('ji_config',$saveconfig);
		echo "<script language='javascript'>alert('英文网站配置修改成功'); window.location.href='config';</script>";
	}
	function slide(){//幻灯片列表
		$data['slide'] = $this->Mmanage->get_slides();
		$my['module'] = 'slide';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/slide',$data);
	}
	function slide_en(){//英文幻灯片列表
		$data['slide'] = $this->Mmanage->get_slide_en();
		$my['module'] = 'slide';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/slide_en',$data);
	}
	function slide_add(){//添加幻灯片
		$my['module'] = 'slide';
		$this->load->view('manage/header',$my);
		if($_SESSION['user']==master){
			$data['lanmus'] = $this->Mmanage->get_lanmus();
		}else{
			$data['lanmus'] = $this->Mmanage->get_lanmus_permit();//从权限表获取LM的ID
		}
		
		$this->load->view('manage/slide_add',$data);
	}
	function slide_save(){//保存幻灯片
		$uploadimg['upload_path'] = './ji_upload/slide/';
		$uploadimg['allowed_types'] = 'png|gif|jpg';
		$uploadimg['file_name'] = 'slide'.date('YmdHis');
		$this->load->library('upload',$uploadimg);
		if($this->input->post('slide_m')!=1){$slide_m=0;}else{$slide_m=1;}
		if(!$this->upload->do_upload('slide_pic')){
//			echo $this->upload->display_errors(); 输出错误信息
			$slidesave = array(
						'slide_title' => $this->input->post('slide_title'),
						'slide_m' => $slide_m,
						'slide_lm' => $this->input->post('slide_lm'),
						'slide_user' => $_SESSION['user'],
						'slide_uploadtime' => now,
						'slide_en' => $this->input->post('slide_en'),
						'slide_content' => $this->input->post('slide_content'),
						'slide_url' => $this->input->post('slide_url'),
						'slide_order' => $this->input->post('slide_order'),
						'slide_publish' => $this->input->post('slide_publish')
					);
			if($this->input->post('id')){
				$this->db->where('id',$this->input->post('id'));
				$this->db->update('ji_slide',$slidesave);
				$this->Mmanage->addlog('更新ji_slide的id为'.$this->input->post('id').'的信息',now,$_SESSION['user'],'slide',$_SESSION['user'],'JI');
			}else{
				$this->db->insert('ji_slide',$slidesave);
				$this->Mmanage->addlog('增加ji_slide的id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'slide',$_SESSION['user'],'JI');
			}
			header("Location:slide");
		}else{
			$data['upload_data']=$this->upload->data();
			$img=$data['upload_data']['file_name'];
			$slidesave = array(
						'slide_title' => $this->input->post('slide_title'),
						'slide_content' => $this->input->post('slide_content'),
						'slide_url' => $this->input->post('slide_url'),
						'slide_m' => $slide_m,
						'slide_uploadtime' => now,
						'slide_user' => $_SESSION['user'],
						'slide_lm' => $this->input->post('slide_lm'),
						'slide_en' => $this->input->post('slide_en'),
						'slide_pic' => $img,
						'slide_order' => $this->input->post('slide_order'),
						'slide_publish' => $this->input->post('slide_publish')
					);
			if(!$this->input->post('id')){
				$this->db->insert('ji_slide',$slidesave);
				$this->Mmanage->addlog('增加ji_slide的id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'slide',$_SESSION['user'],'JI');
			}else{
				$id = $this->input->post('id');
				$this->db->where('id',$id);
				$this->db->update('ji_slide',$slidesave);
				$this->Mmanage->addlog('更新ji_slide的id为'.$this->input->post('id').'的信息',now,$_SESSION['user'],'slide',$_SESSION['user'],'JI');
			}header("Location:slide");
		}
	}
	function slide_edit(){//编辑幻灯片
		$data['slide'] = $this->Mmanage->get_slide_con();
		$my['module'] = 'slide';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/slide_edit',$data);
	}
	function slide_del(){//删除幻灯片
		$delid = $this->uri->segment(3);
		$delarray = array(
			'slide_status' => 0
		);
		$this->db->where('id',$delid);
		$this->db->update('ji_slide',$delarray);
		echo "<script language='javascript'>alert('成功删除数据到回收站'); window.location.href='../slide';</script>";
		//header("Location:../slide");
	}
	function lanmu(){//显示栏目列表
		if($_SESSION['user']=='22414'){
			$data['lanmu'] = $this->Mmanage->get_lanmu();
		}else{
			$data['lanmu'] = $this->Mmanage->get_mylanmu();
		}
		$my['module'] = 'lanmu';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/lanmu',$data);
	}
	function lanmu_add(){
		if($_SESSION['user']=='22414'){
			$data['lanmu'] = $this->Mmanage->get_lanmu();
		}else{
			$data['lanmu'] = $this->Mmanage->get_mylanmu();
		}
		$my['module'] = 'lanmu';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/lanmu_add',$data);
	}
	function lanmu_edit(){
		$data['lanmu'] = $this->Mmanage->get_lanmu();//获取一级栏目
		$data['onelanmu'] = $this->Mmanage->get_lanmu_con();//获取当前需要编辑的栏目的信息
		$my['module'] = 'lanmu';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/lanmu_edit',$data);
	}
	function lanmu_save(){
		if($this->input->post('id')){
			$savelm = array(
			'lm_name' => $this->input->post('lm_name'),
			'lm_enname' => $this->input->post('lm_enname'),
			'lm_pid' => $this->input->post('lm_pid'),
			'lm_keywords' => $this->input->post('lm_keywords'),
			'lm_descript' => $this->input->post('lm_descript'),
			'lm_order' => $this->input->post('lm_order'),
			'lm_status' => $this->input->post('lm_status')
			);
			$this->db->where('id',$this->input->post('id'));
			$this->db->update('ji_lanmu',$savelm);
			$this->Mmanage->addlog('更新ji_lanmu的id为'.$this->input->post('id').'的信息',now,$_SESSION['user'],'lanmu',$_SESSION['user'],'JI');
		}else{
			$savelm = array(
			'lm_name' => $this->input->post('lm_name'),
			'lm_pid' => $this->input->post('lm_pid'),
			'lm_enname' => $this->input->post('lm_enname'),
			'lm_keywords' => $this->input->post('lm_keywords'),
			'lm_descript' => $this->input->post('lm_descript'),
			'lm_order' => $this->input->post('lm_order'),
			'lm_status' => $this->input->post('lm_status')
			);
			$this->db->insert('ji_lanmu',$savelm);
			$this->Mmanage->addlog('增加ji_lanmu的id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'lanmu',$_SESSION['user'],'JI');
		};
		header("Location:lanmu");
	}
	function page(){
		
		if($_SESSION['user']==master){
			$data['pages'] = $this->Mmanage->get_pages();
		}else{
			$data['pages'] = $this->Mmanage->get_pages_permit();//从权限表获取页面
		}
		$my['module'] = 'page';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/page',$data);
	}
	function page_en(){
		$data['pages'] = $this->Mmanage->get_pages_en();
		$my['module'] = 'page';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/page_en',$data);
	}
	function page_add(){
		if($_SESSION['user']==master){
			$data['lanmu'] = $this->Mmanage->get_lanmu();
		}else{
			$data['lanmu'] = $this->Mmanage->get_lanmus_permit();//从权限表获取LM的ID
		}
		if($this->uri->segment(3)){
		$data['page'] = $this->Mmanage->get_page_add_lm();//获取添加英文页面对应的栏目
		}
		$data['id'] = $this->uri->segment(3);
		$my['module'] = 'page';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/page_add',$data);
		
	}
	function page_save(){
		$uploadimg['upload_path'] = './ji_upload/page/';
		$uploadimg['allowed_types'] = 'png|gif|jpg';
		$uploadimg['file_name'] = 'page'.date('YmdHis');
		$this->load->library('upload',$uploadimg);//加载upload模块，并传递数据
		if($this->input->post('page_m')!=1){$page_m=0;}else{$page_m=1;}
		if(!$this->upload->do_upload('page_pic')){//如果没有执行上传操作，则不对图片数据进行操作息
				$savepage = array(
					'page_title' => $this->input->post('page_title'),
					'page_stage' => $this->input->post('page_stage'),
					'page_summary' => $this->input->post('page_summary'),
					'user_id' => $_SESSION['user'],
					'page_lm' => $this->input->post('page_lm'),
					'page_en' => $this->input->post('cnid'),
					'page_m' => $page_m,
					'page_pic' => $this->input->post('page_pic_ab'),
					'page_url' => $this->input->post('page_url'),
					'page_content' => $this->input->post('page_content'),
					'page_keywords' => $this->input->post('page_keywords'),
					'page_descript' => $this->input->post('page_descript'),
					'page_publish' => $this->input->post('page_publish'),
					'page_order' => $this->input->post('page_order')
				);
				if($this->input->post('id')){
					$this->db->where('id',$this->input->post('id'));
					$this->db->update('ji_page',$savepage);
					$this->Mmanage->addlog('更新ji_page的id为'.$this->input->post('id').'的信息',now,$_SESSION['user'],'page',$_SESSION['user'],'JI');
				}else{
					$this->db->insert('ji_page',$savepage);
					$this->Mmanage->addlog('增加ji_page的id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'page',$_SESSION['user'],'JI');
				}
		}else{//如果上传了图片
			$data['upload_data']=$this->upload->data();
			$img=$data['upload_data']['file_name'];
					$savepage = array(
						'page_title' => $this->input->post('page_title'),
						'page_stage' => $this->input->post('page_stage'),
						'page_summary' => $this->input->post('page_summary'),
						'user_id' => $_SESSION['user'],
						'page_lm' => $this->input->post('page_lm'),
						'page_en' => $this->input->post('cnid'),
						'page_m' => $page_m,
						'page_pic' => $img,
						'page_url' => $this->input->post('page_url'),
						'page_content' => $this->input->post('page_content'),
						'page_keywords' => $this->input->post('page_keywords'),
						'page_descript' => $this->input->post('page_descript'),
						'page_publish' => $this->input->post('page_publish'),
						'page_order' => $this->input->post('page_order')
					);
					
				if($this->input->post('id')){
					$this->db->where('id',$this->input->post('id'));
					$this->db->update('ji_page',$savepage);
					$this->Mmanage->addlog('更新ji_page的id为'.$this->input->post('id').'的信息',now,$_SESSION['user'],'page',$_SESSION['user'],'JI');
				}else{
					$this->db->insert('ji_page',$savepage);
					$this->Mmanage->addlog('增加ji_page的id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'page',$_SESSION['user'],'JI');
				}
		}
			header("Location:page");
	}
	function page_edit(){//编辑幻灯片
		$data['pageedit'] = $this->Mmanage->get_page_con();
		if($_SESSION['user']==master){
			$data['lanmu'] = $this->Mmanage->get_lanmu();
		}else{
			$data['lanmu'] = $this->Mmanage->get_lanmus_permit();//从权限表获取LM的ID
		}
		$my['module'] = 'page';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/page_edit',$data);
	}
	function page_del(){//删除页面
		$delid = $this->uri->segment(3);
		$delarray = array(
			'page_status' => 0
		);
		$this->db->where('id',$delid);
		$this->db->update('ji_page',$delarray);
		$this->Mmanage->addlog('删除ji_page的id为'.$delid.'的信息',now,$_SESSION['user'],'page',$_SESSION['user'],'JI');
		echo "<script language='javascript'>alert('成功删除数据到回收站'); window.location.href='../page';</script>";
		//header("Location:../page");
	}
	function activity(){
		$p = $this->uri->segment(3);//加载model
		if($p){
			$data['act'] = $this->Mmanage->get_act(($p-1)*20,20);//获取全部faculty
			}else{
			$data['act'] = $this->Mmanage->get_act(0,20);//获取全部faculty
		}
			
		$this->load->library('pagination');//加载分页类
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->Mmanage->get_act_num();
		$config['per_page'] = 20;//每页显示的数量
		$config['first_url'] = '/manage/activity';
		$config['base_url'] = '/manage/activity/';//基本URL路径
		$config['num_links'] = 3; // 当前连接前后显示页码个数
//      $config['full_tag_open'] = '<div class="pagination">'; // 分页开始样式
//      $config['full_tag_close'] = '</div>'; // 分页结束样式
        $config['first_link'] = '首页'; // 第一页显示
        $config['last_link'] = '末页'; // 最后一页显示
        $config['next_link'] = '下一页 >'; // 下一页显示
        $config['prev_link'] = '< 上一页'; // 上一页显示
        $config['cur_tag_open'] = ' <a class="current">'; // 当前页开始样式
        $config['cur_tag_close'] = '</a>'; // 当前页结束样式

        $this->pagination->initialize($config); // 配置分页
		$data['pager'] = $this->pagination->create_links();//创建分页
		
		$my['module'] = 'activity';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/activity',$data);
	}
	function activity_en(){
		$p = $this->uri->segment(3);//加载model
		if($p){
			$data['act'] = $this->Mmanage->get_act_en(($p-1)*20,20);//获取全部faculty
			}else{
			$data['act'] = $this->Mmanage->get_act_en(0,20);//获取全部faculty
		}
			
		$this->load->library('pagination');//加载分页类
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->Mmanage->get_act_en_num();
		$config['per_page'] = 20;//每页显示的数量
		$config['first_url'] = '/manage/activity_en';
		$config['base_url'] = '/manage/activity_en/';//基本URL路径
		$config['num_links'] = 3; // 当前连接前后显示页码个数
//      $config['full_tag_open'] = '<div class="pagination">'; // 分页开始样式
//      $config['full_tag_close'] = '</div>'; // 分页结束样式
        $config['first_link'] = '首页'; // 第一页显示
        $config['last_link'] = '末页'; // 最后一页显示
        $config['next_link'] = '下一页 >'; // 下一页显示
        $config['prev_link'] = '< 上一页'; // 上一页显示
        $config['cur_tag_open'] = ' <a class="current">'; // 当前页开始样式
        $config['cur_tag_close'] = '</a>'; // 当前页结束样式

        $this->pagination->initialize($config); // 配置分页
		$data['pager'] = $this->pagination->create_links();//创建分页
		$my['module'] = 'activity';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/activity_en',$data);
	}
	function activity_add(){
		$data['id'] = $this->uri->segment(3);
		if($this->uri->segment(3)){
		$data['act'] = $this->Mmanage->get_act_add_lm();
		}
		$my['module'] = 'activity';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/activity_add',$data);
	}
	function activity_save(){//保存活动
		$uploadimg['upload_path'] = './ji_upload/act/';
		$uploadimg['allowed_types'] = 'png|gif|jpg';
		$uploadimg['file_name'] = 'act'.date('YmdHis');
		$this->load->library('upload',$uploadimg);
		if($this->input->post('act_m')!=1){$act_m=0;}else{$act_m=1;}
		if(!$this->upload->do_upload('act_pic')){
//			echo $this->upload->display_errors(); 输出错误信息
			$actsave = array(
						'act_name' => $this->input->post('act_name'),
						'act_m' => $act_m,
						'act_en' => $this->input->post('cnid'),
						'act_class' => $this->input->post('act_class'),
						'act_content' => $this->input->post('act_content'),
						'act_summary' => $this->input->post('act_summary'),
						'act_url' => $this->input->post('act_url'),
						'act_redirect' => $this->input->post('act_redirect'),
						'act_start' => $this->input->post('act_start'),
						'act_end' => $this->input->post('act_end'),
						'act_place' => $this->input->post('act_place'),
						'act_keywords' => $this->input->post('act_keywords'),
						'act_descript' => $this->input->post('act_descript'),
						'act_order' => $this->input->post('act_order'),
						'act_publish' => $this->input->post('act_publish')
					);
			if($this->input->post('id')){
				$this->db->where('id',$this->input->post('id'));
				$this->db->update('ji_activity',$actsave);
			}else{
				$this->db->insert('ji_activity',$actsave);
			}
			header("Location:activity");
		}else{
			$data['upload_data']=$this->upload->data();
			$img=$data['upload_data']['file_name'];
			$actsave = array(
						'act_name' => $this->input->post('act_name'),
						'act_m' => $act_m,
						'act_en' => $this->input->post('cnid'),
						'act_class' => $this->input->post('act_class'),
						'act_content' => $this->input->post('act_content'),
						'act_summary' => $this->input->post('act_summary'),
						'act_url' => $this->input->post('act_url'),
						'act_redirect' => $this->input->post('act_redirect'),
						'act_start' => $this->input->post('act_start'),
						'act_end' => $this->input->post('act_end'),
						'act_place' => $this->input->post('act_place'),
						'act_pic' => $img,
						'act_keywords' => $this->input->post('act_keywords'),
						'act_descript' => $this->input->post('act_descript'),
						'act_order' => $this->input->post('act_order'),
						'act_publish' => $this->input->post('act_publish')
					);
			if(!$this->input->post('id')){
				$this->db->insert('ji_activity',$actsave);
			}else{
				$id = $this->input->post('id');
				$this->db->where('id',$id);
				$this->db->update('ji_activity',$actsave);
				
			}header("Location:activity");
		}
	}
	function activity_edit(){//编辑活动
		$data['actedit'] = $this->Mmanage->get_act_con();
		$my['module'] = 'activity';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/activity_edit',$data);
	}
	function activity_del(){//删除页面
		$delid = $this->uri->segment(3);
		$delarray = array(
			'act_status' => 0
		);
		$this->db->where('id',$delid);
		$this->db->update('ji_activity',$delarray);
		echo "<script language='javascript'>alert('成功删除数据到回收站'); window.location.href='../activity';</script>";
		//header("Location:../activity");
	}
	function article(){
		$p = $this->uri->segment(3);
		if($p){
			$data['article'] = $this->Mmanage->get_article(($p-1)*20,20);
		}else{
			$data['article'] = $this->Mmanage->get_article(0,20);
		}
		$this->load->library('pagination');    //加载分页类
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->Mmanage->get_article_count();   //获取总条数
		$config['per_page'] = 20;    //每页显示的数量
		$config['first_url'] = '/manage/article';   //第一页的URL
		$config['base_url'] = '/manage/article/';    //基本URL路径
		$config['num_links'] = 3; // 当前连接前后显示页码个数
//      $config['full_tag_open'] = '<div class="pagination">'; // 分页开始样式
//      $config['full_tag_close'] = '</div>'; // 分页结束样式
        $config['first_link'] = '首页'; // 第一页显示
        $config['last_link'] = '末页'; // 最后一页显示
        $config['next_link'] = '下一页 >'; // 下一页显示
        $config['prev_link'] = '< 上一页'; // 上一页显示
        $config['cur_tag_open'] = ' <a class="current">'; // 当前页开始样式
        $config['cur_tag_close'] = '</a>'; // 当前页结束样式
		$this->pagination->initialize($config); // 配置分页
		$data['pager'] = $this->pagination->create_links();//创建分页
		
		$my['module'] = 'article';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/article',$data);
	}
	function article_en(){
		$p = $this->uri->segment(3);
		if($p){
			$data['article'] = $this->Mmanage->get_article_en(($p-1)*20,20);
		}else{
			$data['article'] = $this->Mmanage->get_article_en(0,20);
		}
		$this->load->library('pagination');    //加载分页类
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->Mmanage->get_article_en_count();   //获取总条数
		$config['per_page'] = 20;    //每页显示的数量
		$config['first_url'] = '/manage/article_en';   //第一页的URL
		$config['base_url'] = '/manage/article_en/';    //基本URL路径
		$config['num_links'] = 3; // 当前连接前后显示页码个数
//      $config['full_tag_open'] = '<div class="pagination">'; // 分页开始样式
//      $config['full_tag_close'] = '</div>'; // 分页结束样式
        $config['first_link'] = '首页'; // 第一页显示
        $config['last_link'] = '末页'; // 最后一页显示
        $config['next_link'] = '下一页 >'; // 下一页显示
        $config['prev_link'] = '< 上一页'; // 上一页显示
        $config['cur_tag_open'] = ' <a class="current">'; // 当前页开始样式
        $config['cur_tag_close'] = '</a>'; // 当前页结束样式
		$this->pagination->initialize($config); // 配置分页
		$data['pager'] = $this->pagination->create_links();//创建分页
		
		$my['module'] = 'article';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/article_en',$data);
	}
	function article_add(){
		$data['fenlei'] = $this->Mmanage->get_lanmu_news();
		if($this->uri->segment(3)){
			$data['art'] = $this->Mmanage->get_article_con();
		}
		$my['module'] = 'article';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/article_add',$data);
	}
	function article_edit(){//编辑活动
		$data['fenlei'] = $this->Mmanage->get_lanmu_news();
		$data['art'] = $this->Mmanage->get_article_con();
		$my['module'] = 'article';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/article_edit',$data);
	}
	function article_del(){//删除页面
		$delid = $this->uri->segment(3);
		$delarray = array(
			'art_status' => 0
		);
		$this->db->where('id',$delid);
		$this->db->update('ji_article',$delarray);
		echo "<script language='javascript'>alert('成功删除数据到回收站'); window.location.href='../article';</script>";
	}
	function article_save(){
		$uploadimg['upload_path'] = './ji_upload/art/';
		$uploadimg['allowed_types'] = 'png|gif|jpg';
		$uploadimg['file_name'] = 'art'.date('YmdHis');
		$this->load->library('upload',$uploadimg);
		if($this->input->post('art_m')!=1){$art_m=0;}else{$art_m=1;}
		if(!$this->upload->do_upload('art_pic')){
			$saveart = array(
				'art_title' => $this->input->post('art_title'),
				'art_class' => $this->input->post('art_class'),
				'art_url' => $this->input->post('art_url'),
				'art_en' => $this->input->post('cnid'),
				'art_m' => $art_m,
				'art_author' => $this->input->post('art_author'),
				'art_tags' => $this->input->post('art_tags'),
				'art_addtime' => $this->input->post('art_addtime'),
				'art_summary' => $this->input->post('art_summary'),
				'art_content' => $this->input->post('art_content'),
				'art_keywords' => $this->input->post('art_keywords'),
				'art_descript' => $this->input->post('art_descript'),
				'art_publish' => $this->input->post('art_publish'),
				'art_order' => $this->input->post('art_order')
			);
			if(!$this->input->post('id')){
				$this->db->insert('ji_article',$saveart);
			}else{
				$this->db->where('id',$this->input->post('id'));
				$this->db->update('ji_article',$saveart);
			}
			
		}else{
			$data['upload_data']=$this->upload->data();
			$img=$data['upload_data']['file_name'];
			$saveart = array(
				'art_title' => $this->input->post('art_title'),
				'art_class' => $this->input->post('art_class'),
				'art_en' => $this->input->post('cnid'),
				'art_pic' => $img,
				'art_m' => $art_m,
				'art_url' => $this->input->post('art_url'),
				'art_author' => $this->input->post('art_author'),
				'art_tags' => $this->input->post('art_tags'),
				'art_addtime' => $this->input->post('art_addtime'),
				'art_summary' => $this->input->post('art_summary'),
				'art_content' => $this->input->post('art_content'),
				'art_keywords' => $this->input->post('art_keywords'),
				'art_descript' => $this->input->post('art_descript'),
				'art_publish' => $this->input->post('art_publish'),
				'art_order' => $this->input->post('art_order')
			);
			if(!$this->input->post('id')){
				$this->db->insert('ji_article',$saveart);
			}else{
				$this->db->where('id',$this->input->post('id'));
				$this->db->update('ji_article',$saveart);
			}
		}
		header("Location:article");
	}
	function faculty(){
		$p = $this->uri->segment(3);//加载model
		if($p){
			$data['faculty'] = $this->Mmanage->get_faculty_cn(($p-1)*10,10);//获取全部faculty
			}else{
			$data['faculty'] = $this->Mmanage->get_faculty_cn(0,10);//获取全部faculty
		}
			
		$this->load->library('pagination');//加载分页类
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->Mmanage->get_faculty_num_cn();
		$config['per_page'] = 10;//每页显示的数量
		$config['first_url'] = '/manage/faculty';
		$config['base_url'] = '/manage/faculty/';//基本URL路径
		$config['num_links'] = 3; // 当前连接前后显示页码个数
//      $config['full_tag_open'] = '<div class="pagination">'; // 分页开始样式
//      $config['full_tag_close'] = '</div>'; // 分页结束样式
        $config['first_link'] = '首页'; // 第一页显示
        $config['last_link'] = '末页'; // 最后一页显示
        $config['next_link'] = '下一页 >'; // 下一页显示
        $config['prev_link'] = '< 上一页'; // 上一页显示
        $config['cur_tag_open'] = ' <a class="current">'; // 当前页开始样式
        $config['cur_tag_close'] = '</a>'; // 当前页结束样式

        $this->pagination->initialize($config); // 配置分页
		$data['pager'] = $this->pagination->create_links();//创建分页
		$my['module'] = 'faculty';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/faculty',$data);
	}
	function faculty_en(){
		$p = $this->uri->segment(3);//加载model
		if($p){
			$data['faculty'] = $this->Mmanage->get_faculty_en(($p-1)*10,10);//获取全部faculty
			}else{
			$data['faculty'] = $this->Mmanage->get_faculty_en(0,10);//获取全部faculty
		}
			
		$this->load->library('pagination');//加载分页类
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->Mmanage->get_faculty_num_en();
		$config['per_page'] = 10;//每页显示的数量
		$config['first_url'] = '/manage/faculty_en';
		$config['base_url'] = '/manage/faculty_en/';//基本URL路径
		$config['num_links'] = 3; // 当前连接前后显示页码个数
		
//      $config['full_tag_open'] = '<div class="pagination">'; // 分页开始样式
//      $config['full_tag_close'] = '</div>'; // 分页结束样式
        $config['first_link'] = '首页'; // 第一页显示
        $config['last_link'] = '末页'; // 最后一页显示
        $config['next_link'] = '下一页 >'; // 下一页显示
        $config['prev_link'] = '< 上一页'; // 上一页显示
        $config['cur_tag_open'] = ' <a class="current">'; // 当前页开始样式
        $config['cur_tag_close'] = '</a>'; // 当前页结束样式

        $this->pagination->initialize($config); // 配置分页
		$data['pager'] = $this->pagination->create_links();//创建分页
		$my['module'] = 'faculty';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/faculty_en',$data);
	}
	function faculty_add(){
		if($this->uri->segment(3)){
			$data['id'] = $this->uri->segment(3);
			$this->load->model('Mmanage');
			$data['faculty'] = $this->Mmanage->get_faculty_con();
		}
		$my['module'] = 'faculty';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/faculty_add',$data);
	}
	function faculty_save(){
		$uploadimg['upload_path'] = './ji_upload/faculty/';
		$uploadimg['allowed_types'] = 'png|gif|jpg';
		$uploadimg['file_name'] = 'faculty'.date('YmdHis');
		$this->load->library('upload',$uploadimg);
		if($this->input->post('f_m')!=1){$f_m=0;}else{$f_m=1;}
		if(!$this->upload->do_upload('f_pic')){
//			echo $this->upload->display_errors(); 输出错误信息
			if(!$this->input->post('cnid')){$f_en=0;}else{
				$f_en = $this->input->post('cnid');	
			}
			$fsave = array(
						'f_name' => $this->input->post('f_name'),
						'f_m' => $f_m,
						'f_en' => $f_en,
						'f_class' => $this->input->post('f_class'),
						'f_style' => $this->input->post('f_style'),
						'f_content' => $this->input->post('f_content'),
						'f_url' => $this->input->post('f_url'),
						'f_country' => $this->input->post('f_country'),
						'f_zhiwu' => $this->input->post('f_zhiwu'),
						'f_area' => $this->input->post('f_area'),
						'f_email' => $this->input->post('f_email'),
						'f_homepage' => $this->input->post('f_homepage'),
						'f_keywords' => $this->input->post('f_keywords'),
						'f_descript' => $this->input->post('f_descript'),
						'f_order' => $this->input->post('f_order'),
						'f_tel' => $this->input->post('f_tel'),
						'f_publish' => $this->input->post('f_publish')
					);
					echo '没有图片';
			if(!$this->input->post('id')){
				$this->db->insert('ji_faculty',$fsave);
				echo "<script language='javascript'>alert('成功添加数据'); window.location.href='faculty';</script>";
			}else{
				$id = $this->input->post('id');
				$this->db->where('id',$id);
				$this->db->update('ji_faculty',$fsave);
				echo "<script language='javascript'>alert('成功更新数据'); window.location.href='faculty';</script>";
			}//header("Location:faculty");
		}else{
			$data['upload_data']=$this->upload->data();
			$img=$data['upload_data']['file_name'];
			echo $img;
			$fsave = array(
						'f_name' => $this->input->post('f_name'),
						'f_m' => $f_m,
						'f_en' => $this->input->post('cnid'),
						'f_class' => $this->input->post('f_class'),
						'f_style' => $this->input->post('f_style'),
						'f_content' => $this->input->post('f_content'),
						'f_zhiwu' => $this->input->post('f_zhiwu'),
						'f_url' => $this->input->post('f_url'),
						'f_country' => $this->input->post('f_country'),
						'f_area' => $this->input->post('f_area'),
						'f_email' => $this->input->post('f_email'),
						'f_homepage' => $this->input->post('f_homepage'),
						'f_keywords' => $this->input->post('f_keywords'),
						'f_descript' => $this->input->post('f_descript'),
						'f_order' => $this->input->post('f_order'),
						'f_tel' => $this->input->post('f_tel'),
						'f_publish' => $this->input->post('f_publish'),
						'f_pic' => $img
					);
			if(!$this->input->post('id')){
				$this->db->insert('ji_faculty',$fsave);
				echo "<script language='javascript'>alert('成功添加数据'); window.location.href='faculty';</script>";
			}else{
				$id = $this->input->post('id');
				$this->db->where('id',$id);
				$this->db->update('ji_faculty',$fsave);
				echo "<script language='javascript'>alert('成功更新数据'); window.location.href='faculty';</script>";
			}//header("Location:faculty");
		}
	}
	function faculty_edit(){
		$data['faculty'] = $this->Mmanage->get_faculty_con();
		$my['module'] = 'faculty';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/faculty_edit',$data);
	}
	function faculty_del(){//删除页面
		$delid = $this->uri->segment(3);
		$delarray = array(
			'f_status' => 0
		);
		$this->db->where('id',$delid);
		$this->db->update('ji_faculty',$delarray);
		echo "<script language='javascript'>alert('成功删除数据到回收站'); window.location.href='../faculty';</script>";
		//header("Location:../faculty");
	}
	function files(){
		$data['file'] = $this->Mmanage->get_files();
		$my['module'] = 'files';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/file',$data);
	}
	function file_add(){
		if($_SESSION['user'] && $_SESSION['user']==master){
			$data['lanmu'] = $this->Mmanage->get_lanmus();
		}else{
			$data['lanmu'] = $this->Mmanage->get_mylanmu();
		}
		
		$my['module'] = 'files';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/file_add',$data);
	}
	function file_edit(){
		$data['file'] = $this->Mmanage->get_file_con();
		if($_SESSION['user'] != master){
			if($_SESSION['user'] != $data['file']['file_user']){
				header('Location:/manage/home');
				return;	
			}
		}
		if($_SESSION['user'] && $_SESSION['user']==master){
			$data['lanmu'] = $this->Mmanage->get_lanmus();
		}else{
			$data['lanmu'] = $this->Mmanage->get_mylanmu();
		}
		$my['module'] = 'files';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/file_edit',$data);
	}
	function file_save(){
		$id = $this->input->post('id');
		if($id){
			$data['file'] = $this->Mmanage->get_file_con();
			if($_SESSION['user'] != master){
				if($_SESSION['user'] != $data['file']['file_user']){
					header('Location:/manage/home');
					return;	
				}
			}
		}
		$uploadimg['upload_path'] ='./ji_upload/files/';
		$uploadimg['allowed_types'] ='png|jpg|gif|docx|doc|ppt|pdf|rar|mdb|sql|xls|xlsx|zip|iso';
		$uploadimg['file_name'] = 'file'.date('YmdHis');
		$this->load->library('upload',$uploadimg);

		if(!$this->upload->do_upload('file_file') && $id){//如果没有上传成功 并且为编辑状态
			$savefile = array(
				'file_name' => $this->input->post('file_name'),
				'file_url' => $this->input->post('file_url'),
				'file_en' => $this->input->post('file_en'),
				'file_class' => $this->input->post('file_class'),
				'file_user' => $_SESSION['user'],
				'file_time' => $this->input->post('file_time'),
				'file_order' => $this->input->post('file_order'),
				'file_publish' => $this->input->post('file_publish')
				);
			$this->db->where('id',$id);
			$this->db->update('ji_file',$savefile);
		}else{
			$data['upload_data']=$this->upload->data();
			$file=$data['upload_data']['file_name'];
			$savefile = array(
				'file_name' => $this->input->post('file_name'),
				'file_file' => $file,
				'file_user' => $_SESSION['user'],
				'file_en' => $this->input->post('file_en'),
				'file_url' => $this->input->post('file_url'),
				'file_class' => $this->input->post('file_class'),
				'file_time' => $this->input->post('file_time'),
				'file_order' => $this->input->post('file_order'),
				'file_publish' => $this->input->post('file_publish')
				);
			if(!$this->input->post('id')){//如果上传了，并且不是编辑，则增加
				$this->db->insert('ji_file',$savefile);
				$this->Mmanage->addlog('修改ji_file中id为'.$id.'的信息',now,$_SESSION['user'],'file',$_SESSION['user'],'JI');
			}else{//上传了，但是为编辑，则更新
				
				$this->db->where('id',$id);
				$this->db->update('ji_file',$savefile);
				$this->Mmanage->addlog('修改ji_file中id为'.$id.'的信息',now,$_SESSION['user'],'file',$_SESSION['user'],'JI');
			}
		}
		header('Location:/manage/files');
	}
	function file_del(){
		$arr = array(
			'file_status' => 0
			);
		$this->db->where('id',$this->uri->segment(3));
		$this->db->update('ji_file',$arr);
		$this->Mmanage->addlog('删除ji_file中id为'.$this->uri->segment(3).'的信息',now,$_SESSION['user'],'file',$_SESSION['user'],'JI');
		header('Location:../file');
	}
	function user(){
		if(isset($_SESSION['user'])!='22414'){die;}
		if($this->uri->segment(3)=='disable'){
			$this->db->query("update ji_user set user_status=0 where user_id='".$this->uri->segment(4)."'");
			header("Location:/manage/user");
			die;
		}
		if($this->uri->segment(3)=='enable'){
			$this->db->query("update ji_user set user_status=1 where user_id='".$this->uri->segment(4)."'");
			header("Location:/manage/user");
			die;
		}
		$data['user'] = $this->Mmanage->get_user();
		$data['users'] = $this->Mmanage->get_users();
		$my['module'] = 'user';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/user',$data);
	}
	function user_save(){
		$data = $this->Mmanage->get_user();//读取一条数据，以便获取user_name
		$olduser = $this->input->post('user_oldname');//现在的用户名，必须。如果用户更改用户名，则要验证当前的用户名和密码是否正确。
		$user = $this->input->post('user_name'); //即将要修改的用户名
		$password = md5($this->input->post('user_password'));
		$pwd1 = md5($this->input->post('user_pwd1'));
		$pwd2 = md5($this->input->post('user_pwd2'));
		if($password == $data['user_password'] && $pwd1 == $pwd2){//如果旧用户与密码都正确，而且密码与确认密码一致
			$arr = array(
				'user_name' => $user,
				'user_password' => $pwd1
				);
			$this->db->where('id',$_SESSION['userid']);//登录的时候产生，login
			$this->db->update('ji_user',$arr);
			session_destroy();
			echo "<script language='javascript'>alert('密码修改成功！请牢记您的密码并重新登陆本系统！'); window.location.href='home';</script>";
		}elseif($password != $data['user_password']){
			echo "<script language='javascript'>alert('您输入的旧密码不正确，请输入之前登陆本系统使用的密码'); window.location.href='user_password';</script>";
		}elseif($pwd1 != $pwd2){
			echo "<script language='javascript'>alert('您两次输入的新密码不一致'); window.location.href='user_password';</script>";
		}
	}
	function user_password(){
		$data['user'] = $this->Mmanage->get_user();
		$my['module'] = 'user_password';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/user_password',$data);
	}
	function video(){//视频列表
		$data['video'] = $this->Mmanage->get_video();
		$my['module'] = 'video';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/video',$data);
	}
	function video_add(){
		$my['module'] = 'video';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/video_add');
	}
	function video_save(){
		$uploadimg['upload_path'] = './ji_upload/video/';
		$uploadimg['allowed_types'] = 'png|gif|jpg';
		$uploadimg['file_name'] = 'video'.date('YmdHis');
		$this->load->library('upload',$uploadimg);
		if(!$this->upload->do_upload('v_pic')){
			//echo $this->upload->display_errors(); //输出错误信息
			$vsave = array(
						'v_title' => $this->input->post('v_title'),
						'v_summary' => $this->input->post('v_summary'),
						'v_url' => $this->input->post('v_url'),
						'v_order' => $this->input->post('v_order'),
						'v_keywords' => $this->input->post('v_keywords'),
						'v_descript' => $this->input->post('v_descript'),
						'v_publish' => $this->input->post('v_publish')
					);
			if(!$this->input->post('id')){
				$this->db->insert('ji_video',$vsave);//如果没有接受到id的值，则增加新的条目
				$this->Mmanage->addlog('增加ji_video中id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'video',$_SESSION['user'],'JI');
			}else{
				$this->db->where('id',$this->input->post('id'));
				$this->db->update('ji_video',$vsave);
				$this->Mmanage->addlog('修改ji_video中id为'.$this->input->post('id').'的信息',now,$_SESSION['user'],'video',$_SESSION['user'],'JI');
			}
		}else{
			$data['upload_data']=$this->upload->data();
			$img=$data['upload_data']['file_name'];
			$vsave = array(
						'v_title' => $this->input->post('v_title'),
						'v_summary' => $this->input->post('v_summary'),
						'v_url' => $this->input->post('v_url'),
						'v_pic' => $img,
						'v_order' => $this->input->post('v_order'),
						'v_keywords' => $this->input->post('v_keywords'),
						'v_descript' => $this->input->post('v_descript'),
						'v_publish' => $this->input->post('v_publish')
					);
			if(!$this->input->post('id')){
				$this->db->insert('ji_video',$vsave);
				$this->Mmanage->addlog('增加ji_video中id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'video',$_SESSION['user'],'JI');

			}else{
				$this->db->where('id',$this->input->post('id'));
				$this->db->update('ji_video',$vsave);
				$this->Mmanage->addlog('修改ji_video中id为'.$this->input->post('id').'的信息',now,$_SESSION['user'],'video',$_SESSION['user'],'JI');

				
			}
		}header("Location:video");
	}
	function video_edit(){//编辑幻灯片
		$data['v'] = $this->Mmanage->get_video_con();
		$my['module'] = 'video';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/video_edit',$data);
	}
	function video_del(){//删除幻灯片
		$delid = $this->uri->segment(3);
		$delarray = array(
			'v_status' => 0
		);
		$this->db->where('id',$delid);
		$this->db->update('ji_video',$delarray);
		$this->Mmanage->addlog('删除ji_video中id为'.$delid.'的信息',now,$_SESSION['user'],'video',$_SESSION['user'],'JI');
		echo "<script language='javascript'>alert('成功删除数据到回收站'); window.location.href='../video';</script>";
	}
	function tuisong_list(){
		$data['tuisong'] = $this->Mmanage->get_tuisong();
		$my['module'] = 'tuisong';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/tuisong_list',$data);
	}
	function tuisong(){
		$class = $this->uri->segment(3);
		$my['module'] = 'tuisong';
		if($class==news){
			$this->load->model('Mmanage');
			$con = $this->Mmanage->get_tuisong_news();
			$data['title'] = $con['art_title'];
			$data['fid'] = $con['id'];
			$data['summary'] = $con['art_summary'];
			$data['pic'] = $con['art_pic'];
			$data['ttime'] = $con['art_addtime'];
			$data['url'] = $con['art_url'];
			$data['class'] = 'news';
			
		}
		if($class==faculty){
			$this->load->model('Mmanage');
			$con = $this->Mmanage->get_tuisong_faculty();
			$data['title'] = $con['f_name'].'('.$con['f_country'].')';
			$data['fid'] = $con['id'];
			$data['summary'] = $con['f_zhiwu'];
			$data['pic'] = $con['f_pic'];
			$data['url'] = $con['f_url'];
			$data['class'] = 'faculty';
		}
		if($class==activity){
			$this->load->model('Mmanage');
			$con = $this->Mmanage->get_tuisong_activity();
			$data['title'] = $con['act_name'];
			$data['fid'] = $con['id'];
			$data['summary'] = $con['act_summary'];
			$data['pic'] = $con['act_pic'];
			$data['ttime'] = $con['act_start'];
			$data['url'] = $con['act_url'];
			$data['class'] = 'activity';
		}
		if($class==alumni){
			$this->load->model('Mmanage');
			$con = $this->Mmanage->get_tuisong_alumni();
			$data['title'] = $con['f_name'].'('.$con['f_country'].')';
			$data['fid'] = $con['id'];
			$data['summary'] = $con['f_zhiwu'];
			$data['pic'] = $con['f_pic'];
			$data['url'] = $con['f_url'];
			$data['class'] = 'alumni';
		}
		$this->load->view('manage/header',$my);
		$this->load->view('manage/tuisong_add',$data);
	}
	function tuisong_save(){
		$uploadimg['upload_path'] = './ji_upload/tuisong/';
		$uploadimg['allowed_types'] = 'png|gif|jpg';
		$uploadimg['file_name'] = 'tuisong'.'-'.$this->input->post('class').date('YmdHis');
		$this->load->library('upload',$uploadimg);
		if(!$this->upload->do_upload('pic')){
			$save = array(
				'title' => $this->input->post('title'),
				'class' => $this->input->post('class'),
				'ten' => $this->input->post('ten'),
				'fid' => $this->input->post('fid'),
				'summary' => $this->input->post('summary'),
				'publish' => $this->input->post('publish'),
				'pic' => $this->input->post('pic2'),
				'url' => $this->input->post('url'),
				'tuisong_order' => $this->input->post('tuisong_order'),
				'ttime' => $this->input->post('time')
			);
		}else{
			$data['upload_data']=$this->upload->data();
			$img=$data['upload_data']['file_name'];
			$save = array(
				'title' => $this->input->post('title'),
				'class' => $this->input->post('class'),
				'ten' => $this->input->post('ten'),
				'fid' => $this->input->post('fid'),
				'summary' => $this->input->post('summary'),
				'publish' => $this->input->post('publish'),
				'pic' => $img,
				'url' => $this->input->post('url'),
				'tuisong_order' => $this->input->post('tuisong_order'),
				'ttime' => $this->input->post('time')
			);
		}
		if($this->input->post('tid')){
			$this->db->where(id,$this->input->post('tid'));
			$this->db->update('ji_tuisong',$save);
			$this->Mmanage->addlog('修改ji_tuisong中tid为'.$this->input->post('tid').'的信息',now,$_SESSION['user'],'tuisong',$_SESSION['user'],'JI');

		}else{
			$this->db->insert('ji_tuisong',$save);
		}
		echo "<script language='javascript'>alert('添加推送成功，请即刻确认内容是否正确！'); window.location.href='/manage/tuisong_list';</script>";
	}
	function tuisong_edit(){
		$con = $this->Mmanage->get_tuisong_con();
			$data['title'] = $con['title'];
			$data['fid'] = $con['fid'];
			$data['summary'] = $con['summary'];
			$data['pic'] = $con['pic'];
			$data['ten'] = $con['ten'];
			$data['url'] = $con['url'];
			$data['class'] = $con['class'];
			$data['ttime'] = $con['ttime'];
			$data['publish'] = $con['publish'];
			$data['tuisong_order'] = $con['tuisong_order'];
			$data['tid'] = $con['id'];//推送ID
		$my['module'] = 'tuisong';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/tuisong_add',$data);
	}
	function tuisong_del(){
		$delid = $this->uri->segment(3);
		$this->db->delete('tuisong',array('id'=>$delid));
		$this->Mmanage->addlog('删除tuisong中id为'.$delid.'的信息',now,$_SESSION['user'],'tuisong',$_SESSION['user'],'JI');
		echo "<script language='javascript'>alert('成功永久性删除数据'); window.location.href='/manage/tuisong_list';</script>";
	}
	function equivalence(){//转学分
		$my['module'] = 'equivalence';
		$this->load->view('manage/header',$my);
		if($this->uri->segment(3)==''){
			$my['title'] = '大学列表';
			$this->load->view('manage/equivalence_header',$my);
			$data['universities'] = $this->Mmanage->get_universities();
			$this->load->view('manage/equivalence_university',$data);
		}
		if($this->uri->segment(3)=='university' && $this->uri->segment(4)=='disable'){//关闭大学
			$this->db->query("update equivalence_university set university_status=0 where university_id=".$this->uri->segment(5)."");
			header("Location:/manage/equivalence");die;
		}
		if($this->uri->segment(3)=='university' && $this->uri->segment(4)=='enable'){//开启大学
			$this->db->query("update equivalence_university set university_status=1 where university_id=".$this->uri->segment(5)."");
			header("Location:/manage/equivalence");die;
		}
		if($this->uri->segment(3)=='university' && $this->uri->segment(4)=='course'){//大学的课程
			$my['university'] = $this->Mmanage->get_university();
			$my['title'] = $my['university']['university_name'].' 的所有课程';
			$this->load->view('manage/equivalence_header',$my);
			$data['courses'] = $this->Mmanage->get_courses();
			$this->load->view("manage/equivalence_courses.php",$data);
		}
		if($this->uri->segment(3)=='university' && $this->uri->segment(4)=='add'){//添加大学
			$this->load->view("manage/equivalence_university_add.php");
		}
		if($this->uri->segment(3)=='university' && $this->uri->segment(4)=='edit'){//编辑大学
			$data['university'] = $this->Mmanage->get_university();
			$this->load->view("manage/equivalence_university_edit.php",$data);
		}
		if($this->uri->segment(3)=='university' && $this->uri->segment(4)=='save'){//保存大学
			if(!$this->input->post('top')){$top =0;}else{$top =1;}
			$save = array(
				'university_name' => $this->input->post('name'),
				'university_city' => $this->input->post('city'),
				'university_country' => $this->input->post('country'),
				'university_letter' => $this->input->post('letter'),
				'university_remarks' => $this->input->post('remarks'),
				'university_top' => $top
			);
			$this->db->insert('equivalence_university',$save);
			$this->Mmanage->addlog('增加equivalence_university中university_id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'equivalence',$_SESSION['user'],'JI');
			header("Location:/manage/equivalence");
		}
		if($this->uri->segment(3)=='university' && $this->uri->segment(4)=='edit_save'){//保存大学
			if(!$this->input->post('top')){$top =0;}else{$top =1;}
			$save = array(
				'university_name' => $this->input->post('name'),
				'university_city' => $this->input->post('city'),
				'university_country' => $this->input->post('country'),
				'university_letter' => $this->input->post('letter'),
				'university_remarks' => $this->input->post('remarks'),
				'university_top' => $top
			);
			$this->db->where(university_id,$this->input->post('id'));
			$this->db->update('equivalence_university',$save);
			$this->Mmanage->addlog('修改equivalence_university中university_id为'.$this->input->post('id').'的信息',now,$_SESSION['user'],'equivalence',$_SESSION['user'],'JI');

			header("Location:/manage/equivalence");
		}
		if($this->uri->segment(3)=='course' && $this->uri->segment(4)=='add'){//添加课程
			$data['universities'] = $this->Mmanage->get_universities();
			$this->load->view("manage/equivalence_course_add.php",$data);
		}
		if($this->uri->segment(3)=='course' && $this->uri->segment(4)=='open'){//开启课程转学分
			$this->db->query("update equivalence_course set course_status=1 where course_id=".$this->uri->segment(5)."");
			$course = $this->Mmanage->get_course();
			header("Location:/manage/equivalence/university/course/".$course['university_id']."");
		}
		if($this->uri->segment(3)=='course' && $this->uri->segment(4)=='close'){//关闭课程转学分
			$this->db->query("update equivalence_course set course_status=0 where course_id=".$this->uri->segment(5)."");
			$course = $this->Mmanage->get_course();
			header("Location:/manage/equivalence/university/course/".$course['university_id']."");
		}
		if($this->uri->segment(3)=='course' && $this->uri->segment(4)=='edit'){//添加课程
			$data['universities'] = $this->Mmanage->get_universities();
			$data['course'] = $this->Mmanage->get_course();
			$this->load->view("manage/equivalence_course_edit.php",$data);
		}
		if($this->uri->segment(3)=='course' && $this->uri->segment(4)=='save'){//保存课程
			if(!$this->input->post('top')){$top =0;}else{$top =1;}
			$save = array(
				'course_name' => $this->input->post('name'),
				'university_id' => $this->input->post('university'),
				'course_department' => $this->input->post('department'),
				'course_code' => $this->input->post('code'),
				'course_credits' => $this->input->post('credits'),
				'course_language' => $this->input->post('language'),
				'course_starttime' => $this->input->post('starttime'),
				'course_endtime' => $this->input->post('endtime'),
				'course_top' => $top,
				'ji_code' => $this->input->post('ji_code'),
				'ji_remarks' => $this->input->post('ji_remarks'),
				'course_remarks' => $this->input->post('remarks'),
				'ji_category' => $this->input->post('ji_category'),
				'ji_credits' => $this->input->post('ji_credits')				
			);
			$this->db->insert('equivalence_course',$save);
			$this->Mmanage->addlog('增加equivalence_course中course_id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'equivalence',$_SESSION['user'],'JI');

			header("Location:/manage/equivalence/university/course/".$this->input->post('university')."");
		}
		if($this->uri->segment(3)=='course' && $this->uri->segment(4)=='edit_save'){//保存课程
			if(!$this->input->post('top')){$top =0;}else{$top =1;}
			$save = array(
				'course_name' => $this->input->post('name'),
				'university_id' => $this->input->post('university'),
				'course_department' => $this->input->post('department'),
				'course_code' => $this->input->post('code'),
				'course_credits' => $this->input->post('credits'),
				'course_language' => $this->input->post('language'),
				'course_starttime' => $this->input->post('starttime'),
				'course_endtime' => $this->input->post('endtime'),
				'course_top' => $top,
				'ji_code' => $this->input->post('ji_code'),
				'ji_remarks' => $this->input->post('ji_remarks'),
				'course_remarks' => $this->input->post('remarks'),
				'ji_category' => $this->input->post('ji_category'),
				'ji_credits' => $this->input->post('ji_credits')				
			);
			$this->db->where(course_id,$this->input->post('course_id'));
			$this->db->update(equivalence_course,$save);
			$this->Mmanage->addlog('修改equivalence_course中course_id为'.$this->input->post('course_id').'的信息',now,$_SESSION['user'],'equivalence',$_SESSION['user'],'JI');
			header("Location:/manage/equivalence/university/course/".$this->input->post('university')."");
		}
	}
	
	function contactlist(){//通讯录
		$my['module'] = 'contactlist';
		$data['contactlist'] = $this->Mmanage->get_all_contactlist();
		$this->load->view('manage/header',$my);
		$this->load->view('manage/contact_list',$data);
	}
	function contactlist_add(){//添加通讯录
		$my['module'] = 'contactlist';
		$this->load->view('manage/header',$my);
		$this->load->view('manage/contact_list_add');
	}
	function contactlist_save(){//保存通讯录
			$save = array(
				'user_department' => $this->input->post('user_department'),
				'user_room' => $this->input->post('user_room'),
				'user_office' => $this->input->post('nuser_officeame'),
				'user_enname' => $this->input->post('user_enname'),
				'user_name' => $this->input->post('user_name'),
				'user_position' => $this->input->post('user_position'),
				'user_enposition' => $this->input->post('user_enposition'),
				'user_tel' => $this->input->post('user_tel'),
				'user_subtel' => $this->input->post('user_subtel'),
				'user_mobile' => $this->input->post('user_mobile'),
				'user_short' => $this->input->post('user_short'),
				'user_email' => $this->input->post('user_email'),
				'user_skype' => $this->input->post('user_skype'),
				'user_qq' => $this->input->post('user_qq'),
				'user_country' => $this->input->post('user_country'),
				'user_id' => $this->input->post('user_id'),
				'user_type' => $this->input->post('user_type')			
			);
			if(!$this->input->post('detail_id')){
				$this->db->insert('ji_user_detail',$save);//如果没有接受到id的值，则增加新的条目
				$this->Mmanage->addlog('增加ji_user_detail中detail_id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'contactlist',$_SESSION['user'],'JI');

			}else{
				$this->db->where('id',$this->input->post('id'));
				$this->db->update('ji_user_detail',$save);
				$this->Mmanage->addlog('修改ji_user_detail中detail_id为'.$this->input->post('id').'的信息',now,$_SESSION['user'],'contactlist',$_SESSION['user'],'JI');
			}
			header('Location:/manage/contactlist');
	}
	
	function gpa(){//GPA
		$my['module'] = 'gpa';
		$this->load->view('manage/header',$my);
		if($this->input->post('student_grade')){//获取到年级
			$f10 = "'F1037101','F1037102','F1037103','F1037104','F1037105','F1037201','F1037202','F1037203','F1037204','F1037205'";
			$f11 = "'F1137101','F1137102','F1137103','F1137104','F1137105','F1137201','F1137202','F1137203','F1137204','F1137205'";
			$f12 = "'F1237101','F1237102','F1237103','F1237104','F1237105','F1237201','F1237202','F1237203','F1237204','F1237205'";
			$f13 = "'F1337101','F1337102','F1337103','F1337104','F1337105','F1337201','F1337202','F1337203','F1337204','F1337205'";
			$f14 = "'F1437101','F1437102','F1437103','F1437104','F1437105','F1437201','F1437202','F1437203','F1437204','F1437205'";
			$f15 = "'F1537101','F1537102','F1537103','F1537104','F1537105','F1537201','F1537202','F1537203','F1537204','F1537205'";
			$student_fuxue = $this->input->post('student_fuxue');//获取专业
			if($this->input->post('student_fuxue')=='1' && $this->input->post('student_zhengchang')=='1'){
				$tiaojian = " and (student_xueji='复学在校' or student_xueji='正常在校')";	
			}
			$student_zhengchang = $this->input->post('student_zhengchang');//获取专业
			$student_major = $this->input->post('student_major');//获取专业
			$student_grade = $this->input->post('student_grade');//获取年级
			$data['gpa_xq'] = $this->input->post('gpa_xq');//获取学期
			$data['gpa_xn'] = $this->input->post('gpa_xn');//获取学年
			$data['students'] = $this->db->query("select * from gpa_student where student_class in(".$$student_grade.") and student_major='".$student_major."'".$tiaojian." order by student_id asc")->result();
			$data['student_grade'] = $student_grade;
			$data['student_major'] = $student_major;
			$this->load->view('manage/gpa',$data);
		}else{
			$this->load->view('manage/gpa');
		}
		
		
	}
	function gpa_createone(){//GPA
		$my['module'] = 'gpa';
		$this->load->view('manage/header',$my);
		$studentid = $this->input->post('student_id');
		if($studentid){
			$tiaojian = '';
			$xn = $this->input->post('result_xn');
			$xq = $this->input->post('result_xq');
			if($xn!='0' && $xq!='0'){
						$tiaojian = " and result_xn='".$xn."' and result_xq='".$xq."'";//条件
			}
			$results1 = $this->db->query("select * from (select * from `gpa_result` where student_id='".$studentid."' and result_ksdj<>'03'".$tiaojian." and result_kcdm not in('VE490','VM490','TH009','VV155','VY109','CS000') order by result_xn desc,result_xq desc) `temptable` group by result_kcdm")->result();////获取该学生的所有成绩，剔除两级制，重复出现取最新（排除了一些例外）
			$results2 = $this->db->query("select * from `gpa_result` where student_id='".$studentid."' and result_ksdj<>'03'".$tiaojian." and result_kcdm in('VE490','VM490','TH009','VV155','VY109','CS000')")->result();////获取该学生的所有成绩，剔除两级制，重复出现全计算(只包含例外)
			foreach($results1 as $r1){
				$eachresult1= $r1->result_njd * $r1->result_xf;//单个成绩njd*xf
				$count1 += $eachresult1;
			}
			foreach($results2 as $r2){
				$eachresult2= $r2->result_njd * $r2->result_xf;//单个成绩njd*xf
				$count2 += $eachresult2;
			}
			$count = $count1 + $count2;//成绩*point，累加总和
			foreach($results1 as $r1){
				$total1 += $r1->result_xf;
			}
			foreach($results2 as $r2){
				$total2 += $r2->result_xf;
			}
			$total = $total1 + $total2;
			$data['sql1'] = "select * from (select * from `gpa_result` where student_id='".$studentid."' and result_ksdj<>'03'".$tiaojian." and result_kcdm not in('VE490','VM490','TH009','VV155','VY109','CS000') order by result_xn desc,result_xq desc) `temptable` group by result_kcdm;";
			$data['sql2'] = "select * from `gpa_result` where student_id='".$studentid."' and result_ksdj<>'03'".$tiaojian." and result_kcdm in('VE490','VM490','TH009','VV155','VY109','CS000')";
			$data['studentid'] = $studentid;
			$data['xq'] = $xq;
			$data['xn'] = $xn;
			$data['results1'] = $results1;
			$data['results2'] = $results2;
			$data['count'] = $count;
			$data['total'] = $total;
			$data['gpa'] = $count/$total;
			$gpa = $count/$total;
			$checkgpa = $this->db->query("select * from gpa_gpa where student_id='".$studentid."' and gpa_xn='".$xn."' and gpa_xq='".$xq."' limit 1")->row_array();//检查是否已经有了GPA
			if($checkgpa){//如果已经有了，则更新
				if($data['gpa']){
					$this->db->query("update gpa_gpa set student_id='".$studentid."',gpa=".$gpa.",gpa_xn='".$xn."',gpa_xq=".$xq.",gpa_createtime='".date('y-m-d h:i:s',time())."' where gpa_id=".$checkgpa['gpa_id']."");
				}
			}else{//如果没有记录，则重新生成
				if($data['gpa']){
					$this->db->query("insert into gpa_gpa set student_id='".$studentid."',gpa=".$data['gpa'].",gpa_xn='".$xn."',gpa_xq=".$xq.",gpa_createtime='".date('y-m-d h:i:s',time())."'");
				}
			}
			
			
		}
		$this->load->view('manage/gpa_createone',$data);
	}
	function gpa_createall(){//GPA
		$my['module'] = 'gpaforadmin';
		$this->load->view('manage/header',$my);
		if($this->input->post('student_grade')){//
			$f10 = "'F1037101','F1037102','F1037103','F1037104','F1037105','F1037201','F1037202','F1037203','F1037204','F1037205'";
			$f11 = "'F1137101','F1137102','F1137103','F1137104','F1137105','F1137201','F1137202','F1137203','F1137204','F1137205'";
			$f12 = "'F1237101','F1237102','F1237103','F1237104','F1237105','F1237201','F1237202','F1237203','F1237204','F1237205'";
			$f13 = "'F1337101','F1337102','F1337103','F1337104','F1337105','F1337201','F1337202','F1337203','F1337204','F1337205'";
			$f14 = "'F1437101','F1437102','F1437103','F1437104','F1437105','F1437201','F1437202','F1437203','F1437204','F1437205'";
			$f15 = "'F1537101','F1537102','F1537103','F1537104','F1537105','F1537201','F1537202','F1537203','F1537204','F1537205'";
			$xn = $this->input->post('gpa_xn');//获取学年
			$xq = $this->input->post('gpa_xq');//获取学期
			$student_grade = $this->input->post('student_grade');
			$start = $this->input->post('gpa_num');//获取开始基数
			$end = $start + 500;
			$students = $this->db->query("select * from gpa_student where student_class in(".$$student_grade.") order by id asc limit ".$start.",500")->result();
			//
			foreach($students as $s){
				$gpa = $count = $count1 = $count2 = $total1 = $total2 = $total = NULL;
				$studentid = $s->student_id;
				$tiaojian = '';
				if($xn!=0 && $xq!=0){
							$tiaojian = " and result_xn='".$xn."' and result_xq='".$xq."'";//条件
				}
				$results1 = $this->db->query("select * from (select * from `gpa_result` where student_id='".$studentid."' and result_ksdj<>'03'".$tiaojian." and result_kcdm not in('VE490','VM490','TH009','VV155','VY109','CS000') order by result_xn desc,result_xq desc) `temptable` group by result_kcdm")->result();////获取该学生的所有成绩，剔除两级制，重复出现取最新（排除了一些例外）
				$results2 = $this->db->query("select * from `gpa_result` where student_id='".$studentid."' and result_ksdj<>'03'".$tiaojian." and result_kcdm in('VE490','VM490','TH009','VV155','VY109','CS000')")->result();////获取该学生的所有成绩，剔除两级制，重复出现全计算(只包含例外)
				foreach($results1 as $r1){
					$eachresult1= $r1->result_njd * $r1->result_xf;//单个成绩njd*xf
					$count1 += $eachresult1;
				}
				foreach($results2 as $r2){
					$eachresult2= $r2->result_njd * $r2->result_xf;//单个成绩njd*xf
					$count2 += $eachresult2;
				}
				
				$count = $count1 + $count2;//成绩*point，累加总和
				foreach($results1 as $r1){
					$total1 += $r1->result_xf;
				}
				foreach($results2 as $r2){
					$total2 += $r2->result_xf;
				}
				$total = $total1 + $total2;
				
				$gpa = $count/$total;//计算GPA
				$checkgpa = $this->db->query("select * from gpa_gpa where student_id='".$studentid."' and gpa_xn='".$xn."' and gpa_xq='".$xq."' limit 1")->row_array();//检查是否已经有了GPA
				if($checkgpa){//如果已经有了，则更新
					if($gpa){
						$this->db->query("update gpa_gpa set student_id='".$studentid."',gpa=".$gpa.",gpa_xn='".$xn."',gpa_xq=".$xq.",gpa_createtime='".date('y-m-d h:i:s',time())."' where gpa_id=".$checkgpa['gpa_id']."");
						$updatelog .= 'update '.$studentid.' / '.$gpa.'<br />';
					}
				}else{//如果没有记录，则重新生成
					if($gpa){
						$this->db->query("insert into gpa_gpa set student_id='".$studentid."',gpa=".$gpa.",gpa_xn='".$xn."',gpa_xq='".$xq."',gpa_createtime='".date('y-m-d h:i:s',time())."'");
						$addnewlog .= 'addnew '.$studentid.' / '.$gpa.'<br />';
					}
				}
			}
			//
			$data['xq'] = $xq;
			$data['xn'] = $xn;
			$data['start'] = $start;
			$data['updatelog'] = $updatelog;
			$data['addnewlog'] = $addnewlog;
			$data['student_grade'] = $student_grade;
			$data['notice'] = '已经生成 '.$student_grade.' 的第 '.$xn.' 学年的第  '.$xq.' 学期GPA第'.$start.' - '.$end.' 个<br />';
			$this->load->view('manage/gpa_createall',$data);
		}else{
			$this->load->view('manage/gpa_createall');
		}
	}
	function lab(){//实验室
		$my['module'] = 'lab';
		//$data['equipments'] = $this->Mmanage->get_all_equipments();
		$p = $this->uri->segment(3);
		if($p){
			$data['equipments'] = $this->Mmanage->get_equipments(($p-1)*12,12);
		}else{
			$data['equipments'] = $this->Mmanage->get_equipments(0,12);
		}
		$this->load->library('pagination');    //加载分页类
		$config['use_page_numbers'] = TRUE;
		$config['total_rows'] = $this->Mmanage->get_equipment_count();   //获取总条数
		$config['per_page'] = 12;    //每页显示的数量
		$config['first_url'] = '/manage/lab';   //第一页的URL
		$config['base_url'] = '/manage/lab/';    //基本URL路径
		$config['num_links'] = 3; // 当前连接前后显示页码个数
//      $config['full_tag_open'] = '<div class="pagination">'; // 分页开始样式
//      $config['full_tag_close'] = '</div>'; // 分页结束样式
        $config['first_link'] = '首页'; // 第一页显示
        $config['last_link'] = '末页'; // 最后一页显示
        $config['next_link'] = '下一页 >'; // 下一页显示
        $config['prev_link'] = '< 上一页'; // 上一页显示
        $config['cur_tag_open'] = ' <a class="current">'; // 当前页开始样式
        $config['cur_tag_close'] = '</a>'; // 当前页结束样式
		$this->pagination->initialize($config); // 配置分页
		$data['pager'] = $this->pagination->create_links();//创建分页
		$this->load->view('manage/header',$my);
		$this->load->view('manage/lab',$data);
	}
	function lab_search(){//实验室设备搜索
		$my['module'] = 'lab';
		$data['search'] = $this->input->post('s');
		$data['equipments'] = $this->Mmanage->get_lab_equipment_search();
		$this->load->view('manage/header',$my);
		$this->load->view('manage/lab_search',$data);
	}
	function lab_equipment_recycle(){//实验室设备回收站列表
		$my['module'] = 'lab';
		$data['equipments'] = $this->Mmanage->get_recycle_equipments();
		$this->load->view('manage/header',$my);
		$this->load->view('manage/lab_equipment_recycle',$data);
	}
	function lab_equipment_add(){//添加设备
		$my['module'] = 'lab';
		$data['lanmu'] = $this->Mmanage->get_lab_lanmu();
		$data['places'] = $this->Mmanage->get_lab_place();
		$this->load->view('manage/header',$my);
		$this->load->view('manage/lab_equipment_add',$data);
	}
	function lab_equipment_edit(){//编辑设备,/manage/lab_equipment_edit/22
		$my['module'] = 'lab';
		$data['lanmu'] = $this->Mmanage->get_lab_lanmu();
		$data['equipment'] = $this->Mmanage->get_lab_equipment();
		$data['places'] = $this->Mmanage->get_lab_place();
		$this->load->view('manage/header',$my);
		$this->load->view('manage/lab_equipment_edit',$data);
	}
	function lab_equipment_del(){//删除设备,/manage/lab_equipment_del/22
		$my['module'] = 'lab';
		$this->load->view('manage/header',$my);
		$this->db->query("update lab_equipment set equipment_status=0 where equipment_id=".$this->uri->segment(3)."");
		$this->Mmanage->addlog('删除lab_equipment中equipment_id为'.$this->uri->segment(3).'的信息',now,$_SESSION['user'],'lab',$_SESSION['user'],'JI');
		header("Location:/manage/lab");
	}
	function lab_equipment_back(){//恢复设备,/manage/lab_equipment_back/22
		$my['module'] = 'lab';
		$this->load->view('manage/header',$my);
		$this->db->query("update lab_equipment set equipment_status=1 where equipment_id=".$this->uri->segment(3)."");
		$this->Mmanage->addlog('恢复lab_equipment中equipment_id为'.$this->uri->segment(3).'的信息',now,$_SESSION['user'],'lab',$_SESSION['user'],'JI');
		header("Location:/manage/lab");
	}
	function lab_equipment_save(){//保存设备
		$uploadimg['upload_path'] = './ji_upload/lab/';
		$uploadimg['allowed_types'] = 'png|gif|jpg';
		$uploadimg['file_name'] = 'equipment'.'-'.date('YmdHis');
		$this->load->library('upload',$uploadimg);
		if(!$this->upload->do_upload('equipment_pic')){
			$data = array(
				'equipment_name' => $this->input->post('equipment_name'),
				'equipment_lm' => $this->input->post('equipment_lm'),
				'equipment_total' => $this->input->post('equipment_total'),
				'equipment_size' => $this->input->post('equipment_size'),
				'equipment_supply' => $this->input->post('equipment_supply'),
				'equipment_company' => $this->input->post('equipment_company'),
				'equipment_keeper' => $this->input->post('equipment_keeper'),
				'equipment_number' => $this->input->post('equipment_number'),
				'equipment_place' => $this->input->post('equipment_place'),
				'equipment_function' => $this->input->post('equipment_function'),
				'equipment_course' => $this->input->post('equipment_course'),
				'equipment_borrow' => $this->input->post('equipment_borrow')
			);
		}else{
			$data['upload_data']=$this->upload->data();
			$img = $data['upload_data']['file_name'];
			$data = array(
				'equipment_name' => $this->input->post('equipment_name'),
				'equipment_lm' => $this->input->post('equipment_lm'),
				'equipment_pic' => $img,
				'equipment_total' => $this->input->post('equipment_total'),
				'equipment_size' => $this->input->post('equipment_size'),
				'equipment_supply' => $this->input->post('equipment_supply'),
				'equipment_company' => $this->input->post('equipment_company'),
				'equipment_keeper' => $this->input->post('equipment_keeper'),
				'equipment_number' => $this->input->post('equipment_number'),
				'equipment_place' => $this->input->post('equipment_place'),
				'equipment_function' => $this->input->post('equipment_function'),
				'equipment_course' => $this->input->post('equipment_course'),
				'equipment_borrow' => $this->input->post('equipment_borrow')
			);
			//↓↓↓↓设置缩略图↓↓↓↓↓↓↓
			$im = imagecreatefromjpeg("./ji_upload/lab/".$img);
			$name = $img;
			$maxwidth="600";//设置图片的最大宽度
			$maxheight="400";//设置图片的最大高度
			$filetype=".jpg";//图片类型
			$pic_width = imagesx($im);
			$pic_height = imagesy($im);
			if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)){
				if($maxwidth && $pic_width>$maxwidth){
					$widthratio = $maxwidth/$pic_width;
					$resizewidth_tag = true;
				}
				if($maxheight && $pic_height>$maxheight){
					$heightratio = $maxheight/$pic_height;
					$resizeheight_tag = true;
				}
				if($resizewidth_tag && $resizeheight_tag){
					if($widthratio<$heightratio)
						$ratio = $widthratio;
					else
						$ratio = $heightratio;
					}
					if($resizewidth_tag && !$resizeheight_tag)$ratio = $widthratio;
					if($resizeheight_tag && !$resizewidth_tag)$ratio = $heightratio;$newwidth = $pic_width * $ratio;$newheight = $pic_height * $ratio;
					if(function_exists("imagecopyresampled")){
						$newim = imagecreatetruecolor($newwidth,$newheight);//PHP系统函数
						imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
				}else{
					$newim = imagecreate($newwidth,$newheight);
					imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
				}
				$name = './ji_upload/lab/small/'.$name;
				imagejpeg($newim,$name);
				imagedestroy($newim);
			}else{
				$name = './ji_upload/lab/small/'.$name;
				imagejpeg($im,$name);
			}
			//↑↑↑↑设置缩略图↑↑↑↑↑↑
		}
		if($this->input->post('equipment_id')){
			$this->db->where('equipment_id',$this->input->post('equipment_id'));
			$this->db->update('lab_equipment',$data);
			$this->Mmanage->addlog('修改设备ID为'.$this->input->post('equipment_id').'信息',now,$_SESSION['user'],'lab',$_SESSION['user'],'JI');	
		}else{
			$this->db->insert('lab_equipment',$data);
			$this->Mmanage->addlog('增加lab_equipment中equipment_id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'lab',$_SESSION['user'],'JI');
		}
		
		header('Location:/manage/lab');
	}
	function lab_equipment_borrow_list(){//实验室设备借出列表
		$my['module'] = 'lab';
		$data['equipments'] = $this->Mmanage->get_borrow_equipments();
		$this->load->view('manage/header',$my);
		$this->load->view('manage/lab_equipment_borrow_list',$data);
	}
	function lab_equipment_borrow_add(){//实验室设备借出添加
		$my['module'] = 'lab';
		$data['equipment'] = $this->Mmanage->get_lab_equipment();
		$this->load->view('manage/header',$my);
		$this->load->view('manage/lab_equipment_borrow_add',$data);
	}
	function lab_equipment_borrow_edit(){//实验室设备借出编辑
		$my['module'] = 'lab';
		$data['equipment'] = $this->Mmanage->get_borrow_equipment();
		$this->load->view('manage/header',$my);
		$this->load->view('manage/lab_equipment_borrow_edit',$data);
	}
	function lab_equipment_borrow_save(){//保存借用设备信息
		$data = array(
			'equipment_name' => $this->input->post('equipment_name'),
			'equipment_id' => $this->input->post('equipment_id'),
			'student_id' => $this->input->post('student_id'),
			'student_name' => $this->input->post('student_name'),
			'student_mobile' => $this->input->post('student_mobile'),
			'student_application' => $this->input->post('student_application'),
			'borrow_fromwho' => $this->input->post('borrow_fromwho'),
			'borrow_applytime' => date('Y-m-d h:i:s',time()),
			'borrow_approve' => date('Y-m-d h:i:s',time()),
			'borrow_end' => $this->input->post('borrow_end')
		);
		if($this->input->post('borrow_id')){
			$this->db->where('borrow_id',$this->input->post('borrow_id'));
			$this->db->update('lab_equipment_borrow',$data);
			$this->Mmanage->addlog('修改lab_equipment_borrow中borrow_id为'.$this->input->post('borrow_id').'的信息',now,$_SESSION['user'],'lab',$_SESSION['user'],'JI');
		}else{
			$this->db->insert('lab_equipment_borrow',$data);
			$this->Mmanage->addlog('增加lab_equipment_borrow中borrow_id为'.mysql_insert_id().'的信息',now,$_SESSION['user'],'lab',$_SESSION['user'],'JI');
		}
		header('Location:/manage/lab_equipment_borrow_list');
	}
	function becomeuser(){//管理员变身
		if($_SESSION['user']==master){//确定管理员身份
			if($this->input->post('user_id')){//获取普通用户ID
				$_SESSION['user'] = $this->input->post('user_id');
				$this->Mmanage->addlog('管理员变身为'.$_SESSION['user'],now,master,'manage',master,'JI');
				header('Location:/manage/home');
				return;
			}
			$my['module'] = 'becomeuser';
			$data['users'] = $this->Mmanage->get_users();
			$this->load->view('manage/header',$my);
			$this->load->view('manage/becomeuser',$data);
		}
		
	}
}
?>
























