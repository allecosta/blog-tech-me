<?php

$action = $_GET['action'];

include 'Action.php';

$crud = new Action();

if ($action == 'login') {
	$login = $crud->login();

	if ($login)
		echo $login;
}

if ($action == 'logout') {
	$logout = $crud->logout();

	if ($logout)
		echo $logout;
}

if ($action == 'save_settings') {
	$save = $crud->saveSettings();

	if ($save)
		echo $save;
}

if ($action == 'save_category') {
	$save = $crud->saveCategory();

	if ($save)
		echo $save;
}

if ($action == 'load_category') {
	$list = $crud->loadCategory();

	if ($list)
		echo $list;
}

if ($action == 'load_post') {
	$list = $crud->loadPost();

	if ($list)
		echo $list;
}

if ($action == 'remove_category'){
	$remove = $crud->removeCategory();

	if ($remove)
		echo $remove;
}

if ($action == 'publish_post') {
	$published = $crud->publishPost();

	if ($published)
		echo $published;
}

if ($action == 'remove_post') {
	$remove = $crud->removePost();

	if ($remove)
		echo $remove;
}

if ($action == 'save_post'){
	$save = $crud->savePost();

	if ($save)
		echo $save;
}