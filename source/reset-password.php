<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Reset Password");
$t->setTags("reset, password");

include $t->load("includes/init.php");

if(Login::loggedIn())
	Utility::redirect();

include $t->load("template/head.php");
include $t->load("template/header.php");

$id = (isset($_GET['id'])) ? (int)$_GET['id'] : null;
$reset_code = (isset($_GET['code'])) ? $_GET['code'] : null;

$user = new User;

$username = $user->get($id)->username;
?>	
	<div id="page-heading">
		<h1>Reset <?=$username;?>'s Password</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php
			if(isset($_POST['submit'])) {
				echo $user->resetPassword(
					$id,
					$reset_code,
					$_POST['password'],
					$_POST['r_password']
				);
			}
			?>
			<p>Please use the form below to set your new VSA account password.</p>

			<form method="post">
				<div class="field">
					<label for="password">New Password</label>
				</div>
				<div class="field">
					<input type="password" name="password" id="password" autofocus>
				</div>
				<div class="field">
					<label for="r_password">Repeat New Password</label>
				</div>
				<div class="field">
					<input type="password" name="r_password" id="r_password">
				</div>
				<div class="field">
					<input type="submit" name="submit" id="submit" value="Reset Password">
				</div>
			</form>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>