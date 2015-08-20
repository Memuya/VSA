<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

$courses = new Courses;

$is_member = (Login::loggedIn()) ? $_SESSION['logged'] : null;

echo $courses->apply(
	$is_member,
	$_POST['course_id']
);