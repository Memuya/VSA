<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("acc_");

$t->setTitle("Membership Payment");

include $t->load("includes/init.php");

if(!Login::loggedIn())
	Utility::redirect("index");

include $t->load("template/head.php");
include $t->load("template/header.php");

$_user = new User;
$user = $_user->get($_SESSION["logged"]);

//get time left until payment is needed for non-course members
//OR get time left until account expires for course members
$date = new DateTime(date('Y-m-d', ($user->type === '4') ? $user->course_member_expiry : $user->payment_due_date));
$today = new DateTime();
$diff = $today->diff($date);

/*
//OLD DATE STUFF W/O COURSE MEMBERS STUFF
$date = new DateTime(date('Y-m-d', $user->payment_due_date));
$today = new DateTime();
$diff = $today->diff($date);
*/
?>	
	<div id="page-heading">
		<h1>Membership Payment</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php include $t->load("template/account-nav.php"); ?>

			<section class="right-main">
				<?php if($user->type === '4'): ?>
					
					<!--only display if user is a course member-->
					<div class="notice-box yellow-notice">
						Your VSA account is valid for <b><?=($diff->days);?> more day<?=($diff->d !== 1) ? 's' : null;?></b> before your <i>Course Membership</i> expires.
					</div>

				<?php else: ?>

					<?php if($user->payment_made === '0'): ?>

						<div class="notice-box yellow-notice">
							Your VSA payment has not yet been received. You have <b><?=($diff->format("%d"));?> day<?=($diff->d !== 1) ? 's' : null;?></b> left until your account is locked.
						</div>
						
					<?php elseif($user->payment_made === '1'): ?>

						<div class="notice-box green-notice">
							Your VSA payment has been received!
						</div>

					<?php endif; ?>

				<?php endif; ?>

				<!--<?='<pre>', print_r($diff), '</pre>';?>-->

				<p>Your <?=$user->membership;?> Member renewal fee is <b>$<?=number_format($user->price, 2);?></b>. VSA annual fees can only be paid by a cheque or the Direct Debit.</p>

				<h2>Payment by cheque</h2>
				<p>Make your cheque ‘Not Negotiable’ and payable to ‘Vacuum Society of Australia’. Write ‘Member ID #<?=str_pad($user->id, 4, 0, STR_PAD_LEFT);?>’ on the reverse side of the cheque. Please send the Renewal Notice with the cheque to:</p>
				<p>
					<i>VSA Membership Secretary<br>
					Prof Bruce King<br>
					University Drive<br>
					Callaghan NSW 2308<br>
					Australia</i>
				</p>

				<h2>Payment by Direct Debit: VSA bank account details</h2>
				<p>
					<b>Bank Name:</b> Commonwealth Bank Australia<br>
					<b>Branch Name:</b> RMIT VIC<br>
					<b>BSB:</b> 063 262<br>
					<b>Account Number:</b> 1012 7990<br>
				</p>

				<p>After payment, please email <b>support@vacuumsociety.org.au</b> your membership ID <i>(#<?=str_pad($user->id, 4, 0, STR_PAD_LEFT);?>)</i>, name and description of payment/transaction bank transfer receipt number (e.g., N11106551) to speed up the process.</p>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>