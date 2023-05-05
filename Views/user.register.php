<?php

require_once(CONTROLLERS_PATH . 'UserController.php');
use Controllers\UserController;

$User = new UserController;



$emailFound = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	
	//za spremanje u bazu
	//$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	
	//za čitanje iz baze i usporedbu
	//password_verify()

	
	//$email = $_POST['email'];
	//$password = $_POST['password'];
	
	
	if ( $temp = $User->readEmail($email) ) {
		$emailFound = true;
	} else {
		$User->createUser($name, $email, $password);
		header('Location: ' . ROOT_PATH . '/user/login');
	}

}



include_once (VIEWS_PATH . '/layouts/header.php');
?>


<main class="form-signin w-50 m-auto">
	<form method="POST" action="<?= ROOT_PATH . '/user/register' ?>">
		<br><br><br><br>


<?php if ($emailFound): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Email in use!</strong> This email is allready in use, contact us for recovery details.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>


		<h1 class="h3 mb-3 fw-normal text-center">Registration form</h1>

		<div class="form-floating">
			<input type="text" class="form-control" id="text" name="name" placeholder="text" required>
			<label for="name">Name</label>
		</div>
			
		<div class="form-floating">
			<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
			<label for="email">Email address</label>
		</div>
	
		<div class="form-floating">
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
			<label for="password">Password</label>
		</div>
	
		<button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
			
		<br>
	
	</form>
</main>