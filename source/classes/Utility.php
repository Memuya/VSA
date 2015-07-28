<?php
/**
*
* This class contains static methods to be used where ever they are needed without
* the need to create the Utility object every time
*
*/
class Utility {
	/**
	* Redirect users to a specific page or the index page if nothing in specified
	* 
	* @param int $to
	*/
	public static function redirect($to = 0) {
		//$url = ($to == 0) ? PATH."index" : (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : PATH.$url;
		$url = ($to === 0) ? PATH : PATH.$to;

		header("Location: ".$url);
		die();
	}

	/**
	* Redirect user to previous page if possible
	*/
	public static function prevPage() {
		header("Location: ".PREV_PAGE);
		die();
	}

	/**
	* Shortens text to a from it's original length to a specified amount
	* 
	* @param string $str
	* @param string $charLimit
	*/
	public static function shortenText($str, $charLimit) {
		return (strlen($str) > $charLimit) ? substr($str, 0, $charLimit).'...' : $str;
	}
}