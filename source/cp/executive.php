<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Executive");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
include $t->load("template/header.php");

$_executives = new Executive;
$executives = $_executives->getAll((isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1);
?>	
	<div id="page-heading">
		<h1>Executive</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">

			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<?php if($_executives->getCount() != 0): ?>

					<p class="text-right fine-text"><?=$_executives->getCount();?> VSA Executive<?=($_executives->getCount() !== 1) ? 's' : null;?></p>

					<table class="style text-left">
						<tr>
							<th>Position</th>
							<th>Name</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>

					<?php foreach($executives as $executive): ?>

						<tr>
							<td><?=$executive->position;?></td>
							<td><?=$executive->title." ".$executive->fname." ".$executive->lname;?></td>
							<td><a href="<?=PATH?>cp/edit-executive?id=<?=$executive->id;?>">Edit</a></td>
							<td><a href="#" data-link="<?=PATH?>cp/delete-executive?id=<?=$executive->id;?>" class="delete-btn">Delete</a></td>
						</tr>

					<?php endforeach; ?>

					</table>

					<?=$_executives->getPageLinks(PATH."cp/executive");?>

				<?php else: ?>

					<div class="notice-box yellow-notice">No VSA executives are being listed at the moment.</div>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>