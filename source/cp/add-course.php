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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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

		$("#when").datepicker({dateFormat: 'yy-mm-dd'});
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
							<td><input type="text" name="code" id="code" placeholder="E.g. VTY"></td>
						</tr>
						<tr>
							<th>Name</th>
							<td><input type="text" name="name" id="name" placeholder="Name of the course"></td>
						</tr>
						<tr>
							<th>Duration</th>
							<td><input type="text" name="duration" id="duration" placeholder="2 weeks"></td>
						</tr>
						<tr>
							<th>When</th>
							<td><input type="text" name="when" id="when" placeholder="YYY-MM-DD"></td>
						</tr>
						<tr>
							<th>Time</th>
							<td><input type="text" name="time" id="time" placeholder="8:00am - 10:00am"></td>
						</tr>
						<tr>
							<th>Where</th>
							<td><input type="text" name="where" id="where" placeholder="Victoria University, Footscray"></td>
						</tr>
						<tr>
							<th>Cost</th>
							<td><input type="text" name="price" id="price" placeholder="Do not include a dollar sign"></td>
						</tr>
					</table>
					<input type="submit" name="add" id="add" value="Add">
				</form>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>