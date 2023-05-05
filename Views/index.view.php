<?php

require_once(CONTROLLERS_PATH . 'NavigationController.php');
require_once(CONTROLLERS_PATH . 'ArticleController.php');
use Controllers\NavigationController;
use Controllers\ArticleController;

$Nav = new NavigationController;
$Article = new ArticleController;


if ( !$firstNavData = $Nav->readConnectionInfoOfNavFromOrderFirst() ) {
	echo "Cannot find navigation with order id 1";
	die();
} else {
	if ( $firstNavData['navigation_connection_type'] == 'Article' ) {
		if ( !$articleData = $Article->readArticleById($firstNavData['navigation_connection_id']) ) {
			echo "Not found Article with id " . $firstNavData['navigation_connection_id'] . "who is connected with navigation order id 1";
			die();
		}
	} else {
		echo "Navigation order id 1 does not have Article as connection type";
		die();
	}
}


include_once (VIEWS_PATH . '/layouts/header.php');
?>

<br>
<h1 class="h3 mb-3 fw-normal text-center"><?=$articleData['article_title']?></h1>
<img src="<?=ARTICLE_IMG_PATH . $articleData['article_image_src']?>" alt="<?=$articleData['article_image_alt']?>" width="500">
<div><?=$articleData['article_content']?></div>