<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Update Privacy Policy");

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
			url: "../ajax/update-privacy.php",
			data: {
				message: $("#message").val(),
				override: $(".override:checked").val(),
				policy_id: $("#policy_id").val()
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
	SELECT *
	FROM privacy_policy
	ORDER BY id DESC
	LIMIT 1
");

//returbn result of query
$r = $q->fetch(PDO::FETCH_OBJ);
?>	
	<div id="page-heading">
		<h1>Update Privacy Policy</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<div id="feedback"></div>
				
				<p>Update the current privacy policy or create a new one.</p>
				<form>
					<div class="field">
						<textarea style="height: 300px;" id="message" name="message"><?=$r->body;?></textarea>
						<script>CKEDITOR.replace('message');</script>
					</div>
					<div class="field">
						<label>How to save?</label>
					</div>
					<div class="field">
						<label title="Updates the current policy. Does not create a new policy.">
							<input type="radio" class="override" name="override" value="1"> Update current policy
						</label> &nbsp;&nbsp;

						<label title="Creates a new policy that does not override the existing one. Older policies are kept in the database.">
							<input type="radio" class="override" name="override" value="2"> Create new policy
						</label>
					</div>
					<div class="field">
						<input type="submit" name="update" id="update" value="Update Welcome Message">
					</div>
					<input type="hidden" name="policy_id" id="policy_id" value="<?=$r->id;?>">
				</form>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>