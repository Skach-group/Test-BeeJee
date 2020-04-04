<?php defined('APPPATH') OR exit('No direct script access allowed');  

namespace App\Controllers;


class Router{
	
	private $routes;
	
	public function __construct(){
		$config = new \App\Config\Routes();
		$this->routes = $config->routes;				
	}

	private function getUrl(){
		if(!empty($_SERVER['REQUEST_URI'])){
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}
	
	public function getRout(){
		if(empty($this->getUrl())){
			$tasks = new \App\Controllers\Tasks();
			$tasks->getTasksList();
		}else{
			$uri = $this->getUrl();
			$error = array();
			foreach($this->routes as $key => $value){
				if(preg_match("~$key~", $this->getUrl())){
					$internalRoute = preg_replace("~$key~", $value, $uri);
					$segments = explode('::', $internalRoute);
					$name_class = array_shift($segments);
					$metod = explode('/', array_shift($segments));
					$name_metod = array_shift($metod);
					$parameters = $metod;
					if(class_exists($name_class)){
						http_response_code(200);
						$class = new $name_class();
						call_user_func_array(array($class, $name_metod), $parameters);
					}	
				}else{
					$error[] = $key;
				}
			}
			if(count($error) == count($this->routes)){
				http_response_code(404);
				$error404 = new \App\Controllers\Error();
				$error404->getPageError404();
			}
		}	
	}
	


}