<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

if(!Login::check("admin"))
	Utility::redirect();

//validate information
if(empty($_POST["message"]))
	Errors::add("Messsage cannot be blank");
else if(empty($_POST['override']))
	Errors::add("How would you like to save the update?");
else {
	if($_POST['override'] == '2') {
		//create new policy
		$q = DB::$db->prepare("
			INSERT INTO privacy_policy (body, date)
			VALUES (:body, UNIX_TIMESTAMP(NOW()))
		");
		//run the query
		$q->execute([':body' => $_POST['message']]);
	} else {
		//update the current policy
		$q = DB::$db->prepare("
			UPDATE privacy_policy
			SET body = :body,
			date = UNIX_TIMESTAMP(NOW())
			WHERE id = :id
		");
		//run the query
		$q->execute([
			':body' => $_POST['message'],
			':id' => $_POST['policy_id']
		]);
	}
}

//display success message
echo Errors::displayErrors("Privacy Policy successfully updated!");