<?php

/* Config */
class Config {
	private $_config = array();
	
	public function __construct($args) {
		if(is_array($args)) {
			foreach($args as $k => $v) {
				$this->config[$k] = $v;
			}
		}
		return $this;
	}
	
	public function set($key, $val) {
		$this->_config[$key] = $val;
		return $this;
	}
	
	public function get($key) {
		if(isset($this->_config[$key])) {
			return $this->_config[$key];
		}
		return FALSE;
	}
}