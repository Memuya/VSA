<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

if(!Login::check("admin"))
	Utility::redirect();

$executive = new Executive;

echo $executive->edit(
	$_POST['id'],
	$_POST['position'],
	$_POST['title'],
	$_POST['fname'],
	$_POST['lname'],
	$_POST['organization'],
	$_POST['telephone'],
	$_POST['email']
);