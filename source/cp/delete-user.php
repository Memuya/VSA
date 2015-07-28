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
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
	$user = new User;
	$id = (int)$_GET['id'];
	$user->delete($id);

	//redirect
	//NOTE: Utility::redirect() does not work for some reason
	header("Location: ".PATH."cp/users");
	die();
} else {
	//redirect if no ID is set
	header("Location: ".PATH."cp/users");
	die();
}
	