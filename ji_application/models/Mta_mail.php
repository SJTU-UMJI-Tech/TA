<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Mta_mail
 *
 * @category   ta
 * @package    ta
 * @author     tc-imba
 * @copyright  2016 umji-sjtu
 * @uses       SMTP
 * @uses       PHPMailer
 */
class Mta_mail extends CI_Model
{
	/** @var array  */
	private $site_config;
	
	/**
	 * Mta_mail constructor.
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->library('SMTP');
		$this->load->library('PHPMailer');
		$this->site_config = $this->Mta_site->get_site_config();
	}
	
	public function send($to, $title, $body)
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
		$mail->Body = $body;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
		if (!$mail->send())
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