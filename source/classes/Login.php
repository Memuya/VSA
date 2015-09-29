<?php
class Login {
	private $username, $password;

	/**
	* Initializes and validates class varibles
	* 
	* @param string $username
	* @param string $password
	*/
	public function __construct($username, $password) {
		$this->username = Validate::post($username);
		$this->password = Validate::post($password);
	}

	/**
	* Log a user in
	*/
	public function init() {
		if(empty($this->username) || empty($this->password))
			Errors::add("All fields are required");
		else {
			try {
				$q = DB::$db->prepare("
					SELECT id, blocked, type, active, password, level, password_reset, date_created, payment_due_date, payment_made, membership_expiry_date
					FROM users
					WHERE username = :username
				");

				$q->execute([':username' => $this->username]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}

			$c = $q->rowCount();
			$r = $q->fetch(PDO::FETCH_OBJ);

			if($c !== 0) {
				//convert the due date timestamp into a date and pass it through the DateTime object
				$date = new DateTime(date('Y-m-d', ($r->type === '4') ? $r->membership_expiry_date : $r->payment_due_date));
				//get current date information
				$today = new DateTime();
				//get the difference between the 2 dates
				$date_diff = $today->diff($date);
			}

			if($c == 0)
				Errors::add("Username does not exist");
			else if(!password_verify($this->password, $r->password))
				Errors::add("Password is incorrect");
			else {
				if($r->active == 0)
					Errors::add("Your account has not been activated as of yet. Please <a href=\"".PATH."contact\">contact us</a> if you have any questions.");
				else if($r->blocked == 1)
					Errors::add("Your account has been blocked. Please <a href=\"".PATH."contact\">contact us</a> to sort this out.");

				//take care of user payments
				else if($c !== 0)
					if(($r->payment_made === '0') && $date_diff->invert == 1)
						if($r->type === '4')
							Errors::add("Your Course Membership has expired. Please feel free to <a href=\"".PATH."contact\">contact us</a> for any help.");
						else
							Errors::add("Your payment has not been received as of yet. It has been 30 or more days since your account has been created. Once we have received your membership payment, you will be able to log into your account.");
					//check to see if it's been 1 year since payment has been recevied
					else if($r->payment_made === '1' && (date('Y-m-d', $r->membership_expiry_date) < date('Y-m-d')))
						Errors::add("Your membership expired on the ".date('jS M Y', $r->membership_expiry_date).". Please <a href=\"".PATH."contact\">contact us</a> for any questions you may have.");
				else {
					//set login session
					$_SESSION['logged'] = $r->id;

					//set admin session
					if($r->level == '1')
						$_SESSION['admin'] = $r->id;

					//set membership sessions
					if($r->type === '1')
						$_SESSION['student'] = $r->id;
					else if($r->type === '2')
						$_SESSION['general'] = $r->id;
					else if($r->type === '3')
						$_SESSION['corporate'] = $r->id;
					else if($r->type === '4')
						$_SESSION['course_member'] = $r->id;

					//reset password_reset and reset_code in database
					if($r->password_reset == '1') {
						try {
							$q = DB::$db->prepare("
								UPDATE users
								SET password_reset = '0',
								reset_code = ''
								WHERE id = :id
							");

							$q->execute([':id' => $r->id]);
						} catch (PDOException $ex) {
							die($ex->getMessage());
						}
						
					}
					
					//redirect user
					Utility::prevPage();
				}
			}

		}

		return Errors::displayErrors("Login successful");
	}

	/**
	* Checks to see if the logged session is set
	*/
	public static function loggedIn() {
		return (isset($_SESSION['logged'])) ? true : false;
	}

	/**
	* Checks to see if a specific session is set
	*
	* @param string $session
	*/
	public static function check($session) {
		return (isset($_SESSION[$session])) ? true : false;
	}
}