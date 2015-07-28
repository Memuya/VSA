<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Create a Page");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
?>
<script src="<?=PATH;?>ckeditor.js"></script>
<?php
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1>Create a Page</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">

			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<div class="field">
						<textarea style="height: 300px;" id="page" name="page"></textarea>
						<script>CKEDITOR.replace('page');</script>
					</div>
					<div class="field">
						<input type="submit" name="create" id="create" value="Create Page">
					</div>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>