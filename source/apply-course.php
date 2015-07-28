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
		$('table.style').stacktable();
		
		$(".confirm-application").click(function() {
			alert("Send an email and show a success message");
		});
	});
</script>
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

					<div class="notice-box yellow-notice">Sorry, but this course has expired. We apologize for any inconvenience this may have caused.</div>
					<div class="center"><a href="<?=PATH;?>courses" class="btn">Find more short courses</a></div>

				<?php else: ?>

					<?php
					if(isset($_POST['apply'])) {
						$is_member = (Login::loggedIn()) ? $_SESSION['logged'] : null;
						echo $_courses->apply(
							$is_member,
							$_POST['course_id']
						);
					}
					?>

					<p>Thank you for showing an interest in the <strong>"<?=$course->name;?>"</strong> course. Please confirm below that you would like to apply for this course.</p>

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
							<td title="Members of VSA are entitled to a 20% discount for courses">$<?=(Login::loggedIn()) ? $course->cost * ((100-20) / 100) : $course->cost;?>*</td>
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

								<form method="post">
									<input type="hidden" name="course_id" value="<?=$course->id;?>">
									<div class="field" style="margin-top: 20px;"><input type="submit" name="apply" value="Confirm Application" id="join-btn"></div>
								</form>

							<?php else: ?>

								<div class="text-right"><span class="text-red">*</span> <span class="fine-text">Required Fields</span></div>
								<h1>Contact Information</h1>
								<form method="post">
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
														<option value="Mr" <?=(!empty($user) && $user->title === 'Mr') ? 'selected' : null?>>Mr</option>
														<option value="Ms" <?=(!empty($user) && $user->title === 'Ms') ? 'selected' : null?>>Ms</option>
														<option value="Mrs" <?=(!empty($user) && $user->title === 'Mrs') ? 'selected' : null?>>Mrs</option>
														<option value="Dr" <?=(!empty($user) && $user->title === 'Dr') ? 'selected' : null?>>Dr</option>
														<option value="A/Prof" <?=(!empty($user) && $user->title === 'A/Prof') ? 'selected' : null?>>A/Prof</option>
														<option value="E/Prof" <?=(!empty($user) && $user->title === 'E/Prof') ? 'selected' : null?>>E/Prof</option>
														<option value="Prof" <?=(!empty($user) && $user->title === 'Prof') ? 'selected' : null?>>Prof</option>
														<option value="Sir" <?=(!empty($user) && $user->title === 'Sir') ? 'selected' : null?>>Sir</option>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="field">
													<label for="fname">First Name <span class="text-red">*</span></label>
												</div>
												<div class="field">
													<input type="text" name="fname" id="fname" required value="<?=(!empty($user)) ? $user->fname : null;?>">
												</div>
											</td>
											<td>
												<div class="field">
													<label for="lname">Last Name <span class="text-red">*</span></label>
												</div>
												<div class="field">
													<input type="text" name="lname" id="lname" required value="<?=(!empty($user)) ? $user->lname : null;?>">
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="field">
													<label for="address">Address <span class="text-red">*</span></label>
												</div>
												<div class="field">
													<input type="text" name="address" id="address" required value="<?=(!empty($user)) ? $user->address : null;?>">
												</div>
											</td>
											<td>
												<div class="field">
													<label for="suburb">Suburb <span class="text-red">*</span></label>
												</div>
												<div class="field">
													<input type="text" name="suburb" id="suburb" required value="<?=(!empty($user)) ? $user->suburb : null;?>">
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="field">
													<label for="state">State <span class="text-red">*</span></label>
												</div>
												<div class="field">
													<input type="text" name="state" id="state" value="<?=(!empty($user)) ? $user->state : null;?>">
												</div>
											</td>
											<td>
												<div class="field">
													<label for="postcode">Postcode <span class="text-red">*</span></label>
												</div>
												<div class="field">
													<input type="text" name="postcode" id="postcode" required value="<?=(!empty($user)) ? $user->postcode : null;?>">
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<div class="field">
													<label for="country">Country <span class="text-red">*</span></label>
												</div>
												<div class="field">
													<input type="text" name="country" id="country" required value="<?=(!empty($user)) ? $user->country : null;?>">
												</div>
											</td>
											<td>
												<div class="field">
													<label for="phone">Telephone <span class="text-red">*</span></label>
												</div>
												<div class="field">
													<input type="text" name="phone" id="phone" required value="<?=(!empty($user)) ? $user->telephone : null;?>">
												</div>
											</td>
										</tr>
									</table>

									<input type="hidden" name="course_id" value="<?=$course->id;?>">

									<div class="field" style="margin-top: 20px;"><input type="submit" name="apply" value="Confirm Application" id="join-btn"></div>
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