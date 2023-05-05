<?php

require_once(CONTROLLERS_PATH . 'UserController.php');
use Controllers\UserController;

$User = new UserController;



$emailFound = false;


if ( $dbData = $User->readAllForUpdate() ) {
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$makeChange = false;
		
		$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
		
		if ( $temp = $User->readEmail($email) ) {
			
			if ( $dbData['user_email'] == $temp['user_email'] ) {
			
				// mail u koji se želi promijeniti postoji u bazi
				// ali je to njegov mail, tako da može ostati
				// napravi promjenu
				$makeChange = true;
			
			} else {
			
				$emailFound = true;
			
			}
			
		} else {
			
			// nema takvog maila u bazi, napravi promjenu
			$makeChange = true;
			
		}
		
		
		if ($makeChange) {
		
			$User->updateUser($name, $email, $password);
		
		}
		
	}
	
} else {
	
	die();
	
}



include_once (VIEWS_PATH . '/layouts/header.php');
?>



<main class="form-signin w-50 m-auto">
	<form method="POST" action="<?= ROOT_PATH . '/user/update' ?>">
		<br><br><br><br>


<?php if ($emailFound): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Email in use!</strong> This new email that you want to use, is allready in use.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>


		<h1 class="h3 mb-3 fw-normal text-center">User information</h1>

		<div class="form-floating">
			<input type="text" class="form-control" id="text" name="name" placeholder="text" value="<?=$dbData['user_name']?>" required>
			<label for="name">Name</label>
		</div>
			
		<div class="form-floating">
			<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?=$dbData['user_email']?>" required>
			<label for="email">Email address</label>
		</div>
	
		<div class="form-floating">
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?=$dbData['user_password']?>" required>
			<label for="password">Password</label>
		</div>
			
		<div class="w-100 btn-group">
		<button class="w-25 btn btn-lg btn-danger" type="button" onclick="document.location='<?= ROOT_PATH . '/user/delete' ?>'">Delete</button>
		<button class="w-75 btn btn-lg btn-primary" type="submit">Update</button>
		</div>
			
		<br>
	
	</form>
</main>