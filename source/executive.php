<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Executives");

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

$_executives = new Executive;
$executives = $_executives->getAll();
?>	
	<div id="page-heading">
		<h1>Executive</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php if($_executives->getCount() != 0): ?>

				<table class="style">
					<tr>
						<th>Position</th>
						<th>Name</th>
						<th>Organization</th>
						<th>Details</th>
					</tr>

				<?php foreach($executives as $executive): ?>

					<tr>
						<td><b><?=$executive->position;?></b></td>
						<td><?=$_executives->getFullName($executive->id);?></td>
						<td><?=$executive->organization;?></td>
						<td><?=$executive->telephone;?><br><a href="mailto:<?=$executive->email;?>" title="Email <?=$_executives->getFullName($executive->id);?>"><?=$executive->email;?></a></td>
					</tr>

				<?php endforeach; ?>

				</table>

			<?php else: ?>

				<div class="notice-box yellow-notice">There are no executives to be displayed at this time.</div>

			<?php endif; ?>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>