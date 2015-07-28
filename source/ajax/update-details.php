<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

require_once '../includes/init.php';

if(!Login::loggedIn())
	Utility::redirect();

$user = new User;

/**
* All fields that cannot be changed by an ordinary user are listed here.
* This is so the admin can still freely change some values while the users cannot
*/
$id = (isset($_POST['id'])) ? $_POST['id'] : $_SESSION['logged'];
$blocked = (isset($_POST['blocked'])) ? $_POST['blocked'] : $user->get($_SESSION['logged'])->blocked;
$active = (isset($_POST['active'])) ? $_POST['active'] : $user->get($_SESSION['logged'])->active;
$level = (isset($_POST['level'])) ? $_POST['level'] : $user->get($_SESSION['logged'])->level;
$username = (isset($_POST['username'])) ? $_POST['username'] : $user->getUsername($_SESSION['logged']);

echo $user->edit(
	$id,
	$username,
	$_POST['title'],
	$_POST['fname'],
	$_POST['lname'],
	$_POST['email'],
	$_POST['address'],
	$_POST['suburb'],
	$_POST['state'],
	$_POST['postcode'],
	$_POST['country'],
	$_POST['telephone'],
	$blocked,
	$_POST['type'],
	$active,
	$level
);