<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Feedback
 *
 * Controller ta/evaluation/student/feedback
 *
 * @category   ta
 * @package    ta/evaluation/student
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       Mta_feedback
 * @uses       Feedback_obj
 */
class Feedback extends TA_Controller
{
	/**
	 * Feedback constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'student';
		$this->data['page_name'] = 'TA Evaluation System: Feedbacks';
		$this->data['banner_id'] = 3;
		$this->Mta_site->redirect_login($this->data['type']);
		$this->load->model('Mta_feedback');
		$this->load->library('Feedback_obj');
	}
	
	/**
	 * The index page will be redirected to the view list
	 * @param int $id
	 */
	public function index($id = 1)
	{
		redirect(base_url('ta/evaluation/student/feedback/view/' . $id));
	}
	
	/**
	 * Student check the view list
	 *
	 * @uses CI_Pagination
	 */
	public function view()
	{
		/** initialize */
		$data = $this->data;
		$data['list'] =
			$this->Mta_feedback->show_list($_SESSION['userid'], Feedback_obj::STATE_STUDENT);
		
		/** pagination */
		$this->load->library('pagination');
		$config['use_page_numbers'] = true;
		$config['prefix'] = 'ta/evaluation/student/feedback/view/';
		$config['first_url'] = '1';
		$config['total_rows'] = count($data['list']);
		$config['per_page'] = 20;
		$this->pagination->initialize($config);
		
		$current_page = floor(min(max($this->uri->segment(6), 1),
		                          ($config['total_rows'] - 1) / $config['per_page'] + 1));
		if ($this->uri->segment(6) != $current_page)
		{
			$this->index($current_page);
		}
		$data['list'] = array_slice($data['list'], ($current_page - 1) * $config['per_page'],
		                            $config['per_page']);
		$data['page_id'] = $current_page;
		
		/** finalize */
		foreach ($data['list'] as $feedback)
		{
			/** @var $feedback Feedback_obj */
			$feedback->set_ta()->set_course();
		}
		
		$this->load->view('ta/evaluation/feedback/list', $data);
		
	}
	
	/**
	 * Student check one feedback
	 *
	 * @param int $id feedback_id
	 */
	public function check($id)
	{
		/** initialize */
		$data = $this->data;
		$data['page_id'] = $this->input->get('page');
		
		$data['feedback'] = $this->Mta_feedback->get_feedback_by_id($id);
		if ($data['feedback']->is_error())
		{
			$this->index();
		}
		if ($data['feedback']->user_id != $_SESSION['userid'])
		{
			$this->index();
		}
		
		/** finalize */
		$data['state'] = $data['feedback']->get_state_str();
		$data['feedback']->set_ta()->set_course()->set_replys(Feedback_obj::STATE_STUDENT);
		
		$this->load->view('ta/evaluation/feedback/check', $data);
	}
	
	/**
	 * Student create feedback
	 *
	 * @uses Mstudent
	 * @uses Mcourse
	 * @uses Course_obj
	 */
	public function add()
	{
		$data = $this->data;
		
		$this->load->model('Mstudent');
		$this->load->library('Course_obj');
		$this->load->model('Mcourse');
		
		$data['course_list'] = $this->Mstudent->get_now_course($_SESSION['userid']);
		foreach ($data['course_list'] as $course)
		{
			/** @var $course Course_obj */
			$course->set_ta();
		}
		
		$this->load->view('ta/evaluation/feedback/add', $data);
	}
	
