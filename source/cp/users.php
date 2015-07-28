<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Users");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
?>
<script> 
/*
	$(document).ready(function() {
		$("#search").keyup(function() {
			$.ajax({
				type: "POST",
				url: "../ajax/search-user.php",
				data: $("#form").serialize(),
				success: function(data) {
					$(".test").html(data);
					
				}
			});
		});
	});
*/
</script>
<?php
include $t->load("template/header.php");

$_user = new User;

//if the search variable is passed through the url
//we call the search method
//or else we call the getAll method
$users = (isset($_GET['search'])) ? $_user->search($_GET['search']) : $_user->getAll((isset($_GET['page']) && !empty($_GET['page'])) ? $_GET['page'] : 1);
?>	
	<div id="page-heading">
		<h1>Users</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<p class="rfloat fine-text"><?=$_user->getCount();?> User<?=($_user->getCount() !== 1) ? 's' : null;?> Found</p>
				<form id="form">
					<div class="field">
						<input type="text" name="search" id="search" placeholder="Search Username" style="width: 200px;">
					</div>
				</form>

				<?php if(!empty($users)): ?>

					<?php if($_user->getCount() != 0): ?>
						
						<table class="style">
							<tr>
								<th>ID</th>
								<th>Username</th>
								<th>Email</th>
								<th>Membership</th>
								<th>Blocked?</th>
								<th>Active?</th>
							</tr>

						<?php foreach($users as $user): ?>

							<tr>
								<td><?=$user->id;?></td>
								<td><a href="<?=PATH;?>cp/view-user?id=<?=$user->id;?>"><?=$user->username;?></a></td>
								<td><?=$user->email;?></td>
								<td><?php if($user->type === '1'): ?> Student <?php elseif($user->type === '2'): ?> General <?php else: ?> Corporate <?php endif;?></td>
								<td style="<?=($user->blocked === '1') ? 'background: red;' : 'background: green;';?>"></td>
								<td style="<?=($user->active === '1') ? 'background: green;' : 'background: red;';?>?>"></td>
							</tr>

						<?php endforeach; ?>

						</table>

						<?=$_user->getPageLinks(PATH."cp/users");?>

					<?php else: ?>

						<div class="notice-box yellow-notice">No users found</div>

					<?php endif; ?>

				<?php else: ?>

					<?php if($_user->getCount() != 0): ?>

						<table class="style">
							<tr>
								<th>Username</th>
								<th>Email</th>
								<th>Membership</th>
								<th>Blocked?</th>
								<th>Active?</th>
							</tr>

							<?php foreach($users as $user): ?>

								<tr>
									<td><a href="<?=PATH;?>cp/view-user?id=<?=$user->id;?>"><?=$user->username;?></a></td>
									<td><?=$user->email;?></td>
									<td><?php if($user->type === '1'): ?> Student <?php elseif($user->type === '2'): ?> General <?php else: ?> Corporate <?php endif;?></td>
									<td style="<?=($user->blocked === '1') ? 'background: red;' : 'background: green;';?>"></td>
									<td style="<?=($user->active === '1') ? 'background: green;' : 'background: red;';?>?>"></td>
								</tr>

							<?php endforeach; ?>

						</table>

					<?php else: ?>

						<div class="notice-box yellow-notice">No users by that search query could be found.</div>

					<?php endif; ?>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>