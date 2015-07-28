<aside class="left-side">
	<div class="resized-sidebar-menu" style="float: left;"><i class="fa fa-bars"></i> Menu</div>
	<div class="clear"></div>
	
	<!--<h3>Update</h3>-->
	<nav class="sidebar">
		<ul>
			<li><a href="<?=PATH;?>cp/update-welcome"<?=($t->getActivePage() == 'cp_update-welcome') ? ' class="active"' : null;?>><i class="fa fa-wrench"></i> &nbsp; Welcome Message</a></li>
			<li><a href="<?=PATH;?>cp/update-privacy"<?=($t->getActivePage() == 'cp_update-privacy') ? ' class="active"' : null;?>><i class="fa fa-wrench"></i> &nbsp; Privacy Policy</a></li>
		</ul>
	</nav>

	<!--<h3>Users</h3>-->
	<nav class="sidebar">
		<ul>
			<li><a href="<?=PATH;?>cp/users"<?=($t->getActivePage() == 'cp_users' || $t->getActivePage() == 'cp_view-user') ? ' class="active"' : null;?>><i class="fa fa-user"></i> &nbsp; Users</a></li>
		</ul>
	</nav>

	<!--<h3>News</h3>-->
	<nav class="sidebar">
		<ul>
			<li><a href="<?=PATH;?>cp/add-news"<?=($t->getActivePage() == 'cp_add-news') ? ' class="active"' : null;?>><i class="fa fa-newspaper-o"></i> &nbsp; Add News Article</a></li>
			<li><a href="<?=PATH;?>cp/news"<?=($t->getActivePage() == 'cp_news') ? ' class="active"' : null;?>><i class="fa fa-newspaper-o"></i> &nbsp; News Articles</a></li>
		</ul>
	</nav>

	<!--<h3>Sponsors</h3>-->
	<nav class="sidebar">
		<ul>
			<!--<li><a href="<?=PATH;?>cp/sponsors">Add Sponsors</a></li>-->
			<li><a href="<?=PATH;?>cp/ads"<?=($t->getActivePage() == 'cp_ads') ? ' class="active"' : null;?>><i class="fa fa-book"></i> &nbsp; Advertisements</a></li>
			<li><a href="<?=PATH;?>cp/pending-ads"<?=($t->getActivePage() == 'cp_pending-ads') ? ' class="active"' : null;?>><i class="fa fa-book"></i> &nbsp; Pending Advertisements</a></li>
		</ul>
	</nav>

	<!--<h3>Courses</h3>-->
	<nav class="sidebar">
		<ul>
			<li><a href="<?=PATH;?>cp/add-course"<?=($t->getActivePage() == 'cp_add-course') ? ' class="active"' : null;?>><i class="fa fa-paper-plane"></i> &nbsp; Add Course</a></li>
			<li><a href="<?=PATH;?>cp/courses"<?=($t->getActivePage() == 'cp_courses' || $t->getActivePage() == 'cp_view-course') ? ' class="active"' : null;?>><i class="fa fa-paper-plane"></i> &nbsp; Courses</a></li>
		</ul>
	</nav>

	<!--<h3>Executive</h3>-->
	<nav class="sidebar">
		<ul>
			<li><a href="<?=PATH;?>cp/add-executive"<?=($t->getActivePage() == 'cp_add-executive') ? ' class="active"' : null;?>><i class="fa fa-briefcase"></i> &nbsp; Add Executive</a></li>
			<li><a href="<?=PATH;?>cp/executive"<?=($t->getActivePage() == 'cp_executive') ? ' class="active"' : null;?>><i class="fa fa-briefcase"></i> &nbsp; Executive</a></li>
		</ul>
	</nav>

	<!--<h3>Newsletter</h3>-->
	<nav class="sidebar">
		<ul>
			<li><a href="<?=PATH;?>cp/add-newsletter"<?=($t->getActivePage() == 'cp_add-newsletter') ? ' class="active"' : null;?>><i class="fa fa-file-text"></i> &nbsp; Add Newletter</a></li>
			<li><a href="<?=PATH;?>cp/newsletter"<?=($t->getActivePage() == 'cp_newsletter') ? ' class="active"' : null;?>><i class="fa fa-file-text"></i> &nbsp; Newsletters</a></li>
		</ul>
	</nav>
</aside>
