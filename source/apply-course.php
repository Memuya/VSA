<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

include $t->load("includes/init.php");

//if the course id is not set in the url make it equal 0
//this will result in the count to be 0 and return the Not Found message
$course_id = (isset($_GET['id'])) ? $_GET['id'] : 0;

$_courses = new Courses;
//get all course information
$course = $_courses->get($course_id);
//set title
$title = ($_courses->getCount() != 0) ? $course->name : "Not Found";

$_user = new User;
//check if user is logged in and then get their information and apply it to the form elements
$user = (Login::loggedIn()) ? $_user->get($_SESSION['logged']) : null;

$t->setTitle($title);

include $t->load("template/head.php");
?>
<script>
	$(document).ready(function() {
		$("#apply").click(function() {
			var c = confirm("Confirm Application for this course?");

			if(c) {
				$("#feedback").html('<div class="center"><img src="img/ajax-loader.gif"></div>');
				$.ajax({
					type: "POST",
					url: "ajax/apply-course.php",
					data: $("#form").serialize(),
					success: function(data) {
						$("#feedback").hide().html(data).fadeIn();
					}
				});

				//resets recaptcha; needed because of ajax messing with it
				if(!$("#apply").hasClass("logged-in-apply")) {
					grecaptcha.reset();
				}

				return false;
			} else {
				return false;
			}
		});

		$('table.style').stacktable();
	});
</script>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<style>
	.g-recaptcha div { margin: auto }
</style>
<?php
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1><?=$title;?></h1>
	</div>
	<div class="outer-wrapper white center">
		<div class="inner-wrapper">
			<?php if($_courses->getCount() != 0): ?>

				<?php if($course->expired === '1'): ?>

					<div class="notice-box yellow-notice text-left">Sorry, but this course has expired. We apologize for any inconvenience this may have caused.</div>
					<div class="center"><a href="<?=PATH;?>courses" class="btn">Find more short courses</a></div>

				<?php else: ?>

					<div id="feedback"></div>

					<h2>Thank you for showing an interest in the <span class="text-red">"<?=$course->name;?>"</span> course.</h2>
					<p>
						Please confirm below that you would like to apply for this course. 

						<?php if(!Login::loggedIn()): ?> 
							Applying for a course registers you as a special "Course Member" that has access to the VSA site for 1 year. If you already have an account with VSA, please login first before applying for a course.
						<?php endif; ?>
					</p>

					<table class="style">
						<tr>
							<th>Code</th>
							<th>Course</th>
							<th>Duration</th>
							<th>When</th>
							<th>Time</th>
							<th>Where</th>
							<th>Cost</th>
						</tr>
						<tr>
							<td><?=$course->code;?></td>
							<td><?=$course->name;?></td>
							<td><?=$course->duration;?></td>
							<td><?=$course->date;?></td>
							<td><?=$course->time;?></td>
							<td><?=nl2br($course->location);?></td>
							<td title="Members of VSA are entitled to a <?=Courses::getDiscount();?>% discount for courses">$<?=(Login::loggedIn() && !Login::check("course_member")) ? $course->cost * ((100-Courses::getDiscount()) / 100) : $course->cost;?>*</td>
						</tr>
					</table>

					<!--
					<a href="#" class="btn confirm-application">Confirm Application</a>

					<p><i>Developer Note: Maybe add the user into this course and then redirect them to their enrollment page in their account. There they can be presented with a message telling them that they can send money to an address.</i></p>
					-->

					<div class="outer-wrapper no-border">
						<div class="inner-wrapper">
							<?php if(Login::loggedIn()): ?>

								<p>You are logged in as <?=$_user->get($_SESSION['logged'])->username;?> (<?=$_user->get($_SESSION['logged'])->fname." ".$_user->get($_SESSION['logged'])->lname;?>). Applying for this course will attached it to this account.</p>

								<form id="form">
									<input type="hidden" name="course_id" value="<?=$course->id;?>">
									<div class="field" style="margin-top: 20px;"><input type="submit" name="apply" value="Confirm Application" id="apply" class="logged-in-apply"></div>
								</form>

							<?php else: ?>

								<div class="text-right"><span class="text-red">*</span> <span class="fine-text">Required Fields</span></div>
								<h1>Contact Information</h1>

								<form id="form">
									<table style="width: 100%;">
										<tr>
											<td>
												<div class="field">
													<label for="company">Institude/Company</label>
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
														<option></option>
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
										<tr>
											<td colspan="2" class="center" style="padding: 20px 0px;">
												<div class="g-recaptcha" data-sitekey="6LekSwoTAAAAAKWbXV7XiVpnIXxR3pqcBukom39r"></div>
											</td>
										</tr>
									</table>

									<input type="hidden" name="course_id" value="<?=$course->id;?>">

									<div class="field" style="margin-top: 20px;"><input type="submit" name="apply" value="Confirm Application" id="apply"></div>
								</form>

							<?php endif; ?>
	
						</div>
					</div>

				<?php endif; ?>

			<?php else: ?>

				<div class="notice-box yellow-notice text-left">Sorry, but the course you are looking for does not exist.</div>
				<a href="<?=PATH;?>courses" class="btn">Find more short courses</a>

			<?php endif; ?>
		</div>
	</div>

<?php include $t->load("template/footer.php"); ?>