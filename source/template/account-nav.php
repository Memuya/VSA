<aside class="left-side">
	<div class="resized-sidebar-menu" style="float: left;">Menu</div>
	<div class="clear"></div>
	
	<nav class="sidebar">
		<ul>
			<li><a href="<?=PATH;?>account/details"<?=($t->getActivePage() == 'acc_details') ? ' class="active"' : null;?>><i class="fa fa-info"></i> &nbsp; My Details</a></li>
			<li><a href="<?=PATH;?>account/payment"<?=($t->getActivePage() == 'acc_payment') ? ' class="active"' : null;?>><i class="fa fa-credit-card"></i> &nbsp; Pay VSA Membership Fees</a></li>
			<li><a href="<?=PATH;?>account/newsletter"<?=($t->getActivePage() == 'acc_newsletter') ? ' class="active"' : null;?>><i class="fa fa-file-text"></i> &nbsp; OzVac Newsletter</a></li>
			<li><a href="<?=PATH;?>account/enrolments"<?=($t->getActivePage() == 'acc_enrolments') ? ' class="active"' : null;?>><i class="fa fa-paper-plane"></i> &nbsp; My Enrolments</a></li>
			<?php if(Login::check("corporate")): ?>
				<li><a href="<?=PATH;?>account/advertise"<?=($t->getActivePage() == 'acc_advertise') ? ' class="active"' : null;?>><i class="fa fa-book"></i> &nbsp; Advertise on VSA</a></li>
			<?php endif; ?>
		</ul>
	</nav>
</aside>