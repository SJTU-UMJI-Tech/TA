<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Export
 *
 * Controller ta/evaluation/manage/export
 *
 * @category   ta
 * @package    ta/evaluation/manage
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       PHPExcel
 */
class Export extends TA_Controller
{
	/**
	 * Export constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->data['type'] = 'manage';
		$this->data['page_name'] = 'TA Evaluation System: Export to Excel';
		$this->data['banner_id'] = 5;
		$this->Mta_site->redirect_login($this->data['type']);
	}
	
	/**
	 * Index page
	 */
	public function index()
	{
		$data = $this->data;
		$this->load->view('ta/evaluation/report/export', $data);
	}
	
	public function mail()
	{
		$this->load->model('Mta_mail');
		$this->Mta_mail->send('liuyh615@126.com', '111', '222');
	}
	
	public function mail2($id)
	{
		$this->load->model('Mcourse');
		$course =$this->Mcourse->get_course_by_id($id);
		$course->set_teacher();
		echo $course->teacher->user_email;
	}
	
	public function test()
	{
		$this->load->library('PHPExcel');
		
		define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		echo date('H:i:s'), " Create new PHPExcel object", EOL;
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		echo date('H:i:s'), " Set document properties", EOL;
		$objPHPExcel->getProperties()
		            ->setCreator("TA Evaluation System")
		            ->setLastModifiedBy("TA Evaluation System")
		            ->setTitle("TA Evaluation")
		            ->setSubject("TA Evaluation")
		            ->setDescription("TA Evaluation")
		            ->setKeywords("TA Evaluation System")
		            ->setCategory("TA Evaluation System");
		
		$objPHPExcel->setActiveSheetIndex(0);
		
		
		$this->load->model('Mta');
		$ta_list = $this->Mta->get_all_ta();
		$index = 2;
		
		$objPHPExcel->getActiveSheet()
		            ->setCellValue('A1', '学号')
		            ->setCellValue('B1', '班号')
		            ->setCellValue('C1', '姓名')
		            ->setCellValue('D1', '手机')
		            ->setCellValue('E1', '邮箱');
		
		foreach ($ta_list as $ta)
		{
			/** @var $ta Ta_obj */
			$ta->set_student();
			$ta->student->set_detail();
			$objPHPExcel->getActiveSheet()
			            ->setCellValue('A' . $index, $ta->USER_ID)
			            ->setCellValue('B' . $index, $ta->student->detail->student_bh)
			            ->setCellValue('C' . $index, $ta->name_ch)
			            ->setCellValue('D' . $index, $ta->phone)
			            ->setCellValue('E' . $index, $ta->email);
			
			$index++;
		}
		
		for ($char = 'A'; $char <= 'E'; $char++)
		{
			$objPHPExcel->getActiveSheet()
			            ->getColumnDimension($char)
			            ->setAutoSize(true);
		}
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(false)->setWidth('10');
		
		// Save Excel 2007 file
		echo date('H:i:s'), " Write to Excel2007 format", EOL;
		$callStartTime = microtime(true);
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save(getcwd() . '/ji_file/ta/evaluation/1.xlsx');
		$callEndTime = microtime(true);
		$callTime = $callEndTime - $callStartTime;
		
		echo date('H:i:s'), " File written to ", str_replace('.php', '.xlsx', pathinfo(__FILE__,
		                                                                               PATHINFO_BASENAME)), EOL;
		echo 'Call time to write Workbook was ', sprintf('%.4f', $callTime), " seconds", EOL;
		// Echo memory usage
		echo date('H:i:s'), ' Current memory usage: ', (memory_get_usage(true) / 1024 /
		                                                1024), " MB", EOL;
		
		// Echo done
		echo date('H:i:s'), " Done writing files", EOL;
		echo 'Files have been created in ', getcwd() . '/ji_file/ta/evaluation/', EOL;
	}
}
