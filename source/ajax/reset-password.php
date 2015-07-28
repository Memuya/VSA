<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

if(!Login::check("admin"))
	Utility::redirect();

$user = new User;

echo $user->recoverPassword(
	$_POST['email'],
	"Password has been reset. An email has been sent to the user to change their password."
);