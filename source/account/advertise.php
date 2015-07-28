<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("acc_");

$t->setTitle("Advertise on VSA");

include $t->load("includes/init.php");

if(!Login::check("corporate"))
	Utility::redirect("index");

$q = DB::$db->prepare("
	SELECT *
	FROM ads
	WHERE id = :id
");

$q->execute([':id' => $_SESSION['corporate']]);

include $t->load("template/head.php");
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1>Advertise on VSA</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php include $t->load("template/account-nav.php"); ?>

			<section class="right-main">
				<?php
				if(isset($_POST['upload']))
					echo '<div class="notice-box green-notice">Your advertisement has been successfully added. It will have to be checked by an administrator before being displayed on the VSA home page.</div>';
				?>

				<p>Each corporate member is given the opportunity to advertise themselves on the VSA home page. Please use the form below to be featured on the VSA website.</p>

				<form method="post">
					<div class="field">
						<label for="url">Website Link</label>
					</div>
					<div class="field">
						<input type="text" name="url" id="url" title="What website do you want to link to?">
					</div>
					<div class="field">
						<label for="image">Image</label>
					</div>
					<div class="field">
						<input type="file" name="image" id="image" title="What image do you want to display?">
					</div>
					<div class="field">
						<input type="submit" name="upload" value="Add Advertisement">
					</div>
				</form>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>