<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

if(!Login::loggedIn())
	Utility::redirect();

$user = new User;

echo $user->changePassword(
	$_SESSION['logged'],
	$_POST['current_pass'],
	$_POST['new_pass'],
	$_POST['repeat_pass']
);