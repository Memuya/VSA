<?php
class User extends Pagination {
	private $data;
	private $count;

	/**
	* Returns a username
	* 
	* @param int $id
	*/
	public static function getUsername($id) {
		try {
			$q = DB::$db->prepare("
				SELECT username
				FROM users
				WHERE id = :id
			");

			$q->execute([':id' => $id]);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$c = $q->rowCount();
		$r = $q->fetch(PDO::FETCH_OBJ);

		return ($c != 0) ? $r->username : "Unknown";
	}

	/**
	* Returns all fields in the users table
	*
	*/
	/*
	public function getAll() {
		$q = DB::$db->query("
			SELECT *
			FROM users
		") or die(SQL_ERROR);

		$this->count = $q->rowCount();

		if($this->count != 0)
			while($r = $q->fetch(PDO::FETCH_OBJ))
				$this->data[] = $r;

		return $this->data;
	}
	*/

	/**
	* Returns all fields in the users table
	*
	*/
	public function getAll($page = 1, $limit = 100) {
		$this->amount = ($page - 1) * $limit;
		$this->limit = $limit;
		$this->page = $page;

		try {
			$q = DB::$db->query("
				SELECT SQL_CALC_FOUND_ROWS *
				FROM users
				LIMIT {$this->amount}, {$this->limit}
			");
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$this->count = $q->rowCount();

		$start = ($this->page > 1) ? ($this->page * $this->limit) - $this->limit : 0;
		$total = DB::$db->query("SELECT FOUND_ROWS() AS total")->fetch(PDO::FETCH_OBJ)->total;
		$this->pages = ceil($total / $this->limit);

		if($this->count != 0)
			while($r = $q->fetch(PDO::FETCH_OBJ))
				$this->data[] = $r;

		return $this->data;
	}

	/**
	* Returns all fields for a specific user
	*
	* @param int $id
	*/
	public function get($id) {
		$id = (int)$id;

		try {
			$q = DB::$db->prepare("
				SELECT *, users.id
				FROM users
				INNER JOIN membership_types
				ON membership_types.id = users.type
				WHERE users.id = :id
			");

			$q->execute([':id' => $id]);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$this->count = $q->rowCount();
		$r = $q->fetch(PDO::FETCH_OBJ);

		$this->data = $r;

		return $this->data;
	}

	/**
	* Search for a user via their username or ID
	*
	* @param string $string
	*/
	public function search($string) {
		if(!empty($string)) {
			//check if string is a username
			if(!is_numeric($string)) {
				try {
					$q = DB::$db->prepare("
						SELECT *, users.id
						FROM users
						INNER JOIN membership_types
						ON membership_types.id = users.type
						WHERE MATCH(users.username) AGAINST(:string IN BOOLEAN MODE)
						OR users.username LIKE :second_string
					");

					$q->execute([
						':string' => $string.'*',
						':second_string' => '%'.$string.'%'
					]);
				} catch(PDOException $ex) {
					die($ex->getMessage());
				}
			} else {
				$id = (int)$string;

				try {
					$q = DB::$db->prepare("
						SELECT *, users.id
						FROM users
						INNER JOIN membership_types
						ON membership_types.id = users.type
						WHERE users.id = :id
					");

					$q->execute([':id' => $id]);
				} catch(PDOException $ex) {
					die($ex->getMessage());
				}
			}

			$this->count = $q->rowCount();

			if($this->count != 0)
				while ($r = $q->fetch(PDO::FETCH_OBJ))
					$this->data[] = $r;
				
			return $this->data;
		}
	}

	/**
	* Search for a user via their username
	*
	* @param string $string
	*/
	public function searchAJAX($string) {
		$q = DB::$db->prepare("
			SELECT *, users.id
			FROM users
			INNER JOIN membership_types
			ON membership_types.id = users.type
			WHERE users.username LIKE :string
		") or die(SQL_ERROR);

		$q->execute([':string' => '%'.$string.'%']);

		$this->count = $q->rowCount();
		$output = null;
		if($this->count != 0) {
			$output .= "<table>";
			while ($r = $q->fetch(PDO::FETCH_OBJ)) {
				$output .= "
						<tr>
							<td>".$r->username."</td>
						</tr>
				";
			}
			$output .= "</table>";
		}
			
		return $output;
	}

	/**
	* Update user account information
	*
	* @param int $id
	* @param string $username
	* @param string $title
	* @param string $fname
	* @param string $lname
	* @param string $email
	* @param string $address
	* @param string $suburb
	* @param string $state
	* @param string $postcode
	* @param string $country
	* @param string $telephone
	* @param string $company
	* @param string $website
	* @param string $fax
	* @param string $blocked
	* @param string $type
	* @param string $active
	* @param string $level
	* @param string $payment_made
	*/
	public function edit($id, $username, $title, $fname, $lname, $email, $address, $suburb, $state, $postcode, $country, $telephone, $company, $website, $fax, $blocked, $type, $active, $level, $payment_made, $new_expire_date) {
		$id = (int)$id;
		$username = Validate::post($username);
		$title = Validate::post($title);
		$fname = Validate::post($fname);
		$lname = Validate::post($lname);
		$address = Validate::post($address);
		$suburb = Validate::post($suburb);
		$state = Validate::post($state);
		$postcode = Validate::post($postcode);
		$country = Validate::post($country);
		$telephone = Validate::post($telephone);
		$company = Validate::post($company);
		$website = Validate::post($website);
		$fax = Validate::post($fax);
		$email = Validate::post($email);
		$type = Validate::post($type);
		$payment_made = Validate::post($payment_made);
		$new_expire_date = (!empty($new_expire_date)) ? strtotime($new_expire_date) : null;

		if(empty($id) || empty($username) || empty($fname) || empty($lname) || empty($email) || empty($address) || empty($suburb) || empty($state) || empty($postcode) || empty($country) || empty($telephone)) {
			Errors::add("All fields are required");
		} else {
			//check to see if the username is already in-use
			try {
				$user_q = DB::$db->prepare("
					SELECT username
					FROM users
					WHERE username = :username
					AND id != :id
				");

				$user_q->execute([
					':id' => $id,
					':username' => $username
				]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}
			$user_c = $user_q->rowCount();

			//check to see if the email address is already in-use
			try {
				$email_q = DB::$db->prepare("
					SELECT email
					FROM users
					WHERE email = :email
					AND id != :id
				");

				$email_q->execute([
					':id' => $id,
					':email' => $email
				]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}
			$email_c = $email_q->rowCount();

			//validate $blocked
			switch ($blocked) {
				case '0':
					break;
				case '1':
					break;
				default:
					Errors::add("An error has occured [Blocked not set properly]");
					break;
			}

			//validate $type
			switch ($type) {
				case '1':
					break;
				case '2':
					break;
				case '3':
					break;
				case '4':
					break;
				default:
					Errors::add("An error has occured [Membership Type not set properly]");
					break;
			}

			//validate $active
			switch ($active) {
				case '0':
					break;
				case '1':
					break;
				default:
					Errors::add("An error has occured [Active not set properly]");
					break;
			}

			//validate $level
			switch ($level) {
				case '1':
					break;
				case '2':
					break;
				default:
					Errors::add("An error has occured [Access Level not set properly]");
					break;
			}

			//validate username
			if(strlen($username) > 20 || strlen($username) < 3)
				Errors::add("Username must be between 3 and 20 characters long");
			else if(preg_match('/\s/', $username) || !ctype_alnum($username) || !preg_match('/[A-Za-z]/', $username))
				Errors::add("No spaces or special characters allowed in username");
			else if($user_c != 0)
				Errors::add("That username is already taken");

			//validate email address
			if(strlen($email) > 100)
				Errors::add("Email address must be 100 characters or less");
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				Errors::add("Email address is not valid");
			else if(!preg_match("^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$^", $email))
				Errors::add("Email addres not valid");
			else if($email_c != 0)
				Errors::add("That email address is already in-use");

			if(strlen($fname) > 30)
				Errors::add("First Name must be 30 characters or less");

			if(strlen($lname) > 40)
				Errors::add("Last Name must be 40 characters or less");

			if(strlen($address) > 80)
				Errors::add("Address must be 80 characters or less");

			if(strlen($suburb) > 50)
				Errors::add("Suburb must be 50 characters or less");

			if(strlen($state) > 50)
				Errors::add("State must be 50 characters or less");

			if(strlen($postcode) > 10)
				Errors::add("Postcode must be 10 characters or less");

			if(strlen($country) > 50)
				Errors::add("Country must be 50 characters or less");

			if(strlen($telephone) > 20)
				Errors::add("Telephone must be 20 characters or less");

			if(strlen($fax) > 20)
				Errors::add("First Name must be 30 characters or less");

			//get type of membership of the user to validate below
			$q = DB::$db->prepare("SELECT type FROM users WHERE id = :id");
			$q->execute([':id' => $id]);
			$r = $q->fetch(PDO::FETCH_OBJ);

			//validate website and fax
			if($r->type == '3') {
				if(empty($company))
					Errors::add("Company name is required for corporate members");
				if(empty($website) || !filter_var($website, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED))
					Errors::add("The Website URL must start with \"<b>http://</b>\"");

				if(empty($fax))
					Errors::add("A fax number is required");
			}

			if(!Errors::hasErrors()) {
				try {
					//prepare query
					$insert = DB::$db->prepare("
						UPDATE users
						SET username = :username, 
						title = :title, 
						fname = :fname, 
						lname = :lname, 
						email = :email, 
						address = :address, 
						suburb = :suburb, 
						state = :state, 
						postcode = :postcode, 
						country = :country, 
						telephone = :telephone, 
						website = :website, 
						fax = :fax, 
						company = :company, 
						blocked = :blocked, 
						type = :type, 
						active = :active, 
						level = :level,
						payment_made = :payment_made
						WHERE id = :id
					");

					//execute query
					$insert->execute([
						':username' => $username,
						':title' => $title,
						':fname' => $fname,
						':lname' => $lname,
						':email' => $email,
						':address' => $address,
						':suburb' => $suburb,
						':state' => $state,
						':postcode' => $postcode,
						':country' => $country,
						':telephone' => $telephone,
						':website' => $website,
						':fax' => $fax,
						':company' => $company,
						':blocked' => $blocked,
						':type' => $type,
						':active' => $active,
						':level' => $level,
						':payment_made' => $payment_made,
						':id' => $id
					]);

					//update membership expiry date if needed
					if(!empty($new_expire_date)) {
						$q = DB::$db->prepare("
							UPDATE users
							SET membership_expiry_date = :date
							WHERE id = :id
						");
						$q->execute([
							':date' => $new_expire_date,
							':id' => $id
						]);
					}
				} catch(PDOException $ex) {
					die($ex->getMessage());
				}
			}
		}

		return Errors::displayErrors("Details have been successfully updated!");
	}

	/**
	* Recover account password by sending an email with a reset link
	* The text argument is used to display a different success message (used when an admin resets a users password from the control panel)
	*
	* @param string $info
	* @param string $text
	*/
	public function recoverPassword($info, $text = null) {
		$info = Validate::post($info);
		$reset_code = sha1(uniqid(true));

		//check if email address
		if((strpos($info, '@')) && filter_var($info, FILTER_VALIDATE_EMAIL)) {
			try {
				$q = DB::$db->prepare("
					SELECT id, email
					FROM users
					WHERE email = :info
				");

				$q->execute([':info' => $info]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}

			$c = $q->rowCount();

			if($c == 0)
				Errors::add("This email address does not exist");
			else {
				$r = $q->fetch(PDO::FETCH_OBJ);

				try {
					$q = DB::$db->prepare("
						UPDATE users
						SET password_reset = '1',
						reset_code = :reset_code
						WHERE id = :id
					");

					$q->execute([
						':reset_code' => $reset_code,
						':id' => $r->id
					]);
				} catch(PDOException $ex) {
					die($ex->getMessage());
				}

				$message  = "Please follow the link below to recover your password:\r\n\r\n";
				$message .= PATH."reset-password?id=".$r->id."&code=".$reset_code;
				$message .= "\r\n\r\nIf you did not request a password reset, please disregard this email.";

				mail($r->email, "Recover VSA Password", $message);
			}
			
		//check if username
		} else {
			try {
				$q = DB::$db->prepare("
					SELECT id, email
					FROM users
					WHERE username = :info
				");

				$q->execute([':info' => $info]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}

			$c = $q->rowCount();

			if($c == 0)
				Errors::add("This username does not exist");
			else {
				$r = $q->fetch(PDO::FETCH_OBJ);

				try {
					$q = DB::$db->prepare("
						UPDATE users
						SET password_reset = '1',
						reset_code = :reset_code
						WHERE id = :id
					");

					$q->execute([
						':reset_code' => $reset_code,
						':id' => $r->id
					]);
				} catch(PDOException $ex) {
					die($ex->getMessage());
				}

				$message  = "Please follow the link below to recover your password:"."\r\n\r\n";
				$message .= PATH."reset-password?id=".$r->id."&code=".$reset_code;
				$message .= "\r\n\r\n"."If you did not request a password reset, please disregard this email.";

				mail($r->email, "Recover VSA Password", $message);
			}
		}

		//set success message
		$text = (!empty($text)) ? $text : "Please check your email address for a link to reset your password.";

		return Errors::displayErrors($text);
	}

	/**
	* Reset a users password
	*
	* @param id $id
	* @param string $reset_code
	* @param string $password
	* @param string $r_password
	*/
	public function resetPassword($id, $reset_code, $password, $r_password) {
		$id = (int)$id;
		$reset_code = Validate::post($reset_code);
		$password = Validate::post($password);
		$r_password = Validate::post($r_password);

		if(empty($id) || empty($reset_code))
			Errors::add("The URL provided is not valid. Please find the link previously sent to your email address.");
		else {
			try {
				$q = DB::$db->prepare("
					SELECT id
					FROM users
					WHERE id = :id
					AND reset_code = :reset_code
					AND password_reset = '1'
				");

				$q->execute([
					':id' => $id,
					':reset_code' => $reset_code
				]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}

			$c = $q->rowCount();

			if($c == 0)
				Errors::add("The link you have followed is not valid or has expired. <a href=\"".PATH."forgot-password\">Recover your password again here.</a>");
			else {
				if(empty($password) || empty($r_password))
					Errors::add("All fields are required");
				else if($r_password != $password)
					Errors::add("Passwords do not match");
				else {
					$hash_pass = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
					$r = $q->fetch(PDO::FETCH_OBJ);

					try {
						$update = DB::$db->prepare("
							UPDATE users
							SET password = :password,
							password_reset = '0',
							reset_code = ''
							WHERE id = :id
						");

						$update->execute([
							':password' => $hash_pass,
							':id' => $r->id
						]);
					} catch(PDOException $ex) {
						die($ex->getMessage());
					}
				}
			}
		}

		return Errors::displayErrors("Password has been successfully reset!");
	}

	/**
	* Update the password for a specific user
	* Used in the account page
	*
	* @param int $id
	* @param string $password
	* @param string $new_password
	* @param string $repeat_password
	*/
	public function changePassword($id, $password, $new_password, $repeat_password) {
		$id = (int)$id;
		$password = Validate::post($password);
		$new_password = Validate::post($new_password);
		$repeat_password = Validate::post($repeat_password);

		if(empty($id) || empty($password) || empty($new_password) || empty($repeat_password))
			Errors::add("All fields are required");
		else {
			//get current password info
			try {
				$q = DB::$db->prepare("
					SELECT id, password
					FROM users
					WHERE id = :id
				");
				$q->execute([':id' => $id]);

				$c = $q->rowCount();
				$r = $q->fetch(PDO::FETCH_OBJ);
			} catch(PDOException $ex) {
				Errors::add($ex->getMessage());
			}

			

			if(!password_verify($password, $r->password))
				Errors::add("Your current password is incorrect");
			else if($new_password !== $repeat_password)
				Errors::add("Your new passwords do not match");
			else {
				//update password
				try {
					$q = DB::$db->prepare("
						UPDATE users
						SET password = :password
						WHERE id = :id
					");
					$q->execute([
						':password' => password_hash($new_password, PASSWORD_BCRYPT, ['cost' => 10]),
						':id' => $id
					]);
				} catch(PDOException $ex) {
					Errors::add($ex->getMessage());
				}
			}
		}

		return Errors::displayErrors("Your password has been successfully changed!");
	}

	/**
	* Delete a users account
	*
	* @param ing $id
	*/
	public function delete($id) {
		try {
			$q = DB::$db->prepare("
				SELECT id, type
				FROM users
				WHERE id = :id
			");
			$q->execute([':id' => $id]);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}
		
		$c = $q->rowCount();
		$r = $q->fetch(PDO::FETCH_OBJ);

		if($c == 0)
			Errors::add("The user you are trying to delete does not exist");
		else {
			try {
				//delete enrolments
				$q = DB::$db->prepare("DELETE FROM enrolments WHERE user_id = :id");
				$q->execute([':id' => $id]);

				if($r->type === '3') {
					//unlink image from directory if user is a corporate member
					$get_ads = DB::$db->prepare("SELECT * FROM ads WHERE user_id = :id");
					$get_ads->execute([':id' => $id]);
					$count_ads = $get_ads->rowCount();
					if($count_ads !== 0) {
						while($r = $get_ads->fetch(PDO::FETCH_OBJ))
							unlink("../img/sponsors/".$r->id.".".$r->img_ext);
					}

					//delete ads from database
					$q = DB::$db->prepare("DELETE FROM ads WHERE user_id = :id");
					$q->execute([':id' => $id]);
				}

				//delete user
				$q = DB::$db->prepare("DELETE FROM users WHERE id = :id");

				$q->execute([':id' => $id]);
			} catch(PDOException $ex) {
				Errors::add($ex->getMessage());
			}
		}

		return Errors::displayErrors("User successfully deleted!");
	}

	/**
	* Returns the amount of rows returned from getAll() method
	*
	*/
	public function getCount() {
		return $this->count;
	}
}