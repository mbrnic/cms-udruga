<?php

require_once(CONTROLLERS_PATH . 'NavigationController.php');
use Controllers\NavigationController;

$Nav = new NavigationController;



include_once (VIEWS_PATH . '/layouts/header.php');


if ( $dbData = $Nav->readAllForUpdate($id) ) {
	// continue
} else {
	die();
}

?>


<main class="form-signin w-50 m-auto">
	<form>
		<br><br>

		<h1 class="h3 mb-3 fw-normal text-center">DELETE this NAVIGATION data?</h1>

		<div class="form-floating">
			<input type="text" class="form-control" id="text" name="name" placeholder="text" value="<?=$dbData['navigation_name']?>" disabled>
			<label for="name">Name</label>
		</div>

		<div class="form-floating">
			<select class="form-control" id="parent" name="parent" disabled>
<?php if ($dbData['navigation_parent_id']==0): ?>
				<option value="<?=$dbData['navigation_parent_id']?>" selected></option>	
<?php else: ?>
				<option value="<?=$dbData['navigation_parent_id']?>" selected><?=$Nav->getNameOfNavId($dbData['navigation_parent_id'])?></option>	
<?php endif ?>
			</select>
			<label for="parent">Child of</label>
		</div>


		<div class="form-floating">
			<select class="form-control" id="connection-type" name="connection-type" disabled>
				<option value="0" selected><?=$dbData['navigation_connection_type']?></option>';
			</select>
			<label for="connection-type">Connection type</label>
		</div>
		
		<div class="form-floating">
			<input type="number" class="form-control" id="connection-id" name="connection-id" placeholder="text" value="<?=$dbData['navigation_connection_id']?>" disabled>
			<label for="connection-id">Connection Id</label>
		</div>

		<div class="form-floating">
			<input type="text" class="form-control" id="route" name="route" placeholder="text" value="<?=$dbData['navigation_route']?>" disabled>
			<label for="route">Route nav/</label>
		</div>
		
		<div class="w-100 btn-group">
		<button class="w-75 btn btn-lg btn-danger" type="button" onclick="document.location='<?= ROOT_PATH . '/navigation/yes/delete/' . $id ?>'">Yes</button>
		<button class="w-25 btn btn-lg btn-primary" type="button" onclick="document.location='<?= ROOT_PATH . '/navigations' ?>'">No</button>
		</div>
			
		<br>
	
	</form>
</main>