<?php
class Mail {
	public $mail;
	
	public function __construct(){
		require '..'.DS.'libs'.DS.'PHPMailer'.DS.'PHPMailerAutoload.php';
		
		$this->mail = new PHPMailer;
		
		//$mail->SMTPDebug = 3;                               // Enable verbose debug output
		
		$this->mail->isSMTP();                                      // Set mailer to use SMTP
		$this->mail->Host = 'phenomen.be';  // Specify main and backup SMTP servers
		$this->mail->SMTPAuth = false;                               // Enable SMTP authentication
		//$this->mail->Username = 'fabrice@phonomen.be';                 // SMTP username
		//$this->mail->Password = 'secret';                           // SMTP password
		//$this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$this->mail->Port = 25;                                    // TCP port to connect to
		
		
		$this->mail->FromName = 'Popsss';
		//$this->mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
		//$this->mail->addAddress('ellen@example.com');               // Name is optional
		//$this->mail->addReplyTo('info@example.com', 'Information');
		//$this->mail->addCC('cc@example.com');
		//$this->mail->addBCC('bcc@example.com');
		
		//$this->mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		//$this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$this->mail->isHTML(true);  
		$this->mail->SMTPDebug  = 3;                                // Set email format to HTML
		
		
		
		
	}
	
	public function send($message){
		$this->mail->addAddress('fabrice.kyams@gmail.com', 'Joe User');
		$this->mail->Subject = 'Information';
		$this->mail->From = $message['email'];
		$this->mail->Body = $message['name'];
		$this->mail->Body .='FROM: '.$message['firstname'].' ';
		$this->mail->Body .= $message['function']."\n";
		$this->mail->Body .= $message['company']."\n";
		$this->mail->Body .= $message['phone']."\n";
		$this->mail->Body .= $message['email']."\n";	
		$this->mail->Body .= $message['message']."\n";
		if(!$this->mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $this->mail->ErrorInfo;
		} else {
			echo 'Message has been sent';
		}
		
	}
	
} 