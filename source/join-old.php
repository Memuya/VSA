<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Join VSA");
$t->setTags("join, register, sign up");

include $t->load("includes/init.php");

include $t->load("template/head.php");
?>
<script src="<?=PATH;?>js/join.js"></script>
<script>
	$(document).ready(function() {
		$("#join-btn").click(function() {
			$.ajax({
				type: "POST",
				url: "ajax/register.php",
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
		<h1>Join VSA</h1>
	</div>
	<?php if(!Login::loggedIn()): ?>

		<form id="form">
			<div class="outer-wrapper light-grey center">
				<div class="inner-wrapper">
					<h1>Type of Membership</h1>
					<div id="student-select" class="type-of-membership-btn">Student ($10)</div>
					<div id="general-select" class="type-of-membership-btn">General ($25)</div>
					<div id="corporate-select" class="type-of-membership-btn">Corporate ($250)</div>
					<input type="radio" name="type" value="student" style="display: none;">
					<input type="radio" name="type" value="general" style="display: none;">
					<input type="radio" name="type" value="corporate" style="display: none;">

					<div id="cost"></div>
				</div>
			</div>

			<div class="outer-wrapper center red" id="type-desscription" style="display: none;">
				<div class="inner-wrapper">
					<a href="#" class="rfloat" style="color: #FFF; text-decoration: none; font-size: 22px;" id="close-desc-btn" title="Close description">&#10006;</a>
					<h1>Description</h1>
					<p class="load-desc">Please select a membership type listed above!</p>
				</div>
			</div>

			<div class="outer-wrapper white center">
				<div class="inner-wrapper">

					<div id="feedback"></div>

					<h1>Contact Information</h1>
					<table style="width: 100%;">
						<tr>
							<td>
								<div class="field">
									<label for="company">Institude/Company <span class="text-red optional-required">*</span></label>
								</div>
								<div class="field">
									<input type="text" name="company" id="company">
								</div>
							</td>
							<td>
								<div class="field">
									<label for="title">Title</label>
								</div>
								<div class="field">
									<select name="title" id="title">
										<option value="Mr">Mr</option>
										<option value="Ms">Ms</option>
										<option value="Mrs">Mrs</option>
										<option value="Dr">Dr</option>
										<option value="A/Prof">A/Prof</option>
										<option value="E/Prof">E/Prof</option>
										<option value="Prof">Prof</option>
										<option value="Sir">Sir</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="field">
									<label for="fname">First Name</label>
								</div>
								<div class="field">
									<input type="text" name="fname" id="fname" required>
								</div>
							</td>
							<td>
								<div class="field">
									<label for="lname">Last Name</label>
								</div>
								<div class="field">
									<input type="text" name="lname" id="lname" required>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="field">
									<label for="address">Address</label>
								</div>
								<div class="field">
									<input type="text" name="address" id="address" required>
								</div>
							</td>
							<td>
								<div class="field">
									<label for="suburb">Suburb</label>
								</div>
								<div class="field">
									<input type="text" name="suburb" id="suburb" required>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="field">
									<label for="state">State</label>
								</div>
								<div class="field">
									<input type="text" name="state" id="state">
								</div>
							</td>
							<td>
								<div class="field">
									<label for="postcode">Postcode</label>
								</div>
								<div class="field">
									<input type="text" name="postcode" id="postcode" required>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="field">
									<label for="country">Country</label>
								</div>
								<div class="field">
									<input type="text" name="country" id="country" required>
								</div>
							</td>
							<td>
								<div class="field">
									<label for="phone">Telephone</label>
								</div>
								<div class="field">
									<input type="text" name="phone" id="phone" required>
								</div>
							</td>
						</tr>
					</table>

					<h1>Account Details</h1>
					<table style="width: 100%;">
						<tr>
							<td>
								<div class="field">
									<label for="username">Username</label>
								</div>
								<div class="field">
									<input type="text" name="username" id="username" required>
								</div>
							</td>
							<td>
								<div class="field">
									<label for="email">Email Address</label>
								</div>
								<div class="field">
									<input type="text" name="email" id="email" required>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="field">
									<label for="password">Password</label>
								</div>
								<div class="field">
									<input type="password" name="password" id="password" required>
								</div>
							</td>
							<td>
								<div class="field">
									<label for="r_password">Repeat Password</label>
								</div>
								<div class="field">
									<input type="password" name="r_password" id="r_password" required>
								</div>
							</td>
						</tr>
					</table>

					<div class="field" style="margin-top: 20px;"><input type="submit" name="join" value="Join VSA" id="join-btn"></div>
				</div>
			</div>
		</form>

	<?php else: ?>
		
		<div class="outer-wrapper white center">
			<div class="inner-wrapper">
				<h3>You are already a member of VSA!</h3>
			</div>
		</div>

	<?php endif; ?>
<?php include $t->load("template/footer.php"); ?>