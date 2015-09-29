<?php
class Courses {
	private $count;
	private $data;
	private static $discount = 10;

	/**
	* Initializes the data array
	*/
	public function __contruct() {
		$this->data = [];
	}

	public static function getDiscount() {
		return self::$discount;
	}

	/**
	* Add a new course
	* 
	* @param string $code
	* @param string $name
	* @param string $duration
	* @param string $date
	* @param string $time
	* @param string $location
	* @param string $cost
	*/
	public function add($code, $name, $duration, $date, $time, $location, $cost) {
		$code = Validate::cp($code);
		$name = Validate::cp($name);
		$duration = Validate::cp($duration);
		$date = Validate::cp($date);
		$time = Validate::cp($time);
		$location = Validate::cp($location);
		$cost = Validate::cp(str_replace("$", "", $cost));

		if(empty($code) || empty($name) || empty($duration) || empty($date) || empty($time) || empty($location) || empty($cost))
			Errors::add("All fields are required");
		else {
			try {
				//insert into database
				$insert = DB::$db->prepare("
					INSERT INTO courses (code, name, duration, date, time, location, cost, expired) 
					VALUES (:code, :name, :duration, :date, :time, :location, :cost, '0')
				");

				$insert->execute([
					':code' => $code,
					':name' => $name,
					':duration' => $duration,
					':date' => $date,
					':time' => $time,
					':location' => $location,
					':cost' => $cost
				]);
			} catch (PDOException $ex) {
				Errors::add($ex->getMessage());
			}
				
		}

		return Errors::displayErrors("Course Sucessfully Added!");
	}

	/**
	* Edit a course
	* 
	*/
	public function edit($id, $code, $name, $duration, $date, $time, $location, $cost, $expired) {
		$id = (int)$id;
		$code = Validate::cp($code);
		$name = Validate::cp($name);
		$duration = Validate::cp($duration);
		$date = Validate::cp($date);
		$time = Validate::cp($time);
		$location = Validate::cp($location);
		$cost = Validate::cp(str_replace("$", "", $cost));
		$expired = Validate::cp($expired);

		if(empty($id) || empty($code) || empty($name) || empty($duration) || empty($date) || empty($time) || empty($location) || empty($cost))
			Errors::add("All fields are required");
		else {
			try {
				//update course
				$q = DB::$db->prepare("
					UPDATE courses
					SET code = :code,
					name = :name,
					duration = :duration,
					date = :date,
					time = :time,
					location = :location,
					cost = :cost,
					expired = :expired
					WHERE id = :id
				");

				$q->execute([
					':code' => $code,
					':name' => $name,
					':duration' => $duration,
					':date' => $date,
					':time' => $time,
					':location' => $location,
					':cost' => $cost,
					':expired' => $expired,
					':id' => $id
				]);
			} catch (PDOException $ex) {
				Errors::add($ex->getMessage());
			}
			
			
		}

		return Errors::displayErrors("Course Sucessfully Updated!");
	}

	/**
	* Delete a course
	* 
	* @param int $id
	*/
	public function delete($id) {
		$id = (int)$id;

		//check if course ID exist in database
		try {
			$q = DB::$db->prepare("
				SELECT id
				FROM courses
				WHERE id = :id
			");

			$q->execute([':id' => $id]);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$c = $q->rowCount();

		//delete if exist
		if($c != 0) {
			try {
				$q = DB::$db->prepare("
					DELETE FROM courses
					WHERE id = :id
				");

				$q->execute([':id' => $id]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}

			//delete all enrolments for that course
			$q = DB::$db->prepare("
				DELETE FROM enrolments
				WHERE course_id = :id
			") or die($q->errorInfo());

			$q->execute([':id' => $id]);
		}
	}

	/**
	* Return a specific course
	* 
	* @param int $id
	*/
	public function get($id) {
		$id = Validate::cp((int)$id);
		try {
			$q = DB::$db->prepare("
				SELECT *
				FROM courses
				WHERE id = :id
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
	* Returns all courses
	*/
	public function getAll() {
		try {
			$q = DB::$db->query("
				SELECT *
				FROM courses
				ORDER BY code
			");
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$this->count = $q->rowCount();

		if($this->count != 0)
			while($r = $q->fetch(PDO::FETCH_OBJ))
				$this->data[] = $r;

		return $this->data;
	}

	/**
	* Add an enrolment of a course to a user's account
	*
	* @param int $user_id
	* @param int $course_id
	*/
	public function apply($user_id = null, $course_id) {
		$message = null;
		$user_id = Validate::post($user_id);
		$course_id = Validate::post($course_id);

		try {
			//check to see if course ID exist and is not expired
			$course_q = DB::$db->prepare("
				SELECT id
				FROM courses
				WHERE id = :id
				AND expired = '0'
			");

			$course_q->execute([':id' => $course_id]);
		} catch(PDOException $ex) {
			Errors::add($ex->getMessage());
		}

		$course_c = $course_q->rowCount();

		if($course_c === 0)
			Errors::add("You cannot apply for this course");
		else {

			//get price of course and apply discount if needed
			$q = DB::$db->prepare("SELECT cost FROM courses WHERE id = :course_id");
			$q->execute([':course_id' => $course_id]);
			$r = $q->fetch(PDO::FETCH_OBJ);
			
			$payment_required = (!empty($user_id)) ? $r->cost * ((100-self::$discount) / 100) : $r->cost;

			//check if user is logged in
			if(!empty($user_id)) {
				try {
					//check to see if user has already enrolled into the course
					$check_enrolment_q = DB::$db->prepare("
						SELECT *
						FROM enrolments
						WHERE user_id = :user_id
						AND course_id = :course_id
					");

					$check_enrolment_q->execute([
						':user_id' => $user_id,
						':course_id' => $course_id
					]);
				} catch(PDOException $ex) {
					Errors::add($ex->getMessage());
				}

				$check_enrolment_c = $check_enrolment_q->rowCount();

				if($check_enrolment_c !== 0)
					Errors::add("You have already enrolled into this course. Please check your account page for more information.");
				else {
					//enrol the user into the course with a pending status
					try {
						$q = DB::$db->prepare("
							INSERT INTO enrolments (user_id, course_id, status, payment_required)
							VALUES (:user_id, :course_id, '0', :payment_required)
						");

						$q->execute([
							':user_id' => $user_id,
							':course_id' => $course_id,
							':payment_required' => $payment_required
						]);

						//success message
						$message = "Thank you for applying for this course. You can check your enrolment status via your account page.";
					} catch(PDOException $ex) {
						Errors::add($ex->getMessage());
					}
				}
			//if user is not logged in, get their details and create a "Course" membership for them	
			} else {
				//validate form data here
				$register = new Register(
					$_POST['username'],
					$_POST['password'],
					$_POST['r_password'],
					'course',
					$_POST['company'],
					$_POST['title'],
					$_POST['fname'],
					$_POST['lname'],
					$_POST['address'],
					$_POST['suburb'],
					$_POST['state'],
					$_POST['postcode'],
					$_POST['country'],
					$_POST['phone'],
					$_POST['email'],
					null,
					null
				);

				$register->user();

				//enrol the user into the course with a pending status
				if(!Errors::hasErrors()) {
					$lastID = DB::$db->lastInsertId();

					try {
						$q = DB::$db->prepare("
							INSERT INTO enrolments (user_id, course_id, status, payment_required)
							VALUES (:user_id, :course_id, '0', :payment_required)
						");

						$q->execute([
							':user_id' => $lastID,
							':course_id' => $course_id,
							':payment_required' => $payment_required
						]);

						//success message
						$message = "Thank you for applying for this course. Your Course Member account has been registered. Please activate your account with the link sent to your email.";
					} catch(PDOException $ex) {
						Errors::add($ex->getMessage());
					}
				}

				//success message
				//$message = "Thank you for applying for this course. An email has been sent to your email address. Please check your email for details.";
			}
		}

		return Errors::displayErrors($message);
	}

	/**
	* Get a list of a users applied courses
	*
	* @param int $user_id
	*/
	public function getUserEnrolments($user_id) {
		$user_id = (int)$user_id;

		try {
			$q = DB::$db->prepare("
				SELECT *
				FROM enrolments
				INNER JOIN courses
				ON enrolments.course_id = courses.id
				WHERE enrolments.user_id = :id
			");

			$q->execute([':id' => $user_id]);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$this->count = $q->rowCount();

		if($this->count != 0)
			while($r = $q->fetch(PDO::FETCH_OBJ))
				$this->data[] = $r;

		return $this->data;
	}

	/**
	* Counbt the number of students in a course (jncluding pending enrolments)
	* status = 0 (Pending enrolments)
	* status = 1` (Active enrolments)
	*
	* @param int $course_id
	* @param string $status
	*/
	public function getEnrolmentCount($course_id, $status) {
		$course_id = (int)$course_id;

		try {
			$q = DB::$db->prepare("
				SELECT COUNT(*) AS count
				FROM enrolments
				INNER JOIN courses
				ON enrolments.course_id = courses.id
				WHERE enrolments.course_id = :course_id
				AND enrolments.status = :status
			");

			$q->execute([
				':course_id' => $course_id,
				':status' => $status
			]);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$this->count = $q->rowCount();
		$r = $q->fetch(PDO::FETCH_OBJ);

		if($this->count != 0)
			$this->data = $r->count;

		return $this->data;
	}

	/**
	* Update the status of an course enrolment
	*
	* @param int $enrolment_id
	* @param string $status
	*/
	public function changeEnrolmentStatus($enrolment_id, $status) {
		$enrolment_id = (int)$enrolment_id;

		//see if enrolment exist
		try {
			$q = DB::$db->prepare("
				SELECT id
				FROM enrolments
				WHERE id = :id
			");
			$q->execute([':id' => $enrolment_id]);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$c = $q->rowCount();

		if($c !== 0) {
			try {
				$q = DB::$db->prepare("
					UPDATE enrolments
					SET status = :status
					WHERE id = :id
				");

				$q->execute([
					':status' => $status,
					':id' => $enrolment_id
				]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}
		}

		return Errors::displayErrors("Successfully changed status of enrolment");
	}

	public function deleteEnrolment($id) {
		$id = (int)$id;
		try {
			$q = DB::$db->prepare("
				DELETE FROM enrolments
				WHERE id = :id
			");

			$q->execute([':id' => $id]);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}
	}

	/**
	* Returns the amount of rows returned from the getAll() and get() methods
	*/
	public function getCount() {
		return $this->count;
	}
}