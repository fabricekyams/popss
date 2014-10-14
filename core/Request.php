<?php
/**
 * 
 * @author eclipse
 *
 */
class Request{

	private  $url;
	private $controller = 'home';
	private $action = 'index';
	private $parrams = array();
	private $data = array();
	private $prefix;
	/**
	 * 
	 */
	
	public function __construct()
	{
		if (isset($_SERVER['PATH_INFO'])){
		$this->setUrl($_SERVER['PATH_INFO']);
		}
		
		if (!empty($_POST)){
			/*$_POST=$this->removeSpecialChars($_POST);
			var_dump($_POST);*/
			$this->data = $_POST;
		}
	}
	
	public function removeSpecialChars($post){
		var_dump('here');
		$data =array();
		foreach ($post as $k => $v){
			if(is_array($post[$k])){
				$data = $this->removeSpecialChars($post[$k]);
			
			}else{
				$data[$k]=htmlspecialchars($post[$k]);
			}
		}
		return $data;
		
	}
	
	/**
	 * 
	 * @return Ambigous <string, unknown>
	 */
	public function getUrl() {
		return $this->url;
	}
	
	/**
	 * 
	 * @param unknown $url
	 */
	public function setUrl($url) {
		$this->url = $url;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getController() {
		return $this->controller;
	}
	
	/**
	 * 
	 * @param unknown $controller
	 */
	public function setController($controller) {
		$this->controller = $controller;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function getAction() {
		return $this->action;
	}
	
	/**
	 * 
	 * @param unknown $action
	 */
	public function setAction($action) {
		$this->action = $action;

	}
	
	/**
	 * 
	 */
	public function getParrams() {
		return $this->parrams;
	}
	
	/**
	 * 
	 * @param unknown $parrams
	 */
	public function setParrams($parrams) {
		$this->parrams = $parrams;

	}
	public function getPrefix() {
		return $this->prefix;
	}
	public function setPrefix($prefix) {
		$this->prefix = $prefix;
		return $this;
	}
	public function getData() {
		return $this->data;
	}
	public function setData($data) {
		$this->data = $data;
		return $this;
	}
	
	
	
	
	
}