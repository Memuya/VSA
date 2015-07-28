<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Page Title");

include $t->load("includes/init.php");

include $t->load("template/head.php");
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1>Title Goes Here</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>