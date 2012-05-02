<?php

require_once(LIB_PATH . 'template.php');
require_once(LIB_PATH . 'article.php');

//Routes: Home page OR article

class Controller {
	
	private $_article;
	private $_template;
	private $_config;
	
	public function __construct() {
		$this->_article = new Article();
		$this->_template = new Template();
		$this->_config = Application::instance()->getConfig()->set('defaultView', 'index.md');
	}
	
	public function parseRequest() {
		if(!isset($_GET['r'])) {
			$this->_article->title = '';
			$this->_article->setPath(ART_PATH . $this->_config->get('defaultView'));
			return $this;
		}
		
		//article/file.md - .htaccess ensures we're getting a real file
		$segments = explode('/', $_GET['r']);
		$segLength = count($segments);
		
		if($segLength > 1) {
			$this->_article->title = ucwords(str_replace('_', ' ', str_replace('.md', '', basename($this->_article->path)))) . ' | ';
			$this->_article->setPath(ART_PATH . $segments[count($segments) - 1]);
			return $this;
		} else {
			//Good candidate for a 404
			$this->_article->setPath(ART_PATH . $this->_config->get('defaultView'));
			return $this;
		}
		
		
	}
	
	public function render() {
		echo $this->_template->setArticle($this->_article->render())->render();
        return $this;
	}
	
	public function redirect($url) {
		header('Location: ' . $url);
		exit(0);
	}
	
}