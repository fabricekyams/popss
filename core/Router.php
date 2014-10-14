<?php
class Router{

	static $prefix = array();
	
	public static function prefix($url, $prefix){
		self::$prefix[$url]=$prefix;
	}
	public static function parseURL($url,Request $request)
	{
		if (isset($url)){
			$url = trim($url,'/');
			$explode = explode('/', $url);
			if (array_key_exists($explode[0], self::$prefix)){
				$request->setPrefix(self::$prefix[$explode[0]]);
				array_shift($explode);
			}
			if(isset($explode[0])){
				$request->setController($explode[0]);
				$action  = isset($explode[1]) ? $explode[1] : 'index';
				$request->setAction($action);
				$request->setParrams(array_slice($explode, 2));
			}
			
		}
		
	} 
}