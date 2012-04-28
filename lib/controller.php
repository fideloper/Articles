<?php

require_once(LIB_PATH . 'markdown.php');

//Routes: Home page OR article

class Controller {
	
	//Template variables (Abstract to __get, __set)
	public $title;
	public $content;
	
	private $_article;
	
	public function __construct() {
		
	}
	
	public function parseRequest() {
		if(!isset($_GET['r'])) {
			$this->_article = 'index.md';
			return $this;
		}
		
		//article/file.md - .htaccess ensures we're getting a real file
		$segments = explode('/', $_GET['r']);
		$segLength = count($segments);
		
		if($segLength > 1) {
			$this->_article = $segments[count($segments) - 1];
			return $this;
		} else {
			//Good candidate for a 404
			$this->_article = 'index.md';
			return $this;
		}
		
		
	}
	
	public function render() {
		if($this->_article === 'index.md') {
			$this->title = '';
			$this->content = Markdown(file_get_contents(ART_PATH . 'index.md'));
		} else {
			$this->title = ucwords(str_replace('_', ' ', str_replace('.md', '', $this->_article))) . ' | ';
			$this->content = Markdown(file_get_contents(ART_PATH . $this->_article));
		}
		
		ob_start();
        
        include(APP_PATH . 'template/index.php');

        echo ob_get_clean();
        
        return $this;
	}
	
	public function redirect($path) {
		header('Location: ' . $path);
		exit(0);
	}
	
}