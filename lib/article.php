<?php

require_once(LIB_PATH . 'view.php');
require_once(LIB_PATH . 'markdown.php');

class Article extends View {
	
	public function render() {
		if(is_null($this->_filepath) === TRUE) {
			return false;
		}
		
		$this->content = Markdown(file_get_contents($this->_filepath));
		
		//Parse date if available in markdown
		//Format:  <!-- Date: Month DD, YYYY -->
		$matches = array();
		preg_match('/<!-- Date: (.*)-->/', $this->content, $matches);
		//Result:  Array ( [0] => [1] => April 30, 2012 ) (That sorta sucks)
		
		$this->timestamp = false;
		$this->date = '';
		
		if(isset($matches[1])) {
			$this->timestamp = strtotime($matches[1]);
			if($this->timestamp !== FALSE) {
				$this->date = date('F d, Y');
			}
		}
		
		return $this;
	}
	
}