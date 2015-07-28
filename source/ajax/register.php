<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

$type = (!empty($_POST['type'])) ? $_POST['type'] : null;

$register = new Register(
	$_POST['username'],
	$_POST['password'],
	$_POST['r_password'],
	$type,
	$_POST['company'],
	$_POST['title'],
	$_POST['fname'],
	$_POST['lname'],
	$_POST['address'],
	$_POST['suburb'],
	$_POST['state'],
	$_POST['postcode'],
	$_POST['country'],
	$_POST['phone'],
	$_POST['email'],
	$_POST['website'],
	$_POST['fax']
);

echo $register->user();