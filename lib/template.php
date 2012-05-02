<?php

require_once(LIB_PATH . 'view.php');

class Template extends View {
	
	private $_article;
	
	public function setArticle(Article $art) {
		$this->_article = $art;
		return $this;
	}
	
	public function getArticle() {
		return $this->_article;
	}
	
	public function render() {
		//Merge $_vars if article set
		if($this->_article instanceof Article) {
			foreach($this->_article->_vars as $k => $v) {
				$this->$k = $v;
			}
		}
		
		ob_start();
        
        include(APP_PATH . 'template/index.php');

        return ob_get_clean();
	}
	
}