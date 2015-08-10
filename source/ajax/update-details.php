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
$payment_made = (isset($_POST['payment_made'])) ? $_POST['payment_made'] : $user->get($_SESSION['logged'])->payment_made;

/**
* These fields are only updated if the user is a corporate member
*/
$company = (isset($_POST['company'])) ? $_POST['company'] : 'N/A';
$website = (isset($_POST['website'])) ? $_POST['website'] : 'http://www.';
$fax 	 = (isset($_POST['fax'])) ? $_POST['fax'] : 'N/A';

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
	$company,
	$website,
	$fax,
	$blocked,
	$_POST['type'],
	$active,
	$level,
	$payment_made
);