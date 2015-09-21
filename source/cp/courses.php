<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Courses");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
include $t->load("template/header.php");

$_courses = new Courses;
$courses = $_courses->getAll();
?>	
	<div id="page-heading">
		<h1>Courses</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<?php if($_courses->getCount() != 0): ?>

					<p class="text-right fine-text"><?=$_courses->getCount();?> Course<?=($_courses->getCount() !== 1) ? 's' : null;?></p>

					<table class="style">
						<tr>
							<th>Code</th>
							<th>Course</th>
							<th>Status</th>
							<th>Active</th>
							<th>Pending</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>

						<?php foreach($courses as $course): ?>

							<tr>
								<td><?=$course->code;?></td>
								<td><a href="<?=PATH?>apply-course?id=<?=$course->id;?>"><?=$course->name;?></a></td>
								<td><?=($course->expired == 0) ? '<span class="text-green">Active</span>' : '<span class="text-red">Expired</span>';?></td>
								<td><a href="<?=($_courses->getEnrolmentCount($course->id, 1) == 0) ? 'javscript:void(0);' : PATH.'cp/view-course?id='.$course->id.'&status=1';?>" class="btn"><?=$_courses->getEnrolmentCount($course->id, 1)?></a></td>
								<td><a href="<?=($_courses->getEnrolmentCount($course->id, 0) == 0) ? 'javscript:void(0);' : PATH.'cp/view-course?id='.$course->id.'&status=0';?>" class="btn"><?=$_courses->getEnrolmentCount($course->id, 0)?></a></td>
								<td><a href="<?=PATH?>cp/edit-course?id=<?=$course->id;?>" class="btn"><i class="fa fa-pencil-square-o"></i></a></td>
								<td><a href="#" data-link="<?=PATH?>cp/delete-course?id=<?=$course->id;?>" class="delete-btn btn"><i class="fa fa-times"></i></a></td>
							</tr>

						<?php endforeach; ?>

					</table>

				<?php else: ?>

					<div class="notice-box yellow-notice">No courses found</div>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>