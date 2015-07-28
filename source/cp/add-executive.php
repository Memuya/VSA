<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Add Executive");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
?>
<script>
	$(document).ready(function() {
		$("#add").click(function() {
			$("#feedback").html('<div class="center"><img src="../img/ajax-loader.gif"></div>');
			$.ajax({
				type: "POST",
				url: "../ajax/add-executive.php",
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
		<h1>Add Executive</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">

			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<div id="feedback"></div>
				<form id="form">
					<table class="style">
						<tr>
							<th>Position</th>
							<td><input type="text" name="position" id="position"></td>
						</tr>
						<tr>
							<th>Full Name</th>
							<td>
								<select name="title" id="title" style="width: 90px;">
									<option value="Mr">Mr</option>
									<option value="Ms">Ms</option>
									<option value="Mrs">Mrs</option>
									<option value="Dr">Dr</option>
									<option value="A/Prof">A/Prof</option>
									<option value="E/Prof">E/Prof</option>
									<option value="Prof">Prof</option>
									<option value="Sir">Sir</option>
								</select>
								<input type="text" name="fname" id="fname" placeholder="First Name">
								<input type="text" name="lname" id="lname" placeholder="Last Name">
							</td>
						</tr>
						<tr>
							<th>Organization</th>
							<td><input type="text" name="organization" id="organization"></td>
						</tr>
						<tr>
							<th>Phone</th>
							<td><input type="text" name="telephone" id="telephone"></td>
						</tr>
						<tr>
							<th>Email</th>
							<td><input type="text" name="email" id="email"></td>
						</tr>
					</table>
					<input type="submit" name="add" id="add" value="Add">
				</form>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>