<?php
/**
* A class to handle all output errors to a user
*
* @version 1.0
* @author Mehmet Uyanik
*/
class Errors {
	private static $errors = [];

	/**
	* Check if an error exist inside the errors array
	*/
	public static function hasErrors() {
		if(count(self::$errors) > 0)
			return true;
		else
			return false;
	}
	
	/**
	* Returns all values inside the errors array
	* 
	* @param int $style
	*/
	public static function getErrors($style = 1) {
		$m = null;
		if(self::hasErrors()) {
			($style !== 0) ? $m .='<div class="notice-box red-notice">' : null;
			
			foreach(self::$errors as $e)
				$m .= $e."<br>";
			
			($style !== 0) ? $m .= '</div>' : null;
			
			return $m;
			
		}
	}
	
	/**
	* Displays the list of errors in the errors array or a success message
	* Set $style to 0 to only return a string of errors with no styling
	* If you do not want to display a message enter "0" (int) into the signature
	* 
	* @param string $message
	* @param int $style
	*/
	public static function displayErrors($message, $style = 1) {
		if(self::hasErrors())
			return self::getErrors($style);
		else
			return ($message === 0) ? null : (($style === 1) ? '<div class="notice-box green-notice">'.$message.'</div>' : $message);
	}

	/**
	* Returns the amount of errors stored in the $errors array
	* 
	*/
	public function getCount() {
		return count(self::$errors);
	}

	/**
	* Add a string to the $errors array
	* 
	* @param string $message
	*/
	public function add($message) {
		self::$errors[] = $message;
	}
	
}