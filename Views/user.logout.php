<?php

require_once(CONTROLLERS_PATH . 'UserController.php');
use Controllers\UserController;

$User = new UserController;


$User->deleteSession();

?>