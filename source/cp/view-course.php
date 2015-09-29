<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

$course_id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : 0;
$course_status = (!isset($_GET['status']) || $_GET['status'] > 2) ? '1' : $_GET['status'];

$_courses = new Courses();
$course = $_courses->get($_GET['id']);

$course_title = ($_courses->getCount() != 0) ? $course->name : "Course Not Found";

$t->setTitle($course_title);

$q = DB::$db->prepare("
	SELECT *, users.id AS user_id, enrolments.id AS enrolment_id
	FROM enrolments
	INNER JOIN users
	ON enrolments.user_id = users.id
	WHERE course_id = :course_id
	AND status = :status
");

$q->execute([
	':course_id' => $course_id,
	':status' => $course_status
]);

$c = $q->rowCount();

include $t->load("template/head.php");
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1><?=$course_title;?></h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<div id="feedback"></div>
				<?php if($_courses->getCount() != 0): ?>

					<table class="style">
						<tr>
							<th>User ID</th>
							<th>Name</th>
							<th>Status in Course</th>
							<th>Change Status</th>
							<th>Delete Application</th>
						</tr>

						<?php while($r = $q->fetch(PDO::FETCH_OBJ)): ?>

								<tr>
									<td><?=$r->user_id;?></td>
									<td><a href="<?=PATH?>cp/view-user?id=<?=$r->user_id;?>"><?=$r->username;?></a></td>
									<td><?=($r->status === '0') ? '<span class="text-orange">Pending</span>' : '<span class="text-green">Active</span>';?></td>
									<td><?=($r->status === '0') ? '<a href="#" class="btn enrol-btn" data-status="1" data-enrolment-id="'.$r->enrolment_id.'">Enrol</a>' : '<a href="#" class="btn enrol-btn" data-status="0" data-enrolment-id="'.$r->enrolment_id.'">Change to Pending</a>';?></td>
									<td><a href="#" data-link="<?=PATH;?>cp/delete-enrolment?id=<?=$r->enrolment_id;?>" class="btn delete-btn"><i class="fa fa-times"></i></a></td>
								</tr>

						<?php endwhile; ?>

					</table>

				<?php else: ?>

					<div class="notice-box yellow-notice">The course ID you're looking for does not exist.</div>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$(".enrol-btn").click(function() {
				$("#feedback").html('<div class="center"><img src="../img/ajax-loader.gif"></div>');
				
				$.ajax({
					type: "POST",
					url: "../ajax/change-course-status.php",
					data: {
						status: $(this).attr("data-status"),
						enrolment_id: $(this).attr("data-enrolment-id")
					},
					success: function(data) {
						$("#feedback").hide().html(data).fadeIn();
					},
					error: function() {
						$("#feedback").hide().html("An error as occured").fadeIn();
					}
				});
				$(this).closest("tr").remove();
				return false;
			});
		});
	</script>
<?php include $t->load("template/footer.php"); ?>