<?php

//učitano kod routes.php
//require_once(CONTROLLERS_PATH . 'NavigationController.php');
use Controllers\NavigationController;

//NAV je napravljen u routes.php
//$Nav = new NavigationController;
global $Nav;


$headerNavData = $Nav->readAllNav();
?>



<nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">

	<div class="container-fluid">
		<a class="navbar-brand" href="<?= ROOT_PATH ?>">CMS Udruga</a>
		<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="navbar-collapse collapse" id="navbarsExample04" style="">
			<ul class="navbar-nav me-auto mb-2 mb-md-0">
			
			
<?php

foreach ($headerNavData as $parent) {
	
	if ( $Nav->isParent($headerNavData, $parent['navigation_id']) ) {
		
		echo '<li class="nav-item dropdown">';
		echo '<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">' . $parent['navigation_name'] . '</a>';
		echo '<ul class="dropdown-menu">';
		
		foreach ($headerNavData as $child) {
		
			if ( $child['navigation_parent_id'] == $parent['navigation_id'] ) {
			
				echo '<li><a class="dropdown-item" href="' . ROOT_PATH . '/nav/' . $child['navigation_route'] . '">' . $child['navigation_name'] . '</a></li>';
			
			}
		
		}
		
		echo '</ul>';
		echo '</li>';
		
	} else {
	
		if ( $parent['navigation_parent_id'] == 0 ) {
	
			echo '<li class="nav-item">';
			echo '<a class="nav-link" href="' . ROOT_PATH . '/nav/' . $parent['navigation_route'] . '">' . $parent['navigation_name'] . '</a>';
			echo '</li>';
			
		}
	
	}
	
}

?>			
			</ul>

<?php if (!isset($_SESSION['user_id'])): ?>
			<button class="btn btn-dark btn-outline-light rounded-pill px-3" type="button" onclick="document.location='<?= ROOT_PATH . '/user/login' ?>'">Log in</button>
<?php else: ?>
			<button class="btn btn-warning btn-outline-light rounded-pill px-3" type="button" onclick="document.location='<?= ROOT_PATH . '/dashboard' ?>'">Dashboard</button>
<?php endif ?>


		</div>
		
	</div>
	
</nav>