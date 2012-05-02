<?php

abstract class View {
	protected $_vars = array();
	protected $_filepath;
	
	public function __construct($vars=null) {
		if(is_array($vars)) {
			$this->_vars = $vars;
		} 
		return $this;
	}
	
	public function __get($var) {
		if(isset($this->_vars[$var])) {
			return $this->_vars[$var];
		}
		return null;
	}
	
	public function __set($key, $value=null) {
		$this->_vars[$key] = $value;
		return $this;
	}
	
	public function setPath($path) {
		if(file_exists($path) !== FALSE) {
			$this->_filepath = $path;
		} else {
			throw new Exception('View file does not exist: '.$path);
		}
		return $this;
	}
	
	public function getPath() {
		return $this->_filepath;
	}
	
	public function render() {
		return $this;
	}
}