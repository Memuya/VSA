<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("VSA Sponsors");
$t->setTags("sponsors");

include $t->load("includes/init.php");

include $t->load("template/head.php");
include $t->load("template/header.php");

//query database for sponsors
$q = DB::$db->query("
	SELECT *
	FROM users
	WHERE type = '3'
	ORDER BY id
");

//count returns rows
$c = $q->rowCount();
?>	
	<div id="page-heading">
		<h1>Sponsors</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper center">
			<?php if($c != 0): ?>
				<?php while($r = $q->fetch(PDO::FETCH_OBJ)): ?>

				<div class="sponsor-wrapper">
					<div class="title">
						<?=(!empty($r->company)) ? $r->company : 'N/A';?>
					</div>
					<div class="info">
						<p><b><?=$r->title." ".$r->fname." ".$r->lname;?></b></p>
						<p><b>Ph:</b> <?=$r->telephone;?>,  <b>Fax:</b> <?=$r->fax?></p>
						<p><b>Email:</b> <?=$r->email;?></p>
						<p><a href="<?=$r->website;?>" target="_blank"><?=$r->website;?></a></p>
					</div>
				</div>

				<?php endwhile; ?>
			<?php else: ?>

				<div class="notice-box yellow-notice text-left">No sponsors have been added at this moment.</div>

			<?php endif; ?>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>