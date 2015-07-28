<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("Advertisements");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
?>
<style>
	#cp-nav ul {
		margin: 0;
		padding: 0;
		border-bottom: 1px solid #CCC;
	}

	#cp-nav ul li {
		list-style-type: none;
		display: block;
		float: left;
		margin-right: 2px;
		background: #333;
		color: #FFF;
	}

	#cp-nav li a {
		color: #FFF;
		padding: 7px 20px;
		display: block;
		text-decoration: none;
	}

	nav#cp-sub-nav {
		background: #EEE;
	}

	#cp-sub-nav ul {
		margin: 0;
		padding: 0;
		border-bottom: 1px solid #CCC;
	}

	#cp-sub-nav ul li {
		list-style-type: none;
		display: block;
		float: left;
		color: #333;
	}

	#cp-sub-nav li a {
		color: #333;
		padding: 7px 20px;
		display: block;
		text-decoration: none;
	}

	#cp-sub-nav li a:hover {
		background: #CCC;
	}
</style>
<?php
include $t->load("template/header.php");
?>	
	<div id="page-heading">
		<h1>New Control Pannel Payout</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<nav id="cp-nav">
				<ul>
					<li><a href=""><i class="fa fa-wrench"></i> &nbsp; Pages</a></li>
					<li><a href=""><i class="fa fa-user"></i> &nbsp; Users</a></li>
					<li><a href=""><i class="fa fa-newspaper-o"></i> &nbsp; News</a></li>
					<li><a href=""><i class="fa fa-book"></i> &nbsp; Advertisements</a></li>
					<li><a href=""><i class="fa fa-paper-plane"></i> &nbsp; Courses</a></li>
					<li><a href=""><i class="fa fa-briefcase"></i> &nbsp; Executive</a></li>
					<li><a href=""><i class="fa fa-file-text"></i> &nbsp; Newsletter</a></li>
					<div class="clear"></div>
				</ul>
			</nav>
			<nav id="cp-sub-nav">
				<ul>
					<li><a href="">Welcome Message</a></li>
					<li><a href="">Privacy Policy</a></li>
					<div class="clear"></div>
				</ul>
			</nav>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>
