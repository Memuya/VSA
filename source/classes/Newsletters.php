<?php
class Newsletters {
	private $data;
	private $count;

	public function __construct() {
		$this->data = [];
	}

	public function upload($title, $pdf) {
		$title = Validate::cp($title);

		//file variables
		$pdf_name = $pdf['name'];
		$pdf_temp_name = $pdf['tmp_name'];
		$pdf_ext = explode(".", $pdf_name);
		$pdf_ext = end($pdf_ext);
		$pdf_ext = strtolower($pdf_ext);

		if(empty($title) || empty($pdf_name))
			Errors::add("All fields are required");
		else if($pdf_ext != "pdf")
			Errors::add("Only the <b>.pdf</b> extension is supported for uploading");
		else {
			try {
				//insert into database
				try {
					$q = DB::$db->prepare("
						INSERT INTO newsletters (title, date)
						VALUES (:title, UNIX_TIMESTAMP(NOW()))
					");

					$q->execute([':title' => $title]);
				} catch(PDOException $ex) {
					die($ex->getMessage());
				}

				//grab the ID generated for the last query
				$last_id = DB::$db->lastInsertId();

				//throw a new exception if $last_id returns 0
				if($last_id == 0)
					throw new PDOException("Something went wrong with the query. [lastInsertId() returning 0]");

				//move file to newsletter folder
				move_uploaded_file($pdf_temp_name, "../newsletters/".$last_id.".".$pdf_ext);

			} catch(PDOException $ex) {
				Errors::add($ex->getMessage());
			}
		}

		return Errors::displayErrors("Newsletter successfully added!");
	}

	/**
	* Returns all newsletters
	*/
	public function getAll() {
		try {
			$q = DB::$db->query("
				SELECT *
				FROM newsletters
				ORDER BY id DESC
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
	* Delete a newsletter
	* 
	* @param int $id
	*/
	public function delete($id) {
		$id = (int)$id;

		//check if newsletter exist in database
		try {
			$q = DB::$db->prepare("
				SELECT id
				FROM newsletters
				WHERE id = :id
			");

			$q->execute([':id' => $id]);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}

		$c = $q->rowCount();
		$r = $q->fetch(PDO::FETCH_OBJ);

		//delete if exist
		if($c != 0) {
			//delete pdf file
			unlink("../newsletters/".$r->id.".pdf");

			try {
				$q = DB::$db->prepare("
					DELETE FROM newsletters
					WHERE id = :id
				");

				$q->execute([
					':id' => $id
				]);
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}
		}
	}

	/**
	* Returns the amount of rows returned from the getAll() and get() methods
	*/
	public function getCount() {
		return $this->count;
	}
}