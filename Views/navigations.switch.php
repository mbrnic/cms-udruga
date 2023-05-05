<?php

require_once(CONTROLLERS_PATH . 'NavigationController.php');
use Controllers\NavigationController;

$Nav = new NavigationController;


$Nav->switchOrderIds($id1, $id2);

?>