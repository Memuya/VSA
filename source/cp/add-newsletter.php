<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("Add Newsletter");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1>Add Newsletter</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<?php
				if(isset($_POST['upload'])) {
					$newsletter = new Newsletters;
					echo $newsletter->upload(
						$_POST['title'],
						$_FILES['pdf']
					);
				}
				?>
				<p>Upload a PDF file to be shown to registered users.</p>
				<form method="post" enctype="multipart/form-data">
					<div class="field">
						<label for="title">Newsletter Title</label>
					</div>
					<div class="field">
						<input type="text" name="title" id="title">
					</div>
					<div class="field">
						<label for="pdf">Upload PDF</label>
					</div>
					<div class="field">
						<input type="file" name="pdf" id="pdf">
					</div>
					<div class="field">
						<input type="submit" name="upload" id="upload" value="Upload">
					</div>
				</form>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>