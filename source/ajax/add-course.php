<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

if(!Login::check("admin"))
	Utility::redirect();

$courses = new Courses;

echo $courses->add(
	$_POST["code"],
	$_POST["name"],
	$_POST["duration"],
	$_POST["when"],
	$_POST["time"],
	$_POST["where"],
	$_POST["price"]
);