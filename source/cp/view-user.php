<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

$_user = new User;

//get ID and set page title (which is the user's username)
$user = $_user->get((int)$_GET["id"]);
$title = ($_user->getCount() != 0) ? $user->username."'s Details" : "User Not Found";

$t->setTitle("Edit ".$title);

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

		//reset password with ajax
		$("#reset").click(function() {
			var c = confirm("An email will be sent to the user with a link to reset their password. Is this ok?");

			if(c) {
				$.ajax({
					type: "POST",
					url: "../ajax/reset-password.php",
					data: {
						email: $("#email").val()
					},
					success: function(data) {
						$("#feedback").hide().html(data).fadeIn();
					}
				});
			}

			return false;
		});
	});
</script>
<?php
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1><?=$title;?></h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<?php if($_user->getCount() != 0): ?>

					<div id="feedback"></div>

					<form id="form">
						<table class="style">
							<tr>
								<th>ID</th>
								<td>#<?=str_pad($user->id, 4, 0, STR_PAD_LEFT);?></td>
							</tr>
							<tr>
								<th>Username</th>
								<td><input type="text" name="username" value="<?=Validate::output($user->username);?>" placeholder="Username"></td>
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
								<td><input type="text" name="email" id="email" value="<?=Validate::output($user->email);?>" placeholder="Email"></td>
							</tr>
							<tr>
								<th>Address</th>
								<td>
									<input type="text" name="address" value="<?=Validate::output($user->address);?>" placeholder="Address">
									<input type="text" name="suburb" value="<?=Validate::output($user->suburb);?>" placeholder="Suburb">
									<input type="text" name="state" value="<?=Validate::output($user->state);?>" placeholder="State">
									<input type="text" name="postcode" value="<?=Validate::output($user->postcode);?>" placeholder="Postcode">
									<input type="text" name="country" value="<?=Validate::output($user->country);?>" placeholder="Country">
								</td>
							</tr>
							<tr>
								<th>Telephone</th>
								<td><input type="text" name="telephone" value="<?=Validate::output($user->telephone);?>" placeholder="Telephone"></td>
							</tr>
							<?php if($user->type === '3'): ?>
								<tr>
									<th>Company Name</th>
									<td><input type="text" name="company" value="<?=$user->company;?>" placeholder="Company"></td>
								</tr>
								<tr>
									<th>Website</th>
									<td><input type="text" name="website" value="<?=$user->website;?>" placeholder="Website"></td>
								</tr>
								<tr>
									<th>Fax</th>
									<td><input type="text" name="fax" value="<?=$user->fax;?>" placeholder="Fax"></td>
								</tr>
							<?php endif; ?>
							<tr>
								<th>Block</th>
								<td>
									<select name="blocked">
										<option value="0" <?=($user->blocked == '0') ? 'selected' : null;?>>No</option>
										<option value="1" <?=($user->blocked == '1') ? 'selected' : null;?>>Yes</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>Membership Type</th>
								<td>
									<select name="type">
										<option value="1" <?=($user->type == '1') ? 'selected' : null;?>>Student</option>
										<option value="2" <?=($user->type == '2') ? 'selected' : null;?>>General</option>
										<option value="3" <?=($user->type == '3') ? 'selected' : null;?>>Corporate</option>
										<option value="4" <?=($user->type == '4') ? 'selected' : null;?>>Course Member</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>Active</th>
								<td>
									<select name="active">
										<option value="1" <?=($user->active == '1') ? 'selected' : null;?>>Yes</option>
										<option value="0" <?=($user->active == '0') ? 'selected' : null;?>>No</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>Access Level</th>
								<td>
									<select name="level">
										<option value="2" <?=($user->level == '2') ? 'selected' : null;?>>Normal</option>
										<option value="1" <?=($user->level == '1') ? 'selected' : null;?>>Administrator</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>Payment Made</th>
								<td>
									<select name="payment_made">
										<option value="1" <?=($user->payment_made == '1') ? 'selected' : null;?>>Yes</option>
										<option value="0" <?=($user->payment_made == '0') ? 'selected' : null;?>>No</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>Delete User</th>
								<td><a href="<?=PATH;?>cp/delete-user?id=<?=$user->id;?>" onclick="c = confirm('Are you sure you want to delete this user? This is permanent!'); if(!c) return false;"><i class="fa fa-minus-circle"></i> <strong>Delete this User</strong></a></td>
							</tr>
						</table>

						<input type="hidden" name="id" id="id" value="<?=$user->id;?>">
						<input type="submit" name="update" id="update" value="Update">
						<input type="submit" name="reset" id="reset" value="Reset Password">
					</form>

				<?php else: ?>

					<div class="notice-box yellow-notice">The user ID provided does not exist.</div>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>