<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Courses");
$t->setTags("courses, short courses, apply");

include $t->load("includes/init.php");

include $t->load("template/head.php");
?>
<script>
	$(document).ready(function() {
		$('table.style').stacktable();
	});
</script>
<?php
include $t->load("template/header.php");

$_courses = new Courses;
$courses = $_courses->getAll();
?>	
	<div id="page-heading">
		<h1>Short Courses</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php if($_courses->getCount() != 0): ?>

				<?php if(!Login::loggedIn()): ?>
					<div class="rfloat fine-text login-btn" style="margin-bottom: 5px;"><a href="login">Login</a> to get a discount on a course</div>
					<div class="clear"></div>
				<?php endif; ?>

					<?php foreach($courses as $course): ?>

						<h2><?=$course->name;?></h2>
						<table class="style">
							<tr>
								<th>Code</th>
								<th>Duration</th>
								<th>When</th>
								<th>Time</th>
								<th>Where</th>
								<th>Cost</th>
							</tr>
							<tr>
								<td><?=$course->code;?></td>
								<td><?=$course->duration;?></td>
								<td><?=$course->date;?></td>
								<td><?=$course->time;?></td>
								<td><?=nl2br($course->location);?></td>
								<td title="Members of VSA are entitled to a  <?=Courses::getDiscount();?> discount">$<?=(Login::loggedIn() && !Login::check("course_member")) ? $course->cost * ((100-Courses::getDiscount()) / 100) : $course->cost;?>*</td>
							</tr>
						</table>

						<?=($course->expired == 0) ? '<a href="apply-course?id='.$course->id.'" class="btn rfloat">Apply</a>' : '<a href="#" onclick="return false" class="btn rfloat" style="cursor: not-allowed; background: #AAA;">Expired</a>';?>
						<div class="clear"></div>

					<?php endforeach; ?>

				</table>

			<?php else: ?>

				<h3 class="center">There are currently no short courses available at this time. Please be sure to check again in the near future!</h3>

			<?php endif; ?>

			<p class="fine-text center">*Special rates for Members, Corporates, and Students (inc.Post Grads). Also available IN-SERVICE courses by negotiation. For further details and course information go to <a href="http://www.vsacourses.com" target="_blank">http://www.vsacourses.com</a></p>
		</div>
	</div>

	<div class="outer-wrapper light-grey">
		<div class="inner-wrapper">
			<h1>Vacuum Technology</h1>
			<ul style="list-style-type: none;">
				<li><b>Fundamentals</b> — Basic concepts, gas laws, kinetic theory, conductance formulae etc.</li>
				<li><b>Pumps and Systems</b> — Roots, Rotary, Diffusion, Turbo, Cryo, Sorb, Sublimation, Sputter-ion pumps.</li>
				<li><b>Gauges</b> — Thermal conductivity gauges, Ionisation gauges, Mass Spectrometers.</li>
				<li><b>Materials and Accessories</b> — Outgassing , Vapour pressures, Chambers, Valves, Fittings.</li>
				<li><b>Leak Detection</b> — Virtual and Real leaks, Types of detectors, Techniques, Use of MSLD.</li>
				<li><b>Computer Lab Sessions</b> — Individual inter-active operation of pumping systems & detectors.</li>
			</ul>
		</div>
	</div>

	<div class="outer-wrapper grey">
		<div class="inner-wrapper">
			<h1>Preview our Content</h1>
			<p>Take a look at what you'll be learning about in the short courses available above. Check out our interactive Single Cycle Diffusion Pump animation!</p>
			<a href="http://www.vacuumsociety.org.au/lab.php?linkLab=1&url=/files/flash/Single_Cycle_Diffusion_Pump.swf"><img src="img/flash-animation.png" style="width: 50%;"></a>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>