<?php

require_once(CONTROLLERS_PATH . 'NavigationController.php');
use Controllers\NavigationController;

$Nav = new NavigationController;


$dbData = $Nav->readAllForUpdate($id);


$errorData = $Nav->createErrorArray();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$postData = $Nav->checkForValidPostMethod();
	
	if (!$postData) {
		echo "Invalid POST method!";
		die();
	}
	
	$errorData = $Nav->checkForPostErrors($postData, $dbData['navigation_route']);
	
	if (!$errorData['errorFound']) $Nav->updateNav($id, $postData);

}


include_once (VIEWS_PATH . '/layouts/header.php');
?>


<main class="form-signin w-50 m-auto">
	<form method="POST" action="<?= ROOT_PATH . '/navigation/update/' . $id ?>">
		<br><br>

		<h1 class="h3 mb-3 fw-normal text-center">Edit navigation</h1>


<?php if ($errorData['errorFound'] AND !$errorData['nameIsGoodLength']): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Invalid Name length!</strong> Name must have atleast 1, and not more then 10 characters.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>

		<div class="form-floating">
			<input type="text" class="form-control" id="text" name="name" placeholder="text" maxlength="50" value="<?=$dbData['navigation_name']?>" required>
			<label for="name">Name</label>
		</div>


<?php if ($errorData['errorFound'] AND !$errorData['parentIsValid']): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Invalid Parent!</strong> Selected parent is not found.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>

		<div class="form-floating">
			<select class="form-control" id="parent" name="parent">
<?php
if ($dbData['navigation_parent_id']==0) {
				echo '<option value="0" selected></option>';
				$possibleParents = $Nav->whoCanBeParentNav();
				foreach ($possibleParents as $parent) {
					echo '<option value="' . $parent['navigation_id'] . '">' . $parent['navigation_name'] . '</option>';
				}
} else {
				echo '<option value="0"></option>';
				$possibleParents = $Nav->whoCanBeParentNav();
				foreach ($possibleParents as $parent) {
					if ($dbData['navigation_parent_id']==$parent['navigation_id']) {
						echo '<option value="' . $parent['navigation_id'] . '" selected>' . $parent['navigation_name'] . '</option>';
					} else {
						echo '<option value="' . $parent['navigation_id'] . '">' . $parent['navigation_name'] . '</option>';
					}
				}
}
?>
			</select>
			<label for="parent">Child of</label>
		</div>


<?php if ($errorData['errorFound'] AND !$errorData['connectionTypeIsValid']): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Invalid Connection Type!</strong> Selected connection type is not found.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>

		<div class="form-floating">
			<select class="form-control" id="connection-type" name="connection-type">
<?php
	$connTypes = $Nav->getConnectionTypes();
	for ($i = 0; $i < count($connTypes); $i++) {
			echo '<option value="' . $connTypes[$i]['id'] . '"';
			if ($dbData['navigation_connection_type']==$connTypes[$i]['type']) echo ' selected';
			echo '>' . $connTypes[$i]['type'] . '</option>';
	}
?>
			</select>
			<label for="connection-type">Connection type</label>
		</div>
		
		<div class="form-floating">
			<input type="number" class="form-control" id="connection-id" name="connection-id" placeholder="text" min="1" value="<?=$dbData['navigation_connection_id']?>"required>
			<label for="connection-id">Connection Id</label>
		</div>


<?php if ($errorData['errorFound'] AND !$errorData['routeIsValid']): ?>
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Invalid Route!</strong> This route is allready in use.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
<?php endif ?>

		<div class="form-floating">
			<input type="text" class="form-control" id="route" name="route" placeholder="text" value="<?=$dbData['navigation_route']?>"required>
			<label for="route">Route nav/</label>
		</div>
	
		<button class="w-100 btn btn-lg btn-primary" type="submit">Update</button>
			
		<br>
	
	</form>
</main>