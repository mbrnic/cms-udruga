<?php

include_once (VIEWS_PATH . '/layouts/header.php');
?>



<div class="flex-shrink-0 p-3" style="width: 280px;">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-body-emphasis text-decoration-none border-bottom">
      <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
      <span class="fs-5 fw-semibold">Collapsible</span>
    </a>
    <ul class="list-unstyled ps-0">
	
	
		<li class="mb-1">
			<button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#users-collapse" aria-expanded="false">
				Users
			</button>
			<div class="collapse" id="users-collapse" style="">
				<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
					<li><a href="<?= ROOT_PATH . '/users' ?>" class="link-body-emphasis d-inline-flex text-decoration-none rounded">
						See all</a></li>
				</ul>
			</div>
		</li>
	
		<li class="mb-1">
			<button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#articles-collapse" aria-expanded="false">
				Articles
			</button>
			<div class="collapse" id="articles-collapse" style="">
				<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
					<li><a href="<?= ROOT_PATH . '/article/create' ?>" class="link-body-emphasis d-inline-flex text-decoration-none rounded">
						Create new</a></li>
					<li><a href="<?= ROOT_PATH . '/articles' ?>" class="link-body-emphasis d-inline-flex text-decoration-none rounded">
						See all</a></li>
				</ul>
			</div>
		</li>
	  
		<li class="mb-1">
			<button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#navigations-collapse" aria-expanded="false">
				Navigations
			</button>
			<div class="collapse" id="navigations-collapse" style="">
				<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
					<li><a href="<?= ROOT_PATH . '/navigation/create' ?>" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Create new</a></li>
					<li><a href="<?= ROOT_PATH . '/navigations' ?>" class="link-body-emphasis d-inline-flex text-decoration-none rounded">See all</a></li>
				</ul>
			</div>
		</li>
	
		<li class="border-top my-3"></li>
		<li class="mb-1">
			<button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
				Account
			</button>
			<div class="collapse" id="account-collapse" style="">
				<ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
					<li><a href="<?= ROOT_PATH . '/user/update' ?>" class="link-dark d-inline-flex text-decoration-none rounded">Profile</a></li>
					<li><a href="<?= ROOT_PATH . '/user/logout' ?>" class="link-dark d-inline-flex text-decoration-none rounded">Log out</a></li>
				</ul>
			</div>
		</li>
	</ul>
</div>