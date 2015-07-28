<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

$name = Validate::post($_POST["name"]);
$email = Validate::post($_POST["email"]);
$subject = Validate::post($_POST["subject"]);
$message = Validate::post($_POST["message"]);

if(empty($name) || empty($email) || empty($subject) || empty($message))
	Errors::add("All fields are required");
else {
	//validate email
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		Errors::add("Email address is not valid");
	else if(!preg_match("^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$^", $email))
		Errors::add("Email addres not valid");
	else {
		//send email
		if(!mail("support@vaccumsociety.org.au", $subject, Validate::output($message)))
			Errors::add("Email could not be sent. Please try again later.");
	}
}

echo Errors::displayErrors("Your message has been successfully sent. You will recieve a reply ASAP!");