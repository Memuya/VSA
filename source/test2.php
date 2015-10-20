<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

require_once 'classes/SimpleImage.php';

try {
	$resize = new abeautifulsite\SimpleImage('img/close-icon.png');
	//$resize->resize(500, 300)->save('img/resize/close-icon.png');
} catch(Exception $e) {
	die($e->getMessage());
}