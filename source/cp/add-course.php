<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Add Course");

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
				url: "../ajax/add-course.php",
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
		<h1>Add Course</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<div id="feedback"></div>
				<form id="form">
					<table class="style">
						<tr>
							<th>Course Code</th>
							<td><input type="text" name="code" id="code"></td>
						</tr>
						<tr>
							<th>Name</th>
							<td><input type="text" name="name" id="name"></td>
						</tr>
						<tr>
							<th>Duration</th>
							<td><input type="text" name="duration" id="duration"></td>
						</tr>
						<tr>
							<th>When</th>
							<td><input type="text" name="when" id="when"></td>
						</tr>
						<tr>
							<th>Time</th>
							<td><input type="text" name="time" id="time"></td>
						</tr>
						<tr>
							<th>Where</th>
							<td><input type="text" name="where" id="where"></td>
						</tr>
						<tr>
							<th>Cost</th>
							<td><input type="text" name="price" id="price"></td>
						</tr>
					</table>
					<input type="submit" name="add" id="add" value="Add">
				</form>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>