<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once 'classes/'.$class.'.php';
});

$t = new Template;

$t->setTitle("News");
$t->setTags("news, articles");

include $t->load("includes/init.php");

include $t->load("template/head.php");
?>

<?php if(Login::check("admin")): ?>
	<script>
	$(document).ready(function() {
		$(".delete").click(function() {
			var x = confirm("Are you sure you want to delete this article?");

			if(!x)
				return false;
		});
	});
	</script>
<?php endif; ?>

<?php
include $t->load("template/header.php");

$news = new News;
?>	
	<div id="page-heading">
		<h1>News</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			<?php if(isset($_GET["id"]) && !empty($_GET["id"]) && is_numeric($_GET["id"])): ?>

				<?php
				//get single news article if ID is set in the url
				$article = $news->get($_GET["id"]);
				?>

				<?php if($news->getCount() != 0): ?>

					<article>
						<h2><i class="fa fa-arrow-circle-right"></i> <?=Validate::output($article->title);?></h2>
						<div style="color: #AAA; margin: 5px 0px; font-size: 10px;"><i class="fa fa-chevron-right"></i> <b>By:</b> <?=$article->full_name;?> | <b>Date:</b> <?=date("jS M Y", $article->date);?></div>
						<p><?=($article->body);?></p>
					</article>

				<?php else: ?>

					<div class="notice-box yellow-notice">The news article you are looking for does not exist. Please return to our news page to find the latest news from VSA.</div>
					<div class="center"><a href="<?=PATH;?>news" class="btn">Back to News</a></div>

				<?php endif; ?>

			<?php else: ?>

				<?php
				//get all articles from database
				$articles = $news->getAll();
				?>

				<?php if($news->getCount() != 0): ?>
					<?php foreach($articles as $article): ?>

						<article class="news-box">
							<h2><i class="fa fa-arrow-circle-right"></i> <?=Validate::output($article->title);?></h2>
							<div style="color: #AAA; margin: 5px 0px; font-size: 10px;"><i class="fa fa-chevron-right"></i> <b>By:</b> <?=$article->full_name;?> | <b>Date:</b> <?=date("jS M Y", $article->date);?></div>
							<p><?=Utility::shortenText(str_replace(["<p>", "</p>", "&nbsp;"], " ", $article->body), 400);?></p>

							<div class="clear"></div>

							<a href="<?=PATH;?>news?id=<?=$article->id;?>" class="btn rfloat">Read More</a>

							<?php if(Login::check("admin")): ?>
								<a href="<?=PATH;?>cp/edit-news?id=<?=$article->id;?>" class="btn rfloat">Edit</a>
								<a href="<?=PATH;?>cp/delete-news?id=<?=$article->id;?>" class="btn rfloat delete">Delete</a>
							<?php endif; ?>

							<div class="clear"></div>
						</article>

					<?php endforeach; ?>
				<?php else: ?>

					<div class="notice-box yellow-notice">No news articles have been posted at this time. Please check back in the near future!</div>

				<?php endif; ?>

			<?php endif; ?>
		</div>
	</div>

	<?php if($news->getCount() != 0 && isset($_GET["id"])): ?>

		<div class="outer-wrapper light-grey">
			<div class="inner-wrapper">
				<a href="<?=PATH;?>news" class="btn">Back to News Articles</a>

				<?php if(Login::check("admin")): ?>
					<a href="<?=PATH;?>cp/edit-news?id=<?=$article->id;?>" class="btn">Edit</a>
					<a href="<?=PATH;?>cp/delete-news?id=<?=$article->id;?>" class="btn delete">Delete</a>
				<?php endif; ?>
			</div>
		</div>

	<?php endif; ?>
<?php include $t->load("template/footer.php"); ?>
