<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Edit News Article");

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
			url: "../ajax/edit-news.php",
			data: {
				title: $("#title").val(),
				body: $("#body").val(),
				id: <?=$_GET["id"];?>
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

//inisiate news object
$news = new News;
//get all aedticles from database
$article = $news->get($_GET["id"]);
?>	
	<div id="page-heading">
		<h1>Edit News Article</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<?php if($news->getCount() != 0): ?>

					<div id="feedback"></div>

					<?php
					//if(isset($_POST['update']))
						//echo $news->edit($_GET["id"], $_POST["body"], $_POST["title"]);
					?>

					<form method="post">
						<div class="field">
							<label for="title">Title</label>
						</div>
						<div class="field">
							<input type="text" name="title" id="title" value="<?=Validate::output($article->title);?>">
						</div>
						<div class="field">
							<textarea id="body" name="body"><?=$article->body;?></textarea>
							<script>CKEDITOR.replace('body');</script>
						</div>
						<div class="field">
							<input type="submit" name="update" id="update" value="Update News Article">
						</div>
					</form>

				<?php else: ?>

					<div class="notice-box yellow-notice">The news article you are looking for does not exist.</div>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>