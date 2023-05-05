<?php

namespace Controllers;

require_once(MODELS_PATH . 'RouterModel.php');
use Models\RouterModel as Route;


class RouterController {
	
	public function init() {
	
		$routes = array(
		new Route('/', function() { echo 'Welcome!'; }),
		new Route('/home', function() { echo 'You are on the home page.'; }),
		new Route('/article/{id}', function($id) { echo 'You are viewing article ' . $id; }),
		new Route('/contact', function() { echo 'You are on the contact page.'; })
		);

		//echo "<pre>";
		//print_r($routes);
		//echo "</pre>";

		foreach ($routes as $route) {
			
			echo "checking $route->path <br>";
			echo "with" . $_SERVER['REQUEST_URI'] . "<br>";
			
			
			if ($route->isMatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'])) {
				$route->run();
				break;
			}
		}
	
	}
	
}

?>