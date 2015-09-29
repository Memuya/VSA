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

try {
	$q = DB::$db->prepare("
		SELECT *, ads.id AS adID
		FROM ads
		INNER JOIN users
		ON ads.user_id = users.id
		WHERE user_id = :id
	");

	$q->execute([':id' => $_SESSION['corporate']]);
} catch(DPOException $ex) {
	die($ex->getMessage());
}

$c = $q->rowCount();

if($c !== 0) $r = $q->fetch(PDO::FETCH_OBJ);

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

				<p><b>Ideal image should have a resolution of 250x250 pixels. Image will be resized to 250x250 pixels.</b></p>

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

				<?php if($c !== 0): ?>
					<div style="margin-top: 20px;">
						<table class="style">
							<tr>
								<th>Company</th>
								<th>Image</th>
								<th>URL</th>
								<th>Status</th>
							</tr>
							<tr>
								<td><?=$r->company;?></td>
								<td><img src="<?=PATH;?>img/sponsors/<?=$r->adID.".".$r->img_ext;?>" style="width: 100px;"></td>
								<td><a href="<?=$r->website;?>" target="_blank"><?=$r->website;?></a></td>
								<td><?=($r->status === '1') ? '<span class="text-green">Active</span>' : '<span class="text-orange">Pending</span>';?></td>
							</tr>
						</table>
					</div>
				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>