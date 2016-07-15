<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mta_mail extends CI_Model {
	
	private $site_config;
	
	function __construct()
    {
        parent::__construct();
		$this->load->library('smtp');
		$this->load->library('phpmailer');
		$this->load->model('mta_site');
        $this->site_config = $this->mta_site->get_site_config();
	}
	
	
	/**
     * 向TA或老师发送Email
	 * @param   $data 关联数组
     * @return  boolean
     */
	
	
	public function send($to, $title, $body) //eg, send('840737618@qq.com', 'hi', 'hi')
	{
		//******************** 配置信息 ********************************
		$smtpserver = $this->site_config['ta_mail_host'];//SMTP服务器
		$smtpserverport = $this->site_config['ta_mail_port'];//SMTP服务器端口
		$smtpusermail = $this->site_config['ta_mail_from'];//SMTP服务器的用户邮箱
		$smtpemailto = $to;//发送给谁
		$smtpuser = $this->site_config['ta_mail_user'];//SMTP服务器的用户帐号
		$smtppass = $this->site_config['ta_mail_pass'];//SMTP服务器的用户密码
		$mailtitle = $title;//邮件主题
		$mailcontent = $body;//邮件内容
		$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
		//************************ 配置信息 ****************************
		$smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$smtp->debug = false;//是否显示发送的调试信息
		return $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
	}
	
	public function send2($to, $title, $body)
	{
		
		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = $this->site_config['ta_mail_host'];     // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = $this->site_config['ta_mail_user']; // SMTP username
		$mail->Password = $this->site_config['ta_mail_pass']; // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 25;                                     // TCP port to connect to
		
		$mail->setFrom($this->site_config['ta_mail_from'], 'Mailer');
		$mail->addAddress($to, 'User');                       // Add a recipient
		
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = $title;
		$mail->Body    = $body;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
		if(!$mail->send()) 
		{
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
			return false;
		} 
		else 
		{
			echo 'Message has been sent';
			return true;
		}
	}
}