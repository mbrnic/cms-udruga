<?php

require_once(CONTROLLERS_PATH . 'ArticleController.php');
use Controllers\ArticleController;

$Article = new ArticleController;



if (isset($article_id)) {
	if ( !$articleData = $Article->readArticleById($article_id) ) {
		echo "Cannot find article with id " . $article_id;
		die();
	}
}

if (isset($article_route)) {
	if ( !$articleData = $Article->readArticleByRoute($article_route) ) {
		echo "Cannot find article with route " . $article_route;
		die();
	}
}



include_once (VIEWS_PATH . '/layouts/header.php');
?>

<br>
<h1 class="h3 mb-3 fw-normal text-center"><?=$articleData['article_title']?></h1>
<img src="<?=ARTICLE_IMG_PATH . $articleData['article_image_src']?>" alt="<?=$articleData['article_image_alt']?>" width="500">
<div><?=$articleData['article_content']?></div>