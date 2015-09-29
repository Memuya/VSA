<?php
class Executive extends Pagination {
	private $count;
	private $data;

	/**
	* Initializes the data array
	*/
	public function __contruct() {
		$this->data = [];
	}

	/**
	* Add a new course
	* 
	* @param string $position
	* @param string $title
	* @param string $fname
	* @param string $lname
	* @param string $organization
	* @param string $telephone
	* @param string $email
	*/
	public function add($position, $title, $fname, $lname, $organization, $telephone, $email) {
		$position = Validate::cp($position);
		$title = Validate::cp($title);
		$fname = Validate::cp($fname);
		$lname = Validate::cp($lname);
		$organization = Validate::cp($organization);
		$telephone = Validate::cp($telephone);
		$email = Validate::cp($email);

		if(empty($position) || empty($title) || empty($fname) || empty($lname) || empty($organization) || empty($telephone) || empty($email))
			Errors::add("All fields are required");
		else {
			//validate email address
			if(strlen($email) > 100)
				Errors::add("Email address must be 100 characters or less");
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				Errors::add("Email address is not valid");
			else if(!preg_match("^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$^", $email))
				Errors::add("Email address not valid");

			if(!Errors::hasErrors()) {
				try {
					$q = DB::$db->prepare("
						INSERT INTO executives (position, title, fname, lname, organization, telephone, email)
						VALUES (:position, :title, :fname, :lname, :organization, :telephone, :email)
					");

					$q->execute([
						':position' => $position,
						':title' => $title,
						':fname' => $fname,
						':lname' => $lname,
						':organization' => $organization,
						':telephone' => $telephone,
						':email' => $email
					]);
				} catch(PDOException $ex) {
					die($ex->getMessage());
				}
			}
		}

		return Errors::displayErrors("Executive successfully added!");
	}

	/**
	* Edit a course
	* 
	* @param string $position
	* @param string $title
	* @param string $fname
	* @param string $lname
	* @param string $organization
	* @param string $telephone
	* @param string $email
	*/
	public function edit($id, $position, $title, $fname, $lname, $organization, $telephone, $email) {
		$id = (int)$id;
		$position = Validate::cp($position);
		$title = Validate::cp($title);
		$fname = Validate::cp($fname);
		$lname = Validate::cp($lname);
		$organization = Validate::cp($organization);
		$telephone = Validate::cp($telephone);
		$email = Validate::cp($email);

		if(empty($position) || empty($title) || empty($fname) || empty($lname) || empty($organization) || empty($telephone) || empty($email))
			Errors::add("All fields are required");
		else {
			//validate email address
			if(strlen($email) > 100)
				Errors::add("Email address must be 100 characters or less");
			else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				Errors::add("Email address is not valid");
			else if(!preg_match("^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$^", $email))
				Errors::add("Email addres not valid");

			if(!Errors::hasErrors()) {
				try {
					$q = DB::$db->prepare("
						UPDATE  executives
						SET position = :position,
						title = :title,
						fname = :fname,
						lname = :lname,
						organization = :organization,
						telephone = :telephone,
						email = :email
						WHERE id = :id
					");

					$q->execute([
						':position' => $position,
						':title' => $title,
						':fname' => $fname,
						':lname' => $lname,
						':organization' => $organization,
						':telephone' => $telephone,
						':email' => $email,
						':id' => $id
					]);
				} catch(PDOException $ex) {
					die($ex->getMessage());
				}
			}
		}

		return Errors::displayErrors("Executive successfully updated!");
	}

	/**
	* Delete an executive
	* 
	* @param int $id
	*/
	public function delete($id) {
		$id = (int)$id;

		//check if course ID exist in database
		try {
			$q = DB::$db->prepare("
				SELECT id
				FROM executives
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
					DELETE FROM executives
					WHERE id = :id
				");

				$q->execute([':id' => $id]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}
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
				FROM executives
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
	public function getAll($page = 1, $limit = 10) {
		$this->amount = ($page - 1) * $limit;
		$this->limit = $limit;
		$this->page = $page;

		try {
			$q = DB::$db->query("
				SELECT SQL_CALC_FOUND_ROWS *
				FROM executives
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
	* Returns the amount of rows returned from the getAll() and get() methods
	*/
	public function getCount() {
		return $this->count;
	}

	/**
	* Returns the full name including the title of a specific user
	*
	* @param int $id
	*/
	public function getFullName($id) {
		return $this->get($id)->title." ".$this->get($id)->fname." ".$this->get($id)->lname;
	}
}