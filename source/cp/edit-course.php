<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Edit Course");

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
				url: "../ajax/edit-course.php",
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

$_courses = new Courses;
$course = $_courses->get($_GET['id']);
?>	
	<div id="page-heading">
		<h1>Edit Course</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">

			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<?php if($_courses->getCount() != 0): ?>

					<div id="feedback"></div>
					<form id="form">
						<table class="style">
							<tr>
								<th>Course Code</th>
								<td><input type="text" name="code" id="code" value="<?=Validate::output($course->code);?>"></td>
							</tr>
							<tr>
								<th>Name</th>
								<td><input type="text" name="name" id="name" value="<?=Validate::output($course->name);?>"></td>
							</tr>
							<tr>
								<th>Duration</th>
								<td><input type="text" name="duration" id="duration" value="<?=Validate::output($course->duration);?>"></td>
							</tr>
							<tr>
								<th>When</th>
								<td><input type="text" name="when" id="when" value="<?=Validate::output($course->date);?>"></td>
							</tr>
							<tr>
								<th>Time</th>
								<td><input type="text" name="time" id="time" value="<?=Validate::output($course->time);?>"></td>
							</tr>
							<tr>
								<th>Where</th>
								<td><input type="text" name="where" id="where" value="<?=Validate::output($course->location);?>"></td>
							</tr>
							<tr>
								<th>Cost</th>
								<td><input type="text" name="price" id="price" value="<?=Validate::output($course->cost);?>"></td>
							</tr>
							<tr>
								<th>Status</th>
								<td>
									<select name="expired">
										<option value="0" <?=($course->expired == '0') ? 'selected' : null?>>Active</option>
										<option value="1" <?=($course->expired == '1') ? 'selected' : null?>>Exipred</option>
									</select>
								</td>
							</tr>
						</table>
						<input type="hidden" name="id" id="id" value="<?=$course->id;?>">
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