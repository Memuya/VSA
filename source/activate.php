<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Account Activation");

include $t->load("includes/init.php");

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$code = isset($_GET['code']) ? $_GET['code'] : null;

try {
	$q = DB::$db->prepare("
		SELECT id, activation_code
		FROM users
		WHERE id = :id
		AND activation_code = :code
		AND active = '0'
	");

	$q->execute([
		':id' => $id,
		':code' => $code
	]);
} catch(PDOException $ex) {
	die($ex->getMessage());
}

$c = $q->rowCount();

include $t->load("template/head.php");
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1>Account Activation</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php if($c == 0): ?>

				<div class="notice-box yellow-notice">
					The link you have followed is not valid or your account is already active. Please follow the URL provided in your email. If this problem consists, please <a href="<?=PATH;?>contact">contact us</a>.
				</div>

			<?php else: ?>

				<?php
				//actiate account
				try {
					$q = DB::$db->prepare("
						UPDATE users
						SET active = '1'
						WHERE id = :id
					");
					$q->execute([':id' => $id]);
				} catch(PDOException $ex) {
					die($ex->getMessage());
				}
				?>

				<div class="notice-box green-notice">
					Your account has been successfully activated! You are now able to log in to your account.
				</div>

				<div class="center">
					<a href="<?=PATH;?>login" class="login-btn btn">Login</a>
				</div>

			<?php endif; ?>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>