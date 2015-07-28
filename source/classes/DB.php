<?php
/**
 * Connect to a database via PDO
 * 
 * @Version 1.0
 * @Year 2015
 * @Author Mehmet Uyanik
 */
class DB {
	protected $db;
	protected $db_server = "mysql";
	protected $host = "localhost";
	protected $dbname = "vsa";
	protected $user = "root";
	protected $pass = "";
	/**
	* Calls the connect() method to connect to the database when the DB object is created only if $connect is set to true
	* You may want to set $onnect to false if you want to change database information and then re-connect
	*/
	public function __construct($connect = true) {
		if($connect) {
			try {
				$this->connect();
			} catch(PDOException $ex) {
				die($ex->getMessage());
			}
		}
	}
	/**
	* Connects to database via PDO and sets the error mode to exception
	*/
	public function connect() {
		try {
			$this->db = new PDO($this->db_server.":host=".$this->host.";dbname=".$this->dbname, $this->user, $this->pass);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}
	}
	/**
	* Returns the database connection to be used outside of the class
	*
	*/
	public function getDB() {
		return $this->db;
	}
	
	/**
	 * Set which type of server the database connects to
	 * 
	 * @param string $server
	 */
	public function setDBServer($server) {
		$this->db_server = $server;
	}
	
	/**
	 * Set the database name
	 * 
	 * @param string $name
	 */
	public function setDBName($name) {
		$this->dbname = $name;
	}
	
	/**
	 * Set the database host
	 * 
	 * @param string $host
	 */
	public function setHost($host) {
		$this->host = $host;
	}
	/**
	 * Set the database username
	 * 
	 * @param string $user
	 */
	public function setDBUser($user) {
		$this->user = $user;
	}
	
	/**
	 * Set the database user's password
	 * 
	 * @param string $pass
	 */
	public function setDBPass($pass) {
		$this->pass = $pass;
	}
}
