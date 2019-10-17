<?php
use PHPMailer\PHPMailer\PHPMailer;

class zMail{
	private $mail;
	
	public function __construct(){
		//Create a new PHPMailer instance
		$this->mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$this->mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$this->mail->SMTPDebug = 2;
		$this->mail->Timeout = 20;
		$this->mail->SMTPSecure = 'ssl';
		//Set the hostname of the mail server
		$this->mail->Host = SMTP_HOST;
		//Set the SMTP port number - likely to be 25, 465 or 587
		$this->mail->Port = SMTP_PORT;
		//Whether to use SMTP authentication
		$this->mail->SMTPAuth = true;
		//Username to use for SMTP authentication
		$this->mail->Username = SMTP_USERNAME;
		//Password to use for SMTP authentication
		$this->mail->Password = SMTP_PASSWORD;
		//Set who the message is to be sent from
		$this->mail->setFrom(SMTP_USERNAME, SMTP_USERNAME);
		//Set an alternative reply-to address
		$this->mail->addReplyTo(SMTP_USERNAME, SMTP_USERNAME);
	}

	public function setTo($to){
		$this->mail->addAddress($to, $to);
	}
	
	public function setSubject($subject){
		$this->mail->Subject = $subject;
	}
	
	public function setContent($content){
		$this->mail->msgHTML($content, __DIR__);
		$this->mail->AltBody = $content;
	}
	
	public function send(){
		return $this->mail->send();
	}
}
