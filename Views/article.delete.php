<?php

require_once(CONTROLLERS_PATH . 'ArticleController.php');
use Controllers\ArticleController;

$Article = new ArticleController;



include_once (VIEWS_PATH . '/layouts/header.php');


if ( !$dbData = $Article->readAllForUpdate($id) ) die();


?>


<main class="form-signin w-50 m-auto">
	<form>
		<br><br>

		<h1 class="h3 mb-3 fw-normal text-center">DELETE this ARTICLE data?</h1>

		<div class="form-floating">
			<input type="text" class="form-control" id="text" name="title" placeholder="text" value="<?=$dbData['article_title']?>" disabled>
			<label for="title">Title</label>
		</div>
		
		
		<div class="form-floating">
			<textarea class="form-control" id="content" name="content" disabled><?=$dbData['article_content']?></textarea>
			<label for="content">Content</label>
		 </div>
		 
		 
		<div class="form-floating">
			<input type="text" class="form-control" id="image-alt" name="image-alt" placeholder="text" value="<?=$dbData['article_image_alt']?>" disabled>
			<label for="img-alt">Image Alt</label>
		</div>
		
		
		<div class="form-floating">
			<input type="text" class="form-control" id="image-src" name="image-src" placeholder="text" value="<?=$dbData['article_image_src']?>" disabled>
			<label for="img-src">Image src</label>
		</div>
		
		
		<div class="form-floating">
			<input type="text" class="form-control" id="route" name="route" placeholder="text" value="<?=$dbData['article_route']?>" disabled>
			<label for="route">Route article/</label>
		</div>

		
		<div class="w-100 btn-group">
		<button class="w-75 btn btn-lg btn-danger" type="button" onclick="document.location='<?= ROOT_PATH . '/article/yes/delete/' . $id ?>'">Yes</button>
		<button class="w-25 btn btn-lg btn-primary" type="button" onclick="document.location='<?= ROOT_PATH . '/articles' ?>'">No</button>
		</div>
			
		<br>
	
	</form>
</main>