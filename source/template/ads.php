<?php
//create Sponsor object
$sponsors = new Sponsors;

//get all active ads
$ads = $sponsors->getAds();
?>
<div class="outer-wrapper white">
	<div class="inner-wrapper">
		<?php if(Login::check("admin")): ?>
			<a href="<?=PATH;?>cp/ads" class="btn rfloat">Edit</a>
		<?php endif; ?>

		<h1>Our Friends</h1>
	</div>

	<?php if($sponsors->getCount() != 0): ?>

	<div class="marquee">
		<?php foreach($ads as $ad): ?>

			<div class="ad-box">
				<a href="<?=$ad->website;?>" target="_blank">
					<img src="<?=PATH."img/sponsors/".$ad->img;?>">
				</a>
				<div><a href="<?=$ad->website;?>" target="_blank"><?=$ad->company;?></a></div>
			</div>

		<?php endforeach; ?>
	</div>
	<div class="clear"></div>

	<?php else: ?>

		<h3 class="center">No Advertisements at this time</h3>

	<?php endif; ?>
</div>