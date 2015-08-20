<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Recover Password");
$t->setTags("forgot, password, recover");

include $t->load("includes/init.php");

if(Login::loggedIn())
	Utility::redirect();

include $t->load("template/head.php");
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1>Recover Password</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php
			if(isset($_POST['submit'])) {
				$user = new User;
				echo $user->recoverPassword($_POST['info']);
			}
			?>

			<p>Please use the form below to reset your VSA account password.</p>

			<form method="post">
				<div class="field">
					<label for="info">Enter username or email</label>
				</div>
				<div class="field">
					<input type="text" name="info" id="info">
				</div>
				<div class="field">
					<input type="submit" name="submit" id="submit" value="Recover Password">
				</div>
			</form>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>