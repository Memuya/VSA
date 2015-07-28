<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("acc_");

$t->setTitle("OzVac Newsletter");

include $t->load("includes/init.php");

if(!Login::loggedIn())
	Utility::redirect("index");

include $t->load("template/head.php");
include $t->load("template/header.php");

$_newsletters = new Newsletters;
$newsletters = $_newsletters->getAll();
?>	
	<div id="page-heading">
		<h1>OzVac Newsletter</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php include $t->load("template/account-nav.php"); ?>

			<section class="right-main">

				<?php if($_newsletters->getCount() != 0): ?>

					<?php foreach($newsletters as $newsletter): ?>

						<article class="news-box">
							<h2><i class="fa fa-arrow-circle-right"></i> <?=Validate::output($newsletter->title);?></h2>
							<div style="color: #AAA; margin: 5px 0px; font-size: 10px;"><i class="fa fa-chevron-right"></i> <b>Date Added:</b> <?=date("jS M Y", $newsletter->date);?></div>
							<a href="<?=PATH;?>newsletters/<?=$newsletter->id;?>.pdf" class="btn" target="_blank"><i class="fa fa-download"></i> &nbsp; Download</a>
						</article>

					<?php endforeach; ?>

				<?php else: ?>

					<div class="notice-box yellow-notice">No newsletters have been added.</div>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>