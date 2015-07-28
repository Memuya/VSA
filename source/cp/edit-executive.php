<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template;
$t = new Template("cp_");

$t->setTitle("Edit Executive");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
?>
<script>
	$(document).ready(function() {
		$("#update").click(function() {
			$("#feedback").html('<div class="center"><img src="../img/ajax-loader.gif"></div>');
			$.ajax({
				type: "POST",
				url: "../ajax/edit-executive.php",
				data: $("#form").serialize(),
				success: function(data) {
					$("#feedback").hide().html(data).fadeIn();
				}
			});

			return false;
		});
	});
</script>
<?php
include $t->load("template/header.php");

$_executive = new Executive;
$executive = $_executive->get($_GET['id']);
?>	
	<div id="page-heading">
		<h1>Edit Executive</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">

			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<?php if($_executive->getCount() != 0): ?>

					<div id="feedback"></div>
					<form id="form">
						<table class="style">
							<tr>
								<th>Position</th>
								<td><input type="text" name="position" id="position" value="<?=Validate::output($executive->position);?>"></td>
							</tr>
							<tr>
								<th>Full Name</th>
								<td>
									<select name="title" id="title" style="width: 90px;">
										<option value="Mr" <?=($executive->title == 'Mr') ? 'selected' : null;?>>Mr</option>
										<option value="Ms" <?=($executive->title == 'Ms') ? 'selected' : null;?>>Ms</option>
										<option value="Mrs" <?=($executive->title == 'Mrs') ? 'selected' : null;?>>Mrs</option>
										<option value="Dr" <?=($executive->title == 'Dr') ? 'selected' : null;?>>Dr</option>
										<option value="A/Prof" <?=($executive->title == 'A/Prof') ? 'selected' : null;?>>A/Prof</option>
										<option value="E/Prof" <?=($executive->title == 'E/Prof') ? 'selected' : null;?>>E/Prof</option>
										<option value="Prof" <?=($executive->title == 'Prof') ? 'selected' : null;?>>Prof</option>
										<option value="Sir" <?=($executive->title == 'Sir') ? 'selected' : null;?>>Sir</option>
									</select>
									<input type="text" name="fname" id="fname" placeholder="First Name" value="<?=Validate::output($executive->fname);?>">
									<input type="text" name="lname" id="lname" placeholder="Last Name" value="<?=Validate::output($executive->lname);?>">
								</td>
							</tr>
							<tr>
								<th>Organization</th>
								<td><input type="text" name="organization" id="organization" value="<?=Validate::output($executive->organization);?>"></td>
							</tr>
							<tr>
								<th>Phone</th>
								<td><input type="text" name="telephone" id="telephone" value="<?=Validate::output($executive->telephone);?>"></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><input type="text" name="email" id="email" value="<?=Validate::output($executive->email);?>"></td>
							</tr>
						</table>
						<input type="hidden" name="id" id="id" value="<?=$executive->id;?>">
						<input type="submit" name="update" id="update" value="Update">
					</form>

				<?php else: ?>

					<div class="notice-box yellow-notice">The ID given is not valid</div>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>