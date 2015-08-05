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
				if(isset($_POST['upload'])) {
					$sponsors = new Sponsors();
					echo $sponsors->adAd($_FILES['image'], $_SESSION['corporate']);
				}
					
				?>

				<p>Each corporate member is given the opportunity to advertise themselves on the VSA home page. Please use the form below to be featured on the VSA website.</p>

				<p><b>Ideal image should have a resolution of 250x250 pixels.</b></p>

				<form method="post" enctype="multipart/form-data">
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