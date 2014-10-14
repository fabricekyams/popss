<?php
abstract class Controller{
	
	private $req;
	private $vars = array();
	private  $layout ;
	private  $model = array();
	private $session;
	 	
	/**
	 * 
	 * @param Request $req
	 */
	public function __construct(Request $req){
		$this->setReq($req);
		$this->setSession(new Session());
		$prefix =$this->req->getPrefix();
		if(isset($prefix)&& $prefix=='admin'){
			require '..'.DS.'config'.DS.'security.php';
		}
	}
	
	/**
	 * 
	 * @param unknown $view
	 */
	public function valid($value, $match, $errorMessage){
			$ok = preg_match($match, $value);
			if(!$ok){
				
				$this->getSession()->setFlash($errorMessage, $value); //set message flash from Session.php
			}
			return $ok;
	}
	
	
	public function render($view,$layout = 'default'){
		
		extract($this->getVars());
		if ($this->req->getPrefix()){
			$prefix = $this->req->getPrefix();
			$view = '..'.DS.'views'.DS.$prefix.DS.$this->getReq()->getController().DS.$view.'.php';
			if ($layout=='default'){
				$this->setLayout($prefix);
			}else {
				$this->setLayout($layout);
			}
		}else{
			$this->setLayout($layout);
			$view = '..'.DS.'views'.DS.$this->getReq()->getController().DS.$view.'.php';
		}
		ob_start();
		require($view);
		$renderContent = ob_get_clean();
		require '..'.DS.'views'.DS.'template'.DS.$this->getLayout().'.php';
	}
	
	/**
	 * 
	 * @param unknown $vars
	 */
	
	public function addVars($name, $vars) {
		
			$this->vars[$name] = $vars;
		
	
	}
	
	/**
	 * 
	 * @param Model $name 
	 */
	
	public function loadModel($name){
		$modelName = ucfirst($name).'Model';
		$modelFile = '..'.DS.'models'.DS.$modelName.'.php';
		require_once $modelFile;
		$this->addModel($name, $modelName);


		
		

	}
	/**
	 *
	 * @param unknown $name
	 * @param unknown $modelName
	 */
	public function addModel($name, $modelName) {
		if (!isset($this->model[$name])){
			$this->model[$name] = new $modelName();
		}
	}
	
	/**
	 * 
	 * @param unknown $message
	 */
	public function e404($message){
		header("HTTP/1.0 404 Not Found");
		echo "ERROR 404: ".$message;
		die();
	}
	
	public function redirect($url, $code = 0){
		if($code == 301){
			header("HTTP/1.1 301 Moved Permanently");
		}
		header("Location: ".$url);
		die();
	}
	/**
	 * 
	 */
	public function getReq() {
		return $this->req;
	}
	
	/**
	 * 
	 * @param unknown $req
	 */
	public function setReq($req) {
		$this->req = $req;
	}
	
	/**
	 * 
	 * @return multitype:
	 */
	public function getVars() {
		return $this->vars;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getLayout() {
		return $this->layout;
	}
	
	/**
	 * 
	 * @param unknown $layout
	 */
	public function setLayout($layout) {
		$this->layout = $layout;
	}
	
	/**
	 * 
	 */
	public function getModel() {
		return $this->model;
	}
	public function getSession() {
		return $this->session;
	}
	public function setSession($session) {
		$this->session = $session;
		return $this;
	}
	
	
	
	
	
	
}