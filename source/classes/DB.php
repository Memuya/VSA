<?php
/**
 * Connect to a database via PDO
 * 
 * @Version 1.0
 * @Year 2015
 * @Author Mehmet Uyanik
 */
class DB {
	protected static $connected = false;
	public static $db;

	/**
	* Calls the connect() method to connect to the database when the DB object is created
	*/
	public function __construct() {
		try {
			$this->connect();
		} catch(PDOException $ex) {
			die($ex->getMessage());
		}
	}

	/**
	* Connects to database via PDO
	*/
	public function connect() {
		//allows only one active connection to the database to exist no matter how many times it is called
		if(!self::$connected) {
			
			//create a PDO connection to the database
			self::$db = new PDO("mysql:host=localhost;dbname=vsa", "root", "");
			self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			//set connection to true so we don't re-connect
			self::$connected = true;
		}
	}
}