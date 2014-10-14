<?php
class Session{
	
	public function __construct(){
		if(!isset($_SESSION)){
			session_start();	
		}
	}
	
	public function set($datas){
		foreach ($datas as $k => $v){
			$_SESSION[$k] = $v;
		}
	}
	
	public function setFlash($message, $type){
		$_SESSION['flash']= array(
				'message' => $message,
				'type' => $type
		);
	}
	
	public function unsetKey($key){
		unset($_SESSION[$key]);
	}
	
	public function showFlash(){
		if (isset($_SESSION['flash'])){
			extract($_SESSION['flash']);
			unset($_SESSION['flash']);

			return "<div class='alert alert-$type alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
			$message
			</div>";
		}
	} 
	
	public function isLogged(){
		return isset($_SESSION['AUTH']);
	}
}