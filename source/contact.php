<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Contact Us");
$t->setTags("contact, message, email, contact us");

include $t->load("includes/init.php");

$_user = new User;
//if user is logged in, we get their information to fill in the form
if(Login::loggedIn())
	$user = $_user->get($_SESSION['logged']);

include $t->load("template/head.php");
?>
<script>
	$(document).ready(function() {
		$("#send").click(function() {
			$("#feedback").html('<div class="center"><img src="img/ajax-loader.gif"></div>');
			$.ajax({
				type: "POST",
				url: "ajax/contact.php",
				data: $("#form").serialize(),
				success: function(data) {
					$("#feedback").hide().html(data).fadeIn();
				}
			});

			return false;
		});
	});
</script>
<?php
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1>Contact Us</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
		<div id="feedback"></div>

			<p>Please use the form below to contact the VSA or email us directly at <a href="mailto:support@vaccumsociety.org.au">support@vaccumsociety.org.au</a>. You will receive a reply as soon as possible.</p>
			<form id="form">
				<div class="field">
					<label for="name">Your Name</label>
				</div>
				<div class="field">
					<input type="text" name="name" id="name" value="<?=(Login::loggedIn()) ? $user->fname." ".$user->lname : null;?>">
				</div>
				<div class="field">
					<label for="email">Email Address</label>
				</div>
				<div class="field">
					<input type="email" name="email" id="email" value="<?=(Login::loggedIn()) ? $user->email : null;?>">
				</div>
				<div class="field">
					<label for="subject">Subject</label>
				</div>
				<div class="field">
					<input type="text" name="subject" id="subject">
				</div>
				<div class="field">
					<label for="message">Message</label>
				</div>
				<div class="field">
					<textarea name="message" id="message"></textarea>
				</div>
				<div class="field">
					<input type="submit" name="send" id="send" value="Send">
				</div>
			</form>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>