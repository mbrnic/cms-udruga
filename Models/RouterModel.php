<?php

namespace Models;


class RouterModel {
     
    public $path;
    public $callback;
    public $method;
    
    public function __construct($path, $callback, $method = 'GET') {
        $this->path = ROOT_PATH . $path;
        $this->callback = $callback;
        $this->method = $method;
    }
    
    public function match($url) {
		$pattern = preg_replace('/\//', '\/', $this->path);
		$pattern = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $pattern);
		$pattern = '/^' . $pattern . '$/';

		if (!is_string($pattern)) {
			return null; // or throw an exception
		}

		preg_match($pattern, $url, $matches);
		return $matches;
		/*
        $pattern = preg_replace('/\//', '\/', $this->path);
        $pattern = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $pattern);
        $pattern = '/^' . $pattern . '$/';
        preg_match($pattern, $url, $matches);
        return $matches;
		*/
    }
    
    public function run() {
        call_user_func($this->callback);
    }
    
    public function isMatch($url, $method) {
		
		return $this->method == $method && preg_match($this->match($url), $url);
    }
}

?>