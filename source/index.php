<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

//$t->setActivePage("index");

include $t->load("includes/init.php");

include $t->load("template/head.php");
include $t->load("template/header.php");

//query database for welcome message
$q = DB::$db->query("
	SELECT body
	FROM welcome_message
") or die(SQL_ERROR);
$c = $q->rowCount();
$r = $q->fetch(PDO::FETCH_OBJ);
?>	
	<div id="page-heading">
		<h1>Vacuum Society of Australia</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php if(Login::check("admin")): ?>
				<a href="<?=PATH;?>cp/update-welcome" class="btn rfloat">Edit</a>
			<?php endif; ?>

			<?=($c !== 0) ? $r->body : '<p>Welcome message could not be loaded in.</p>';?>
		</div>
	</div>

	<div class="outer-wrapper grey">
		<div class="inner-wrapper">
			<h1>VSA Areas of Interest</h1>
			<ul class="interests">
				<li>
					<div>Applied Surface Science</div>
				</li>
				<li>
					
					<div>Electronic Materials and Processing</div>
				</li>
				<li>
					
					<div>Nanometer Structures</div>
				</li>
				<li>
					
					<div>Plasma Science and Technique</div>
				</li>
				<li>
					
					<div>Surface Engineering</div>
				</li>
				<li>
					
					<div>Surface Science</div>
				</li>
				<li>
					
					<div>Thin Film</div>
				</li>
				<li>
					
					<div>Vacuum Science and Technology</div>
				</li>
			</ul>
		</div>
	</div>

	<?php include $t->load("template/ads.php"); ?>

	<div class="outer-wrapper light-grey">
		<div class="inner-wrapper">
			<h1>Useful Links</h1>
			<ul class="links">
				<li><a href="http://www.vacuumsociety.org.au/index.php?linkRay=1&url=/files/AUSVES_guide/Rays%20List%202015.pdf" class="btn" target="_blank">Australian Vacuum Guide</a></li>
				<li><a href="http://www.vacuumsociety.org.au/lab.php?linkLab=1&url=/files/flash/Single_Cycle_Diffusion_Pump.swf" class="btn" target="_blank">Single Cycle Diffusion Pump</a></li>
				<li><a href="http://www.vacuumsociety.org.au/files/flash/Leak_Detection_Component.swf" class="btn" target="_blank">Try some Leak Detection?</a></li>
				<li><a href="http://www.chemicool.com/" class="btn" target="_blank">The Periodic Table</a></li>
			</ul>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>