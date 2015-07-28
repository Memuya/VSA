<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

if(!Login::check("admin"))
	Utility::redirect();

$news = new News;

echo $news->edit(
	$_POST["id"],
	$_POST["body"],
	$_POST["title"]
);