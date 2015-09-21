<?php
//defines the path name for links
define("PATH", "http://localhost/vsa/");

//message to appear when a query fails on a page
define("SQL_ERROR", '[SQL ERROR] There seems to be a problem with a query on this page. Please contact an administrator via our <a href="'.PATH.'contact">contact page</a>.');

//define the previous page if possible (used for redirects)
define("PREV_PAGE", (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : "index");

//turn on output buffering
ob_start();

//change cookie lifetime for sessions to 7 days in the php.ini file
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);

//start sessions
session_start();

//re-generates a new session ID each load
session_regenerate_id(true);

//turn errors off when NOT in development
//ini_set("display_errors", false);

//initilize the DB object to run its constructor which contains the connection to the database
$con = new DB;