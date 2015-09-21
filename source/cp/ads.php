<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Advertisements");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
include $t->load("template/header.php");

$sponsors = new Sponsors;
$ads = $sponsors->getAds();
?>	
	<div id="page-heading">
		<h1>Advertisements</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">

			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<?php if($sponsors->getCount() != 0): ?>

					<p class="text-right fine-text"><?=$sponsors->getCount();?> Active Advertisement<?=($sponsors->getCount() !== 1) ? 's' : null;?></p>

					<table class="style">
						<tr>
							<th>Company</th>
							<th>Image</th>
							<th>URL</th>
							<th>Delete</th>
						</tr>

					<?php foreach($ads as $ad): ?>

						<tr>
							<td><?=$ad->company;?></td>
							<td>
								<a href="<?=PATH.'img/sponsors/'.$ad->adID.".".$ad->img_ext;?>" target="_blank">
									<img src="<?=PATH.'img/sponsors/'.$ad->adID.".".$ad->img_ext;?>" style="width: 100px;">
								</a>
							</td>
							<td><?=$ad->website;?></td>
							<td><a href="#" data-link="<?=PATH?>cp/delete-ad?id=<?=$ad->adID;?>" class="delete-btn btn"><i class="fa fa-times"></i></a></td>
						</tr>

					<?php endforeach; ?>

					</table>

				<?php else: ?>

					<div class="notice-box yellow-notice">No advertisements have been submitted or accepted.</div>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>