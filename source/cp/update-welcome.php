<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Update Welcome Message");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
?>
<script src="<?=PATH;?>ckeditor.js"></script>
<script>
//updates ckeditor element to allow ajax call
function CKupdate(){
    for (instance in CKEDITOR.instances)
        CKEDITOR.instances[instance].updateElement();
}

$(document).ready(function() {
	$("#update").click(function() {
		$("#feedback").html('<div class="center"><img src="../img/ajax-loader.gif"></div>');
		//call the ckupdate function here
		CKupdate();

		//ajax
		$.ajax({
			type: "POST",
			url: "../ajax/update-welcome.php",
			data: {
				message: $("#message").val()
			},
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

//query database for welcome message
$q = DB::$db->query("
	SELECT body
	FROM welcome_message
");

//returbn result of query
$r = $q->fetch(PDO::FETCH_OBJ);
?>	
	<div id="page-heading">
		<h1>Update Welcome Message</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<div id="feedback"></div>
				
				<p>Update the welcome message on the home page.</p>
				<form>
					<div class="field">
						<textarea style="height: 300px;" id="message" name="message"><?=$r->body;?></textarea>
						<script>CKEDITOR.replace('message');</script>
					</div>
					<div class="field">
						<input type="submit" name="update" id="update" value="Update Welcome Message">
					</div>
				</form>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>