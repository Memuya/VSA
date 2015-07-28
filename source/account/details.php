<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("acc_");

$t->setTitle("My Details");

include $t->load("includes/init.php");

if(!Login::loggedIn())
	Utility::redirect("index");

$_user = new User;
$user = $_user->get($_SESSION['logged']);

include $t->load("template/head.php");
?>
<script>
	$(document).ready(function() {
		//update info with ajax
		$("#update").click(function() {
			$("#feedback").html('<div class="center"><img src="../img/ajax-loader.gif"></div>');
			$.ajax({
				type: "POST",
				url: "../ajax/update-details.php",
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
?>	
	<div id="page-heading">
		<h1>My Details</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php include $t->load("template/account-nav.php"); ?>

			<section class="right-main">
				<div id="feedback"></div>
				<form id="form">
					<table class="style">
						<tr>
							<th>ID</th>
							<td>#<?=str_pad($user->id, 4, 0, STR_PAD_LEFT);?></td>
						</tr>
						<tr>
							<th>Username</th>
							<td><?=$user->username;?></td>
						</tr>
						<tr>
							<th>Full Name</th>
							<td>
								<select name="title" style="width: 90px;">
									<option value=""></option>
									<option value="Mr" <?=($user->title == 'Mr') ? 'selected' : null;?>>Mr</option>
									<option value="Ms" <?=($user->title == 'Ms') ? 'selected' : null;?>>Ms</option>
									<option value="Mrs" <?=($user->title == 'Mrs') ? 'selected' : null;?>>Mrs</option>
									<option value="Dr" <?=($user->title == 'Dr') ? 'selected' : null;?>>Dr</option>
									<option value="A/Prof" <?=($user->title == 'A/Prof') ? 'selected' : null;?>>A/Prof</option>
									<option value="E/Prof" <?=($user->title == 'E/Prof') ? 'selected' : null;?>>E/Prof</option>
									<option value="Prof" <?=($user->title == 'Prof') ? 'selected' : null;?>>Prof</option>
									<option value="Sir" <?=($user->title == 'Sir') ? 'selected' : null;?>>Sir</option>
								</select>
								<input type="text" name="fname" value="<?=$user->fname;?>" placeholder="First Name" style="width: 150px;">
								<input type="text" name="lname" value="<?=$user->lname;?>" placeholder="Last Name" style="width: 150px;">
							</td>
						</tr>
						<tr>
							<th>Email</th>
							<td><input type="text" name="email" id="email" value="<?=$user->email;?>" placeholder="Email"></td>
						</tr>
						<tr>
							<th>Address</th>
							<td>
								<input type="text" name="address" value="<?=$user->address;?>" placeholder="Address">
								<input type="text" name="suburb" value="<?=$user->suburb;?>" placeholder="Suburb">
								<input type="text" name="state" value="<?=$user->state;?>" placeholder="State">
								<input type="text" name="postcode" value="<?=$user->postcode;?>" placeholder="Postcode">
								<input type="text" name="country" value="<?=$user->country;?>" placeholder="Country">
							</td>
						</tr>
						<tr>
							<th>Telephone</th>
							<td><input type="text" name="telephone" value="<?=$user->telephone;?>" placeholder="Telephone"></td>
						</tr>
						<tr>
							<th>Membership Type</th>
							<td>
								<select name="type">
									<option value="1" <?=($user->type == '1') ? 'selected' : null;?>>Student</option>
									<option value="2" <?=($user->type == '2') ? 'selected' : null;?>>General</option>
									<option value="3" <?=($user->type == '3') ? 'selected' : null;?>>Corporate</option>
								</select>
							</td>
						</tr>
					</table>
					<input type="submit" name="update" id="update" value="Update">
				</form>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>