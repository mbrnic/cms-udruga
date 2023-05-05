<?php

require_once(CONTROLLERS_PATH . 'ArticleController.php');
use Controllers\ArticleController;

$Article = new ArticleController;



if ( !$dbData = $Article->readAllArticles() ) {
	//echo "ERROR in reading articles list! Article list is empty!";
	//die();
}


include_once (VIEWS_PATH . '/layouts/header.php');
?>

<br>
<h1 class="h3 mb-3 fw-normal text-center">List of articles</h1>
<br>

<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">Title</th>
			<th scope="col">Content</th>
			<th scope="col">Image alt</th>
			<th scope="col">Image src</th>
			<th scope="col">Route article/</th>
			<th scope="col"></th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>

<?php
foreach ($dbData as $article) {
		echo '<tr>';
			echo '<td>' . $article['article_title'] . '</td>';
	if ( strlen($article['article_content']) > 100 ) {
			echo '<td>' . substr($article['article_content'],0,95) . '... </td>';
	} else {
			echo '<td>' . $article['article_content'] . '</td>';
	}
			echo '<td>' . $article['article_image_alt'] . '</td>';
			echo '<td>' . $article['article_image_src'] . '</td>';
			echo '<td>' . $article['article_route'] . '</td>';
			echo '<td><button type="button" class="btn btn-dark"';
				echo ' onclick="document.location=\'';
				echo ROOT_PATH . '/article/update/' . $article['article_id'] . '\'';
				echo '">Edit</button></td>';
			echo '<td><button type="button" class="btn btn-danger"';
				echo ' onclick="document.location=\'';
				echo ROOT_PATH . '/article/delete/' . $article['article_id'] . '\'';
				echo '">Delete</button></td>';
		echo '</tr>';
}
?>

	</tbody>
</table>

<main class="form-signin w-50 m-auto">
	<button class="w-100 btn btn-lg btn-primary" type="button" onclick="document.location='<?= ROOT_PATH . '/article/create' ?>'">Create new</button>
</main>