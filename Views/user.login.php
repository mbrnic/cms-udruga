<?php

require_once(CONTROLLERS_PATH . 'UserController.php');
use Controllers\UserController;

$User = new UserController;



$userFound = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	
	//za spremanje u bazu
	//$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	
	//za čitanje iz baze i usporedbu
	//password_verify()

	
	//$email = $_POST['email'];
	//$password = $_POST['password'];
	
	if ( $id = $User->readLogin($email, $password) ) {
		$User->createSession($id['user_id']);
		
		header('Location: ' . ROOT_PATH . '/');
		//preusmjeriti na ovu stranicu, kada napravim dashboard
		//s tim da moram na njoj ili nekoj drugoj napraviti za klik na Log out
		//header('Location: ' . ROOT_PATH . '/user/update');
	} else {
		$userFound = false;
	}

}


/*
if ( $id = $User->readLogin('admin@admin.com', 'admin') ) {
	echo "USER FOUND with id " . $id['user_id'];
	$userFound = true;
} else {
	echo "USER NOT FOUND";
}
*/



include_once (VIEWS_PATH . '/layouts/header.php');
?>


<main class="form-signin w-50 m-auto">
	<form method="POST" action="<?= ROOT_PATH . '/user/login' ?>">
		<br><br><br><br>


<?php if (!$userFound): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>User not found!</strong> You should check your spelling or register.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>


		<h1 class="h3 mb-3 fw-normal text-center">Please log in</h1>

		<div class="form-floating">
			<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
			<label for="email">Email address</label>
		</div>
	
		<div class="form-floating">
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
			<label for="password">Password</label>
		</div>

		<div class="checkbox mb-3">
			<label><input type="checkbox" value="remember-me"> Remember me</label>
		</div>
	
		<button class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>
			
		<br>
			
		<div class="text-center">
			Dont have account? <a href="<?= ROOT_PATH . '/user/register' ?>"> Click here to register! </a>
		</div>
	
	</form>
</main>