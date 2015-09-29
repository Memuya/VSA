<?php
class Validate {
	private static $info = [
		'fname' => [
			'min' => 3,
			'max' => 30
		],
		'lname' => [
			'min' => 3,
			'max' => 40
		],
		'username' => [
			'min' => 3,
			'max' => 20
		],
		'email' => [
			'max' => 100
		]
	];
	/**
	* Validates a post from a form
	*
	* @param string $input
	*/
	public static function post($input) {
		return htmlentities(trim($input), ENT_COMPAT);
	}

	/**
	* Validates a post from a form (used in control panel)
	*
	* @param string $input
	*/
	public function cp($input) {
		return trim($input);
	}

	/**
	* Outputs strings that have already been validated
	* Fixes the output by allowing quotes and slashes to not break the page
	*
	* @param string $input
	*/
	public static function output($input) {
		return htmlentities(($input), ENT_COMPAT, "UTF-8");
		
		//stripslashes not needed with PDO?
		//return htmlentities(stripcslashes($input), ENT_COMPAT, "UTF-8");
	}

	/**
	* Validate username input fields
	*
	* @param string $username
	* @param int $check_db
	*/
	public static function username($username, $check_db = 1) {
		//check to see if the email address is already in-use
		if($check_db === 1) {
			//check to see if the username is already in-use
			try {
				$user_q = DB::$db->prepare("
					SELECT username
					FROM users
					WHERE username = :username
				") or die(SQL_ERROR);
				$user_q->execute([':username' => $username]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}
			$user_c = $user_q->rowCount();
		}

		if(strlen($username) > self::$info['username']['max'] || strlen($username) < self::$info['username']['min'])
			Errors::add("Username must be between ".self::$info['username']['min']." and ".self::$info['username']['max']." characters long");
		else if(preg_match('/\s/', $username) || !ctype_alnum($username) || !preg_match('/[A-Za-z]/', $username))
			Errors::add("No spaces or special characters allowed in username");
		else if($check_db === 1 && $user_c != 0)
			Errors::add("That username is already taken");
	}

	/**
	* Validate email input fields
	*
	* @param string $email
	* @param int $check_db
	*/
	public static function email($email, $check_db = 1) {
		//check to see if the email address is already in-use
		if($check_db === 1) {
			try {
				$email_q = DB::$db->prepare("
					SELECT email
					FROM users
					WHERE email = :email
				") or die(SQL_ERROR);
				$email_q->execute([':email' => $email]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}
			
			$email_c = $email_q->rowCount();
		}

		//validate email address
		if(strlen($email) > self::$info['email']['max'])
			Errors::add("Email address must be ".self::$info['email']['max']." characters or less");
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			Errors::add("Email address is not valid");
		else if(!preg_match("^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$^", $email))
			Errors::add("Email addres not valid");
		else if($check_db === 1 && $email_c != 0)
			Errors::add("That email address is already in-use");
	}

	public static function fname($fname) {
		if(strlen($fname) > self::$info['fname']['max'])
			Errors::add("First Name must be ".self::$info['fname']['max']." characters or less");
	}

	public static function lname($lname) {
		if(strlen($lname) > self::$info['lname']['max'])
			Errors::add("Last Name must be ".self::$info['lname']['max']." characters or less");
	}
}