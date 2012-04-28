<?php
//Determine Environment
defined('APP_ENV') || define('APP_ENV', (getenv('APP_ENV') ? getenv('APP_ENV') : 'production'));

/* Constants */
define('DOC_ROOT', 		$_SERVER['DOCUMENT_ROOT'] . '/');
define('APP_PATH', 		DOC_ROOT . '../');
define('LIB_PATH', 		APP_PATH . 'lib/');
define('ART_PATH',	 	DOC_ROOT . '/article/');

//Load Application
require_once(LIB_PATH . 'application.php');

//Config Options
$options = array(
	
);

//Run
$app = new Application();
$app->bootstrap($options)->run();