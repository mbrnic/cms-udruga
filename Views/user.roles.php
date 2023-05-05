<?php

require_once(CONTROLLERS_PATH . 'UserController.php');
require_once(CONTROLLERS_PATH . 'UserRolesController.php');
use Controllers\UserController;
use Controllers\UserRolesController;

$User = new UserController;
$UserRoles = new UserRolesController;


$rolesData = $UserRoles->getAllPossibleRoles();
$userRolesData = $UserRoles->getRolesForUserId($id);



if ($_SERVER['REQUEST_METHOD'] == 'POST') $UserRoles->updateUserRoles($id);



include_once (VIEWS_PATH . '/layouts/header.php');
?>


<main class="form-signin w-50 m-auto">
	<form method="POST" action="<?= ROOT_PATH . '/user/roles/' . $id ?>">
		<br><br><br><br>



		<h1 class="h3 mb-3 fw-normal text-center">User "<?=$User->getName($id)?>" roles</h1>

<?php
foreach ($rolesData as $role) {
			echo '<div>';
			echo '<input type="checkbox" id="' . $role['role_id'] . '" name="' . $role['role_id'] . '" value="' . $role['role_id'];
		
		$userHasThisRole = false;
	foreach ($userRolesData as $check) {
		if ($check['role_id']==$role['role_id']) $userHasThisRole = true;
	}
	
	if ($userHasThisRole) {
		echo '" checked>';
	} else {
		echo '">';
	}
	
			echo '<label for="' . $role['role_id'] . '"> ' . $role['role_name'] . '->' . $role['role_right'] . '</label>';
			echo '</div>';
}
?>
			
		<button class="w-100 btn btn-lg btn-primary" type="submit">Update</button>
			
		<br>
	
	</form>
</main>