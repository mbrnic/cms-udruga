<?php

require_once(LIBS_PATH . 'phprouter/router.php');
require_once(CONTROLLERS_PATH . 'NavigationController.php');
use Controllers\NavigationController;


$Nav = new NavigationController;


get(ROOT_PATH . '/nav/$route', function($route){
	global $Nav;
	$Nav->readRoutes($route);
});


get(ROOT_PATH . '', VIEWS_PATH . 'index.view');

get(ROOT_PATH . '/dashboard', VIEWS_PATH . 'layouts/dashboard');


get(ROOT_PATH . '/articles', VIEWS_PATH . 'articles');

get(ROOT_PATH . '/article/create', VIEWS_PATH . 'article.create');
post(ROOT_PATH . '/article/create', VIEWS_PATH . 'article.create');

get(ROOT_PATH . '/article/update/$id', VIEWS_PATH . 'article.update');
post(ROOT_PATH . '/article/update/$id', VIEWS_PATH . 'article.update');

get(ROOT_PATH . '/article/delete/$id', VIEWS_PATH . 'article.delete');
get(ROOT_PATH . '/article/yes/delete/$id', VIEWS_PATH . 'article.yes.delete');

get(ROOT_PATH . '/article/$article_route', VIEWS_PATH . 'article.view');
get(ROOT_PATH . '/article/id/$article_id', VIEWS_PATH . 'article.view');


get(ROOT_PATH . '/user/register', VIEWS_PATH . 'user.register');
post(ROOT_PATH . '/user/register', VIEWS_PATH . 'user.register');

get(ROOT_PATH . '/user/login', VIEWS_PATH . 'user.login');
post(ROOT_PATH . '/user/login', VIEWS_PATH . 'user.login');

get(ROOT_PATH . '/user/logout', VIEWS_PATH . 'user.logout');

get(ROOT_PATH . '/users', VIEWS_PATH . 'users');

get(ROOT_PATH . '/user/roles/$id', VIEWS_PATH . 'user.roles');
post(ROOT_PATH . '/user/roles/$id', VIEWS_PATH . 'user.roles');

//get(ROOT_PATH . '/user/update/$id', VIEWS_PATH . 'user.update');
//post(ROOT_PATH . '/user/update/$id', VIEWS_PATH . 'user.update');

get(ROOT_PATH . '/user/update', VIEWS_PATH . 'user.update');
post(ROOT_PATH . '/user/update', VIEWS_PATH . 'user.update');

get(ROOT_PATH . '/user/delete', VIEWS_PATH . 'user.delete');
get(ROOT_PATH . '/user/yes/delete', VIEWS_PATH . 'user.yes.delete');


get(ROOT_PATH . '/navigations', VIEWS_PATH . 'navigations');
get(ROOT_PATH . '/navigations/switch/$id1/$id2', VIEWS_PATH . 'navigations.switch');

get(ROOT_PATH . '/navigation/create', VIEWS_PATH . 'navigation.create');
post(ROOT_PATH . '/navigation/create', VIEWS_PATH . 'navigation.create');

get(ROOT_PATH . '/navigation/update/$id', VIEWS_PATH . 'navigation.update');
post(ROOT_PATH . '/navigation/update/$id', VIEWS_PATH . 'navigation.update');

get(ROOT_PATH . '/navigation/delete/$id', VIEWS_PATH . 'navigation.delete');
get(ROOT_PATH . '/navigation/yes/delete/$id', VIEWS_PATH . 'navigation.yes.delete');

//post(ROOT_PATH . '/navigation', VIEWS_PATH . 'user.update');

any('/404','views/404.php');


?>
