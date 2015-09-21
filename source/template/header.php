</head>
	<body>
		<noscript>
			<div class="notice-box yellow-notice" style="text-align: center; margin: 0;">
				This site requires Javascript to be enabled to function correctly. Please enable Javascript in your browser.
			</div>
		</noscript>
		<div id="overlay"></div>
		<div class="login-box">
				<a href="#" class="close-btn">&#10006;</a>
				<div class="clear"></div>
				<p>Please use the form below to login to your VSA account.</p>
				<form method="post" action="login">
					<div class="field">
						<label for="login-username">Username</label>
					</div>
					<div class="field">
						<input type="text" name="username" class="input-username" id="login-username">
					</div>
					<div class="field">
						<label for="login-password">Password</label>
					</div>
					<div>
						<input type="password" name="password" id="login-password">
					</div>
					<div class="field">
						<label for="login"></label>
					</div>
					<div class="field">
						<input type="submit" name="login" id="login" value="Login">
					</div>

					<div style="margin-top: 20px;">
						<a href="<?=PATH;?>forgot-password">Forgot your password?</a>
					</div>
				</form>
		</div>
		<header id="fixed">
			<div id="header">
				<div class="inner-wrapper">
					<a href="<?=PATH;?>"><img src="<?=PATH;?>img/vsa-logo.png" id="banner-logo" alt="Vaccum Society of Australia"></a>
					
					<?php if(isset($_SESSION['admin'])): ?>

						<nav class="top-nav">
							<ul>
								<li><a href="<?=PATH;?>cp/update-welcome">Control Panel</a></li>
								<li><a href="<?=PATH;?>logout?url=<?=$_SERVER['REQUEST_URI'];?>">Logout, <?=User::getUsername($_SESSION["logged"]);?></a></li>
								<div class="clear"></div>
							</ul>
						</nav>

					<?php elseif(isset($_SESSION['logged'])): ?>

						<!--<a href="<?=PATH;?>logout<?=(isset($_SERVER['REQUEST_URI'])) ? '?url='.$_SERVER['REQUEST_URI'] : null;?>" id="logout-btn"><img src="<?=PATH;?>img/logout-btn.png"></a>-->
						<nav class="top-nav">
							<ul>
								<li><a href="<?=PATH;?>account/payment">Account</a></li>
								<li><a href="<?=PATH;?>logout?url=<?=$_SERVER['REQUEST_URI'];?>">Logout, <?=User::getUsername($_SESSION["logged"]);?></a></li>
								<div class="clear"></div>
							</ul>
						</nav>

					<?php else: ?>

						<div class="login-btn-wrapper">
							<a href="<?=PATH;?>login" class="login-btn"><img src="<?=PATH;?>img/login-btn.png"></a>
						</div>

					<?php endif; ?>
				</div>
			</div>
			<div class="resized-menu">
				<i class="fa fa-bars"></i>
			</div>
			<nav class="main-nav">
				<div class="inner-wrapper">
					<ul>
						<li><a href="<?=PATH;?>"<?=($t->getActivePage() == 'index') ? ' class="active"' : null;?>><i class="fa fa-home"></i><br>Home</a></li>
						<li><a href="<?=PATH;?>news"<?=($t->getActivePage() == 'news') ? ' class="active"' : null;?>><i class="fa fa-newspaper-o"></i><br>News</a></li>
						<li><a href="<?=PATH;?>courses"<?=($t->getActivePage() == 'courses' || $t->getActivePage() == 'apply-course') ? ' class="active"' : null;?>><i class="fa fa-paper-plane"></i><br>Courses</a></li>
						<li><a href="<?=PATH;?>join"<?=($t->getActivePage() == 'join') ? ' class="active"' : null;?>><i class="fa fa-user-plus"></i><br>Join VSA</a></li>
						<li><a href="<?=PATH;?>sponsors"<?=($t->getActivePage() == 'sponsors') ? ' class="active"' : null;?>><i class="fa fa-book"></i><br>Sponsors</a></li>
						<li><a href="<?=PATH;?>executive"<?=($t->getActivePage() == 'executive') ? ' class="active"' : null;?>><i class="fa fa-briefcase"></i><br>Executive</a></li>
						<div class="clear"></div>
					</ul>
				</div>
			</nav>
		</header>