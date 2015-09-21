<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template;

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect();


//check if ID is set in the URL
if((isset($_GET['id']) && is_numeric($_GET['id'])) && (isset($_GET['status']))) {
	$courses = new Courses;
	$id = (int)$_GET['id'];
	$status = $_GET['status'];

	$courses->changeEnrolmentStatus($id, $status);

	//redirect
	header("Location: ".PREV_PAGE);
	die();
} else {
	//redirect if no ID is set
	header("Location: ".PATH."cp/users");
	die();
}
	