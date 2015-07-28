<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

if(!Login::check("admin"))
	Utility::redirect();

$news = new News;

echo $news->add(
	$_POST["title"],
	$_SESSION["logged"],
	$_POST["body"]
);