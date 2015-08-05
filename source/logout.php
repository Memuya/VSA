<?php
//get url
$url = (isset($_GET['url'])) ? $_GET['url'] : "index";

//destroy sessions
session_start();
session_destroy();

//redirect
header("Location: ".$url);
die();