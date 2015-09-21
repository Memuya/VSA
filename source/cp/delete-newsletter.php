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
	$newsletters = new Newsletters;
	$id = (int)$_GET['id'];
	$newsletters->delete($id);

	//redirect
	Utility::prevPage();
} else {
	//redirect if no ID is set
	Utility::prevPage();
}
	