	/**
	 * submit a feedback through ajax
	 *
	 * @uses Mstudent
	 * @uses Mcourse
	 * @uses Course_obj
	 * @echo int feedback_id
	 */
	public function submit()
	{
		$this->load->model('Mstudent');
		$this->load->library('Course_obj');
		$this->load->model('Mcourse');
		
		$data['course_list'] = $this->Mstudent->get_now_course($_SESSION['userid']);
		foreach ($data['course_list'] as $course)
		{
			/** @var $course Course_obj */
			$course->set_ta();
		}
		
		$form_data = array(
			'BSID'      => $this->input->post('BSID'),
			'ta_id'     => $this->input->post('ta_id'),
			'title'     => $this->input->post('title'),
			'content'   => $this->input->post('content'),
			'anonymous' => $this->input->post('anonymous')
		);
		
		foreach ($data['course_list'] as $course)
		{
			if ($course->BSID != $form_data['BSID'])
			{
				echo 'course error (You must choose a course)';
				exit();
			}
			foreach ($course->ta_list as $ta)
			{
				if ($ta->USER_ID == $form_data['ta_id'])
				{
					if (!$this->Mta_feedback->examine_content($form_data['content']))
					{
						echo 'The content must be ' . $this->Mta_site->site_config['ta_feedback_content_min'] .
						     '-' . $this->Mta_site->site_config['ta_feedback_content_max'] . ' letters';
					}
					else if (strlen($form_data['title']) < 5 || strlen($form_data['title']) > 20)
					{
						echo 'The title must be 5-20 letters';
					}
					else
					{
						if ($form_data['anonymous'] == 'false')
						{
							$form_data['anonymous'] = 0;
						}
						else
						{
							$form_data['anonymous'] = 1;
						}
						$form_data['user_id'] = $_SESSION['userid'];
						echo $this->Mta_feedback->create($form_data);
					}
					exit();
				}
			}
			break;
		}
		echo 'TA error (You must choose a TA)';
		exit();
	}
	
	/**
	 * reply a feddback through ajax
	 *
	 * @echo string result
	 */
	public function reply()
	{
		$id = $this->input->post('id');
		$user_id = $_SESSION['userid'];
		$content = $this->input->post('content');
		$picture = $this->input->post('picture');
		$feedback = $this->Mta_feedback->get_feedback_by_id($id);
		if ($feedback->is_error())
		{
			echo 'error feedback id';
		}
		else if ($feedback->user_id != $user_id)
		{
			echo 'error user id';
		}
		else if (!$feedback->is_student())
		{
			echo "can't reply when applying to teacher";
		}
		else if (!$this->Mta_feedback->examine_content($content))
		{
			echo 'The content must be ' . $this->Mta_site->site_config['ta_feedback_content_min'] .
			     '-' . $this->Mta_site->site_config['ta_feedback_content_max'] . ' letters';
		}
		else
		{
			if ($picture != 'undefined')
			{
				$picture = str_replace('data:image/png;base64,', '', $picture);
				$picture = base64_decode($picture);
				$picture_name = md5(time());
				$picture_path = './ji_upload/ta/feedback/' . $id . '/';
				if (strlen($picture) >= 1000000)
				{
					echo "the picture is too large";
					exit();
				}
				if (!file_exists($picture_path))
				{
					mkdir($picture_path);
				}
				$picture_size = file_put_contents($picture_path . $picture_name . '.png', $picture);
				if ($picture_size <= 0)
				{
					echo "picture update failed";
					exit();
				}
			}
			else
			{
				$picture_name = '';
			}
			$this->Mta_feedback->reply($id, Feedback_obj::STATE_STUDENT, $user_id, $content, false,
			                           $picture_name);
			//echo $picture_name;
			echo 'success';
		}
		exit();
	}
	
	/**
	 * close a feedback through ajax
	 *
	 * @echo string result
	 */
	public function close()
	{
		$id = $this->input->get('id');
		$feedback = $this->Mta_feedback->get_feedback_by_id($id);
		if ($feedback->is_error())
		{
			echo 'error feedback id';
		}
		else if ($feedback->user_id != $_SESSION['userid'])
		{
			echo 'error user id';
		}
		else if (!$feedback->is_student())
		{
			echo "can't close when applying to teacher";
		}
		else
		{
			$this->Mta_feedback->close($id);
			echo 'success';
		}
		exit();
	}
	
	public function test()
	{
		$this->load->model('Mta_search');
		print_r($this->Mta_search->search_ta(515370910207));
	}
	
}
