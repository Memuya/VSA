<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Privacy Policy");
$t->setTags("privacy policy");

include $t->load("includes/init.php");

include $t->load("template/head.php");
include $t->load("template/header.php");
//query database for welcome message
$q = DB::$db->query("
	SELECT body, date
	FROM privacy_policy
	ORDER BY id DESC
") or die(SQL_ERROR);
$r = $q->fetch(PDO::FETCH_OBJ);
?>	
	<div id="page-heading">
		<h1>Privacy Policy</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?=$r->body;?>

			<p class="text-right fine-text"><b>Last updated on <?=date("jS M Y - G:i:s", $r->date);?></b></p>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>