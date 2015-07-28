<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

include $t->load("includes/init.php");
include $t->load("template/head.php");

//query database for welcome message
$q = DB::$db->query("
	SELECT body
	FROM welcome_message
");

//return result of query
$r = $q->fetch(PDO::FETCH_OBJ);
?>
<style>
	html {
		height: 100%;
	}

	body {
		margin: 0 0 0 200px;
		padding: 0;
		font-size: 12px;
		height: 100%;
		font-family: arial;
	}

	header {
		height: 40px;
		background: #B20000;
		padding: 0 0 0 10px;
		line-height: 40px;
	}

	h1 {
		color: #FFF;
		font-size: 20px;
		font-weight: bold;
		margin: 0;
		padding: 0;
	}

	nav#cp-nav {
		position: absolute;
		width: 200px;
		top: 0px;
		left: 0;
		background: #333;
		color: #FFF;
		height: 100%;
	}

	#content {
		padding: 10px;
	}
</style>
<script src="<?=PATH;?>ckeditor.js"></script>
</head>
<body>
	<header>
		<h1>Update Welcome Message</h1>
	</header>
	
	<?php include $t->load("template/cp-nav-new.php"); ?>

	<div id="content">
		<p>Update the welcome message on the home page.</p>
		<form method="post">
			<div class="field">
				<textarea style="height: 100%; width: 100%;" id="message" name="message"><?=$r->body;?></textarea>
				<script>CKEDITOR.replace('message');</script>
			</div>
			<div class="field">
				<input type="submit" name="update" value="Update Welcome Message">
			</div>
		</form>
	</div>
</body>
</html>