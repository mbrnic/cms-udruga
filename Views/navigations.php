<?php

require_once(CONTROLLERS_PATH . 'NavigationController.php');
use Controllers\NavigationController;

$Nav = new NavigationController;



if ( !$dbData = $Nav->readNavsList() ) {
	//echo "ERROR in reading navigations list! Navigation list is empty!";
	//die();
}


include_once (VIEWS_PATH . '/layouts/header.php');
?>

<br>
<h1 class="h3 mb-3 fw-normal text-center">List of navigations</h1>
<br>

<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col" class="text-center">Order Id</th>
			<th scope="col">Name</th>
			<th scope="col">Child of</th>
			<th scope="col">Connection Type</th>
			<th scope="col">Connection Id</th>
			<th scope="col">Route nav/</th>
			<th scope="col"></th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
	
	
<?php
for ($i = 0; $i < count($dbData); $i++) {
    
	echo '<tr>';
	
		echo '<th scope="row" class="text-center">';
		
	if ($i == count($dbData) - 1) {
		echo '<button type="button" class="btn btn-outline-secondary" disabled><i class="bi-chevron-bar-down text-center"></i></button>';
	} else {
		echo '<button type="button" class="btn btn-outline-secondary"';
			echo ' onclick="document.location=\'';
			echo ROOT_PATH . '/navigations/switch/' . $id1=$i+1 . '/' . $id2=$i+2 . '\'';
			echo '"><i class="bi-chevron-down text-center"></i></button>';
	}
	
		echo '   ' . $dbData[$i]['navigation_order_id'] . '   ';
		
	if ($i == 0) {
		echo '<button type="button" class="btn btn-outline-secondary" disabled><i class="bi-chevron-bar-up"></i></button>';
	} else {
		//echo '<button type="button" class="btn btn-outline-secondary"><i class="bi-chevron-up"></i></button>';
		echo '<button type="button" class="btn btn-outline-secondary"';
			echo ' onclick="document.location=\'';
			echo ROOT_PATH . '/navigations/switch/' . $id1=$i+1 . '/' . $id2=$i . '\'';
			echo '"><i class="bi-chevron-up" text-center></i></button>';
	}
		
		echo '</th>';
		
		echo '<td>' . $dbData[$i]['navigation_name'] . '</td>';
		echo '<td class="fst-italic">' . $Nav->getNameOfNavId($dbData[$i]['navigation_parent_id']) . '</td>';
		echo '<td>' . $dbData[$i]['navigation_connection_type'] . '</td>';
		echo '<td>' . $dbData[$i]['navigation_connection_id'] . '</td>';
		echo '<td>' . $dbData[$i]['navigation_route'] . '</td>';
		//echo '<td><button type="button" class="btn btn-dark">Edit</button></td>';
		echo '<td><button type="button" class="btn btn-dark"';
			echo ' onclick="document.location=\'';
			echo ROOT_PATH . '/navigation/update/' . $id=$dbData[$i]['navigation_order_id'] . '\'';
			echo '">Edit</button></td>';
		echo '<td><button type="button" class="btn btn-danger"';
			echo ' onclick="document.location=\'';
			echo ROOT_PATH . '/navigation/delete/' . $id=$dbData[$i]['navigation_order_id'] . '\'';
			echo '">Delete</button></td>';
	
	echo '</tr>';
	
}

/*
foreach ($dbData as $navigation) {
		echo '<tr>';
		
		echo '<th scope="row" class="text-center">';
		echo '<button type="button" class="btn btn-outline-secondary" disabled><i class="bi-arrow-down text-center"></i></button>';
		echo '   ' . $navigation['navigation_order_id'] . '   ';
		echo '<button type="button" class="btn btn-outline-secondary"><i class="bi-arrow-up"></i></button>';
		echo '</th>';
		
		echo '<td>' . $navigation['navigation_name'] . '</td>';
		echo '<td class="fst-italic">' . $Nav->getNameOfNavId($navigation['navigation_parent_id']) . '</td>';
		echo '<td>' . $navigation['navigation_connection_type'] . '</td>';
		echo '<td>' . $navigation['navigation_connection_id'] . '</td>';
		echo '<td>' . $navigation['navigation_route'] . '</td>';
		echo '<td><button type="button" class="btn btn-dark">Edit</button></td>';
		echo '<td><button type="button" class="btn btn-danger">Delete</button></td>';
		
		echo '</tr>';
}
*/
?>


	</tbody>
</table>

<main class="form-signin w-50 m-auto">
	<button class="w-100 btn btn-lg btn-primary" type="button" onclick="document.location='<?= ROOT_PATH . '/navigation/create' ?>'">Create new</button>
</main>