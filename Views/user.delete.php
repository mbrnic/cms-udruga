<?php

require_once(CONTROLLERS_PATH . 'UserController.php');
use Controllers\UserController;

$User = new UserController;


if ( $dbData = $User->readAllForUpdate() ) {
	// continue
} else {
	die();
}



include_once (VIEWS_PATH . '/layouts/header.php');
?>


<main class="form-signin w-50 m-auto">
	<form>
		<br><br><br><br>

		<h1 class="h3 mb-3 fw-normal text-center">DELETE this USER data?</h1>

		<div class="form-floating">
			<input type="text" class="form-control" id="text" name="name" placeholder="text" value="<?=$dbData['user_name']?>" disabled>
			<label for="name">Name</label>
		</div>
			
		<div class="form-floating">
			<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?=$dbData['user_email']?>" disabled>
			<label for="email">Email address</label>
		</div>
	
		<div class="form-floating">
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?=$dbData['user_password']?>" disabled>
			<label for="password">Password</label>
		</div>
			
		<div class="w-100 btn-group">
		<button class="w-75 btn btn-lg btn-danger" type="button" onclick="document.location='<?= ROOT_PATH . '/user/yes/delete' ?>'">Yes</button>
		<button class="w-25 btn btn-lg btn-primary" type="button" onclick="document.location='<?= ROOT_PATH . '/user/update' ?>'">No</button>
		</div>
			
		<br>
	
	</form>
</main>