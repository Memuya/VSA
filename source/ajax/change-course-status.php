<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

if(!Login::check("admin"))
	Utility::redirect();

$courses = new Courses;

echo $courses->changeEnrolmentStatus($_POST['enrolment_id'], $_POST['status']);