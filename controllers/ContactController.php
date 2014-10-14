<?php
class ContactController extends Controller{

	/*public function __construct(){
		
		
	}*/
	
	public function index(){
		require_once  '..'.DS.'core'.DS.'Form.php';
		$model = $this->loadModel('contact');
		if (!empty($this->getReq()->getData())){
			$message = $this->getReq()->getData();
			$this->valid($message['email'], '#aze*#', 'email invalide');
			var_dump($_SESSION);
			die();
			
			$this->sendMail($message);
		}
		$this->render('index');

	}
	
	public function sendMail($message){
		require_once  '..'.DS.'core'.DS.'Mail.php';
		$mailer = new Mail();
		$mailer->send($message); 		
	}



}