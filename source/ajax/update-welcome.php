<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

if(!Login::check("admin"))
	Utility::redirect();

if(empty($_POST['message']))
	Errors::add("Messsage cannot be blank");
else {
	//preapre the updated message
	$q = DB::$db->prepare("
		UPDATE welcome_message 
		SET body = :body
		WHERE id = 1
	");

	//run the query
	$q->execute([':body' => $_POST['message']]);
}

//display message
echo Errors::displayErrors("Welcome message successfully updated!");