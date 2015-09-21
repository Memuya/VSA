<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("acc_");

$t->setTitle("My Enrolments");

include $t->load("includes/init.php");

if(!Login::loggedIn())
	Utility::redirect("index");

include $t->load("template/head.php");
include $t->load("template/header.php");

$_courses = new Courses;
$enrolments = $_courses->getUserEnrolments($_SESSION['logged']);
?>	
	<div id="page-heading">
		<h1>My Enrolments</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php include $t->load("template/account-nav.php"); ?>

			<section class="right-main">
				<?php if($_courses->getCount() != 0): ?>

					<p>Below is a list of courses that you have applied for and their current status.</p>
					<ul>
						<li><span class="text-green"><b>Enrolled</b></span> - You are currently enrolled in this course</li>
						<li><span class="text-orange"><b>Pending</b></span> - Awaiting approval to be enrolled into this course. Will be updated to <span class="text-green"><b>enrolled</b></span> after payment has been recieved</li>
						<li><span class="text-red"><b>Expired</b></span> - The course has expired</li>
					</ul>

					<table class="style">
						<tr>
							<th>Course Code</th>
							<th>Course Name</th>
							<th>Status</th>
							<th>Payment Required</th>
						</tr>

						<?php foreach($enrolments as $enrolment): ?>

							<tr>
								<td><?=$enrolment->code;?></td>
								<td><?=$enrolment->name;?></td>
								<td>
									<?php if($enrolment->expired == '1'): ?>
										<span class="text-red"><b>Expired</b></span>
									<?php elseif($enrolment->status === '1'): ?>
										<span class="text-green"><b>Enrolled</b></span>
									<?php elseif($enrolment->status === '0'): ?>
										<span class="text-orange"><b>Pending</b></span>
									<?php endif; ?>
								</td>
								<td>$<?=($enrolment->status === '0') ? $enrolment->payment_required : 0;?></td>
							</tr>

						<?php endforeach; ?>
					</table>

				<?php else: ?>

					<div class="notice-box yellow-notice">You have not enrolled for any short courses.</div>
					<div class="center">
						<a href="<?=PATH;?>courses" class="btn">Find a Short Courses</a>
					</div>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>