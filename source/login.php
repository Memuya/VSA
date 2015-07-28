<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Login");
$t->setTags("login, sign in, signin");

include $t->load("includes/init.php");

if(Login::loggedIn())
	Utility::redirect("index");

include $t->load("template/head.php");
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1>Login</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<p>Please use the form below to login to your VSA account.</p>
			
			<?php if(isset($_POST['login'])): ?>
				<?php
				$login = new Login($_POST['username'], $_POST['password']);

				echo $login->init();
				?>
			<?php endif; ?>

			<form method="post" action="login">
				<div class="field">
					<label for="username">Username</label>
				</div>
				<div class="field">
					<input type="text" name="username" id="username" class="input-username" autofocus>
				</div>
				<div class="field">
					<label for="password">Password</label>
				</div>
				<div>
					<input type="password" name="password" id="password">
				</div>
				<div class="field">
					<input type="submit" name="login" id="login" value="Login">
				</div>

				<div class="field">
					<a href="<?=PATH;?>forgot-password">Forgot your password?</a>
				</div>
			</form>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>