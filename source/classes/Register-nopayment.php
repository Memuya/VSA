<?php
class Register {
	private $username, $password, $r_password, $type, $company, $title, $fname, $lname, $address, $suburb, $state, $postcode, $country, $telephone, $email, $website, $fax;

	/**
	* Validate variables in the constructor
	* 
	* @param string $username
	* @param string $password
	* @param string $r_password
	* @param string $type
	* @param string $company
	* @param string $title
	* @param string $fname
	* @param string $lname
	* @param string $address
	* @param string $suburb
	* @param string $state
	* @param string $postcode
	* @param string $country
	* @param string $telephone
	* @param string $email
	* @param string $website
	* @param string $fax
	*/
	public function __construct($username, $password, $r_password, $type, $company, $title, $fname, $lname, $address, $suburb, $state, $postcode, $country, $telephone, $email, $website, $fax) {
		$this->username = Validate::post($username);
		$this->password = Validate::post($password);
		$this->r_password = Validate::post($r_password);
		$this->type = Validate::post($type);
		$this->company = Validate::post($company);
		$this->title = Validate::post($title);
		$this->fname = Validate::post($fname);
		$this->lname = Validate::post($lname);
		$this->address = Validate::post($address);
		$this->suburb = Validate::post($suburb);
		$this->state = Validate::post($state);
		$this->postcode = Validate::post($postcode);
		$this->country = Validate::post($country);
		$this->telephone = Validate::post($telephone);
		$this->email = Validate::post($email);
		$this->website = Validate::post($website);
		$this->fax = Validate::post($fax);
	}


	/**
	* Registers a user
	*/
	public function user() {
		if(empty($this->username) || empty($this->password) || empty($this->r_password) || empty($this->fname) || empty($this->lname) || empty($this->address) || empty($this->suburb) || empty($this->postcode) || empty($this->country) || empty($this->telephone) || empty($this->email))
			Errors::add("Marked fields are required and must be valid");
		else {

			//validate company input only if corportate membership is selected
			if($this->type === "corporate" && empty($this->company))
				Errors::add("Please provide a Institude/Company name as you have selected the 'Corporate' membership type");

			//validate website input only if corportate membership is selected
			if($this->type === "corporate" && empty($this->website))
				Errors::add("Please provide a Website URL as you have selected the 'Corporate' membership type");

			//validate fax input only if corportate membership is selected
			if($this->type === "corporate" && empty($this->fax))
				Errors::add("Please provide a Fax Number as you have selected the 'Corporate' membership type");

			//validate username
			Validate::username($this->username);

			//validate name
			Validate::fname($this->fname);
			Validate::lname($this->lname);

			//validate password
			if($this->r_password != $this->password)
				Errors::add("Your passwords do not match");

			//validate email address
			Validate::email($this->email);

			//validate membership
			switch($this->type) {
				case "student":
					$type_num = 1;
					break;
				case "general":
					$type_num = 2;
					break;
				case "corporate":
					$type_num = 3;
					break;
				default:
					Errors::add("The type of membership you have selected is not valid");
					break;
			}

			//validate recaptcha
       		if(!empty($_POST['g-recaptcha-response'])) {
   				//get the recaptcha field
				$recaptcha = $_POST['g-recaptcha-response'];
				//secret key given by Google
				$secret = '6LekSwoTAAAAALHhOyzoLOd2sp489U_Zbxabf6GF';
				//validate via Google. Returns a json array
				$response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptcha), true);

				//display error message if recaptcha did not vailidate
				if(!$response['success'])
					Errors::add("Recaptcha required");
       		} else {
       			Errors::add("Recaptcha required");
       		}

			//if no errors has been added, continue the registration
			if(Errors::hasErrors() == 0) {

				//hash the password
				$hash_pass = password_hash($this->password, PASSWORD_BCRYPT, ['cost' => 10]);
				$activation_code = sha1(uniqid(true));

				//prepare query
				$insert = DB::$db->prepare("
					INSERT INTO users (username, password, email, title, fname, lname, address, suburb, state, postcode, country, telephone, fax, website, company, blocked, type, activation_code, active, level, payment_made, date_created, payment_due_date) 
					VALUES (:username, :password, :email, :title, :fname, :lname, :address, :suburb, :state, :postcode, :country, :telephone, :fax, :website, :company, '0', :type, :activation_code, '1', '2', '0', UNIX_TIMESTAMP(), UNIX_TIMESTAMP(DATE_ADD(NOW(), INTERVAL 31 DAY)))
				") or die(SQL_ERROR);

				//execute query
				$insert->execute([
					':username' => $this->username,
					':password' => $hash_pass,
					':email' => $this->email,
					':title' => $this->title,
					':fname' => $this->fname,
					':lname' => $this->lname,
					':address' => $this->address,
					':suburb' => $this->suburb,
					':state' => $this->state,
					':postcode' => $this->postcode,
					':country' => $this->country,
					':telephone' => $this->telephone,
					':fax' => $this->fax,
					':website' => $this->website,
					':company' => $this->company,
					':type' => $type_num,
					':activation_code' => $activation_code
				]);

				$user_id = DB::$db->lastInsertId();

				//send an email with activation code and change success message below to reflex this
				$message  = "Dear ".$this->title." ".$this->fname." ".$this->lname.", \r\n\r\n";
				$message .= "Please use the link below to activate your account:\r\n";
				$message .= PATH."activate?id=".$user_id."&code=".$activation_code;
				mail($this->email, "Activate your VSA account!", $message);
			}

		}

		//display error or success message
		return Errors::displayErrors("Congratulations! You have successfully registered an account!");
	}
}