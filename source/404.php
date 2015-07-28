<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Page not Found");

include $t->load("includes/init.php");

include $t->load("template/head.php");
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1>404 - Page not Found!</h1>
	</div>
	<div class="outer-wrapper white center">
		<div class="inner-wrapper">
			<h2>The page you have requested could not be found!</h2>
			<a href="<?=PATH;?>" class="btn" style="margin-top: 20px;">Return Home</a>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>