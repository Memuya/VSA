<?php
class News {
	private $count;
	private $data;

	/**
	* Initializes the data array
	*/
	public function __contruct() {
		$this->data = [];
	}

	/**
	* Add a news article
	* 
	* @param string $title
	* @param string $author
	* @param string $body
	*/
	public function add($title, $author, $body) {
		$title = Validate::cp($title);
		$author = (int)$author;
		$body = $body;

		if(empty($title) || empty($author) || empty($body))
			Errors::add("All fields are required");
		else {
			$insert = DB::$db->prepare("
				INSERT INTO news (title, posted_by, body, date)
				VALUES (:title, :author, :body, UNIX_TIMESTAMP(NOW()))
			");

			//run the query
			$insert->execute([
				':title' => $title,
				':author' => $author,
				':body' => $body
			]);
		}

		return Errors::displayErrors("News article successfully posted!");
	}

	/**
	* Edit a news article
	* 
	* @param int $id
	* @param string $message
	* @param string $title
	*/
	public function edit($id, $message, $title) {
		$title = Validate::cp($title);
		$id = (int)$id;

		if(empty($message) || empty($title))
			Errors::add("All fields are required");
		else {
			//preapre the query
			$q = DB::$db->prepare("
				UPDATE news
				SET body = :body,
				title = :title
				WHERE id = :id
			") or die(SQL_ERROR);

			//run the query
			$q->execute([
				':body' => $message,
				':title' => $title,
				':id' => $id
			]);
		}

		return Errors::displayErrors("News Article successfully updated!");
	}

	/**
	* Delete a news article
	* 
	* @param int $id
	*/
	public function delete($id) {
		$id = (int)$id;

		//check if news article exist in database
		$q = DB::$db->prepare("
			SELECT id
			FROM news
			WHERE id = :id
		") or die(SQL_ERROR);

		$q->execute([':id' => $id]);

		$c = $q->rowCount();

		//delete if exist
		if($c != 0) {
			$q = DB::$db->prepare("
				DELETE FROM news
				WHERE id = :id
			") or die(SQL_ERROR);

			$q->execute([
				':id' => $id
			]);
		}
	}

	/**
	* Get a specific news article
	* 
	* @param int $id
	*/
	public function get($id) {
		$id = Validate::cp((int)$id);
	
		$q = DB::$db->prepare("
			SELECT news.*, CONCAT(users.title, ' ', users.fname, ' ', users.lname) as full_name
			FROM news
			INNER JOIN users
			ON news.posted_by = users.id
			WHERE news.id = :id
		") or die($q->errorInfo());

		$q->execute([':id' => $id]);

		$this->count = $q->rowCount();
		$r = $q->fetch(PDO::FETCH_OBJ);
		
		$this->data = $r;

		return $this->data;
	}

	/**
	* Returns all news articles
	*/
	public function getAll() {
		$q = DB::$db->query("
			SELECT news.*, CONCAT(users.title, ' ', users.fname, ' ', users.lname) as full_name
			FROM news
			INNER JOIN users
			ON news.posted_by = users.id
			ORDER BY id DESC
			LIMIT 0, 10
		") or die(SQL_ERROR);

		$this->count = $q->rowCount();

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
}