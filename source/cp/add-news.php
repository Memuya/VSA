<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Add News Article");

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
	$("#submit").click(function() {
		$("#feedback").html('<div class="center"><img src="../img/ajax-loader.gif"></div>');
		//call the ckupdate function here
		CKupdate();

		//ajax
		$.ajax({
			type: "POST",
			url: "../ajax/add-news.php",
			data: {
				title: $("#title").val(),
				body: $("#body").val()
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

$news = new News;
?>	
	<div id="page-heading">
		<h1>Add News Article</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<div id="feedback"></div>

				<form method="post">
					<div class="field">
						<label for="title">Title</label>
					</div>
					<div class="field">
						<input type="text" name="title" id="title">
					</div>
					<div class="field">
						<textarea name="body" id="body"></textarea>
						<script>CKEDITOR.replace('body');</script>
					</div>
					<div class="field">
						<input type="submit" name="submit" id="submit" value="Submit">
					</div>
				</form>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>