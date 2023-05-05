<?php

require_once(CONTROLLERS_PATH . 'ArticleController.php');
use Controllers\ArticleController;

$Article = new ArticleController;


$Article->deleteArticle($id);

?>