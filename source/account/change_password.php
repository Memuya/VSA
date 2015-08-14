<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("acc_");

$t->setTitle("Change Password");

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
		$("#change_pass").click(function() {
			$("#feedback").html('<div class="center"><img src="../img/ajax-loader.gif"></div>');
			$.ajax({
				type: "POST",
				url: "../ajax/update-password.php",
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
		<h1>Change Password</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php include $t->load("template/account-nav.php"); ?>

			<section class="right-main">
				<div id="feedback"></div>

				<form id="form" method="post">
					<table class="style">
						<tr>
							<th>Current Password</th>
							<td><input type="password" name="current_pass" id="current_pass"></td>
						</tr>
						<tr>
							<th>New Password</th>
							<td><input type="password" name="new_pass" id="new_pass"></td>
						</tr>
						<tr>
							<th>Repeat Password</th>
							<td><input type="password" name="repeat_pass" id="repeat_pass"></td>
						</tr>
					</table>
					<input type="submit" name="change_pass" id="change_pass" value="Change Password">
				</form>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>