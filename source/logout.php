<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

require_once 'includes/init.php';

//get url
$url = (isset($_GET['url'])) ? $_GET['url'] : PATH;

//destroy sessions
session_start();
session_destroy();

//redirect
header("Location: ".$url);
die();