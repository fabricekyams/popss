<?php

define('ROOT', (dirname(dirname(__FILE__))));
$dir = basename(ROOT);
$url = explode($dir, $_SERVER['REQUEST_URI']);
if (count($url)==1){
	define('WEBROOT', '/');
}else {
	define('WEBROOT',$url[0].$dir.'/');
}

define('IMAGE', ROOT . DIRECTORY_SEPARATOR . 'web/img/');
define('DS', DIRECTORY_SEPARATOR);
define('CORE', WEBROOT.'core'.DS);

