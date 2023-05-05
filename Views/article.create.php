<?php
require_once(CONTROLLERS_PATH . 'ArticleController.php');
require_once(CONTROLLERS_PATH . 'UserRolesController.php');
use Controllers\ArticleController;
use Controllers\UserRolesController;

$Article = new ArticleController;
$UserRoles = new UserRolesController;


if (isset($_SESSION['user_id'])) {
	if (!$UserRoles->ableToArticleCreate()) {
		echo "Need rights to see this page!";
		die();
	}
} else {
	echo "Need to login to see this page!";
	die();
}


$errorData = $Article->createErrorArray();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$postData = $Article->checkForValidPostMethod();
	
	if (!$postData) {
		echo "Invalid POST method!";
		die();
	}
	
	$errorData = $Article->checkForPostErrors($postData);
	
	if (!$errorData['errorFound']) $Article->createArticle($postData);

}



include_once (VIEWS_PATH . '/layouts/header.php');
?>


<main class="form-signin w-50 m-auto">
	<form method="POST" action="<?= ROOT_PATH . '/article/create' ?>" enctype="multipart/form-data">
		<br><br>

		<h1 class="h3 mb-3 fw-normal text-center">New article</h1>


<?php if ($errorData['errorFound'] AND !$errorData['titleIsGoodLength']): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Invalid Title length!</strong> Title must have atleast 1, and not more then 50 characters.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>

		<div class="form-floating">
			<input type="text" class="form-control" id="text" name="title" placeholder="text" maxlength="50" required>
			<label for="title">Title</label>
		</div>

		
<?php if ($errorData['errorFound'] AND !$errorData['contentIsGoodLength']): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Invalid Content length!</strong> Content must have atleast 1 character.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>

		<div class="form-floating">
			<textarea class="form-control" id="content" name="content" required></textarea>
			<label for="content">Content</label>
		 </div>
		 
		
<?php if ($errorData['errorFound'] AND !$errorData['imageAltIsGoodLength']): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Invalid Image Alt length!</strong> Image Alt must have atleast 1, and not more then 50 characters.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>

		<div class="form-floating">
			<input type="text" class="form-control" id="image-alt" name="image-alt" placeholder="text" maxlength="50" required>
			<label for="img-alt">Image Alt</label>
		</div>


<?php if ($errorData['errorFound'] AND !$errorData['imageSrcIsValid']): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Invalid Image src!</strong> This src for image is not accepted.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>

		<div class="form-floating">
			<input type="file" class="form-control" id="image-src" name="image-src" accept="image/x-png,image/gif,image/jpeg" required>
			<label for="img-src">Image src</label>
		</div>


<?php if ($errorData['errorFound'] AND !$errorData['routeIsValid']): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Invalid Route!</strong> This route is allready in use.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>

		<div class="form-floating">
			<input type="text" class="form-control" id="route" name="route" placeholder="text" required>
			<label for="route">Route article/</label>
		</div>
	
		<button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Create</button>
			
		<br>
	
	</form>
</main>