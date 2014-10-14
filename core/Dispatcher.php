<?php

class Dispatcher{
	
	var $req;
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->req= new Request();
		Router::parseURL($this->req->getUrl(),$this->req);
		$controller = $this->loadController();
		if(in_array($this->req->getAction(),array_diff(get_class_methods($controller),get_class_methods('Controller')) )){
			call_user_func_array(array($controller, $this->req->getAction()),$this->req->getParrams());		
		}else{
			$this->error("Cette action n\'exite pas");
		}		
	}

	public function loadController(){
		$name = ucfirst($this->req->getController()).'Controller';
		$controllerFile='';
		
		if (($this->req->getPrefix())){
			$prefix = $this->req->getPrefix();
			$controllerFile = '..'.DS.'controllers'.DS.$prefix.DS.$name.'.php';
		}
		else {
			$controllerFile = '..'.DS.'controllers'.DS.$name.'.php';
		}
		if(file_exists($controllerFile)){
			require $controllerFile;
			$controller = new $name($this->req);
			return  $controller;
	
		}else {
			$this->error('Ce controlleur n\'existe pas');	
		}
	}
	

	public function error($message){
		header("HTTP/1.0 404 Not Found");
		echo "ERROR 404: ".$message;
		die();
	}
	
	
	
}