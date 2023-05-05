<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bootstrap demo</title>
		
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
		
	</head>
	
	<body>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>


<?php

// for "include"
define('ROOT', __DIR__);
define('ROOT_PATH', '/cms-udruga');
define('LIBS_PATH', ROOT . '/libs/');
define('MODELS_PATH', ROOT . '/Models/');
define('VIEWS_PATH', ROOT . '/Views/');
define('CONTROLLERS_PATH', ROOT . '/Controllers/');
define('ARTICLE_IMG_PATH', '/cms-udruga/images/articles/');
// for "src, href" etc
define('HTTP', $_SERVER['SERVER_NAME']); // for local development support i.e foo.com.local



require_once(ROOT . '/database.php');
require_once(CONTROLLERS_PATH . 'DatabaseController.php');
use Controllers\DatabaseController;

// Create a new instance of the DatabaseController class
$db = new DatabaseController(DB_HOST, DB_NAME, DB_USER, DB_PASS);



require_once(ROOT . '/routes.php');



/*
// Autoloader function

spl_autoload_register(function ($class) {
	//require_once(ROOT . '/models/' . $class . '.php');
	require_once(ROOT . $class . '.php');
});
*/



/*
spl_autoload_register(function ($class) {
	echo "Autoload started";
    // Convert namespace separator to directory separator
    $class = str_replace('\\', '/', $class);

    // Search for class file in multiple directories
    $dirs = ['models', 'views', 'controllers'];
    foreach ($dirs as $dir) {
        $file = ROOT . "/$dir/$class.php";
        if (file_exists($file)) {
            require_once $file;
			echo "Loaded: " . $class;
            return;
        }
    }
});
*/


?>



	</body>
	
</html>