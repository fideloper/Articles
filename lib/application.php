<?php

require_once(LIB_PATH . 'config.php');
require_once(LIB_PATH . 'controller.php');
require_once(LIB_PATH . 'cache.php');

class Application {
	
	//App Instance
	public static $_instance;
	
	//Private variables
	private $_config;
	private $_controller;
	private $_cache;
	
	public function __construct() {
		self::$_instance = $this;
		
		return $this;
	}
	
	public function bootstrap($opts) {
		//Config
		if(null === $this->_config) {
			$this->_config = new Config($opts);
		}
		
		$this->_cache = new Cache();
		
		//Controller
		$this->_controller = new Controller();
		
		//Route
		return $this;
	}
	
	public function run() {
		$this->_controller->parseRequest()->render();
		return $this;
	}
	
	public function getConfig() {
		if(null === $this->_config) {
			return new Config();
		}
		return $this->_config;
	}
	
	public static function instance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	
}