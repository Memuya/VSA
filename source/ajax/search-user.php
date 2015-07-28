<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

/*
if(!Login::check("admin"))
	Utility::redirect();
	*/

$user = new User;

echo json_encode($user->search($_POST["search"]));