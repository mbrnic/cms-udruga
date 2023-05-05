<?php

require_once(CONTROLLERS_PATH . 'UserController.php');
require_once(CONTROLLERS_PATH . 'UserRolesController.php');
use Controllers\UserController;
use Controllers\UserRolesController;

$User = new UserController;
$UserRoles = new UserRolesController;



if ( !$dbData = $User->readAllUsers() ) {
	//echo "ERROR in reading users list! User list is empty!";
	//die();
}


include_once (VIEWS_PATH . '/layouts/header.php');
?>

<br>
<h1 class="h3 mb-3 fw-normal text-center">List of users</h1>
<br>

<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">Name</th>
			<th scope="col">Email</th>
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col">Roles</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>

<?php
foreach ($dbData as $userData) {
		echo '<tr>';
			echo '<td>' . $userData['user_name'] . '</td>';
			echo '<td>' . $userData['user_email'] . '</td>';
			echo '<td><button type="button" class="btn btn-dark"';
				echo ' onclick="document.location=\'';
				echo ROOT_PATH . '/user/update/' . $userData['user_id'] . '\'';
				echo '">Edit</button></td>';
			echo '<td><button type="button" class="btn btn-danger"';
				echo ' onclick="document.location=\'';
				echo ROOT_PATH . '/user/delete/' . $userData['user_id'] . '\'';
				echo '">Delete</button></td>';
				
	if ( !$rolesData = $UserRoles->getRolesForUserId($userData['user_id']) ) {
			echo '<td>' . '-' . '</td>';
	} else {
			echo '<td>';
		for ( $i=0; $i<count($rolesData); $i++ ) {
			if ($i>0) echo "<br>";
			$roleData = $UserRoles->getRoleNameAndType($rolesData[$i]['role_id']);
			echo $roleData['role_name'] . '->' . $roleData['role_right'];
		}
			echo '</td>';
	}
				
			echo '<td><button type="button" class="btn btn-dark"';
				echo ' onclick="document.location=\'';
				echo ROOT_PATH . '/user/roles/' . $userData['user_id'] . '\'';
				echo '">Edit</button></td>';
		echo '</tr>';
}
?>

	</tbody>
</table>

<main class="form-signin w-50 m-auto">
	<button class="w-100 btn btn-lg btn-primary" type="button" onclick="document.location='<?= ROOT_PATH . '/user/register' ?>'">Create new</button>
</main>