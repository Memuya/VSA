<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Newsletters");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
include $t->load("template/header.php");

$_newsletters = new Newsletters;
$newsletters = $_newsletters->getAll();
?>	
	<div id="page-heading">
		<h1>Newsletters</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<?php if($_newsletters->getCount() != 0): ?>

					<p class="rfloat fine-text"><?=$_newsletters->getCount();?> Newsletter<?=($_newsletters->getCount() !== 1) ? 's' : null;?></p>

					<table class="style">
						<tr>
							<th>Title</th>
							<th>Date Added</th>
							<th>Delete</th>
						</tr>

						<?php foreach($newsletters as $newsletter): ?>

							<tr>
								<td><a href="<?=PATH;?>newsletters/<?=$newsletter->id;?>.pdf"><?=$newsletter->title;?></a></td>
								<td><?=date("jS M Y", $newsletter->date);?></td>
								<td><a href="#" data-link="<?=PATH;?>cp/delete-newsletter?id=<?=$newsletter->id;?>" class="delete-btn btn"><i class="fa fa-times"></i></a></td>
							</tr>

						<?php endforeach; ?>

					</table>
					
				<?php else: ?>

					<div class="notice-box yellow-notice">No newsletters have been uploaded as of yet.</div>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>