<?php
include 'classes/Pagination.php';

$sql = [
	'users',
	'username = asd'
];

echo (isset($sql[1])) ? $sql[2] : $sql[1];