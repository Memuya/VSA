<?php
//auto loads classes
spl_autoload_register(function($class) {
	require_once '../classes/'.$class.'.php';
});

$t = new Template("cp_");

$t->setTitle("News Articles");

include $t->load("includes/init.php");

if(!Login::check("admin"))
	Utility::redirect("index");

include $t->load("template/head.php");
include $t->load("template/header.php");

//inisiate news object
$news = new News;
//get all aedticles from database
$articles = $news->getAll();
?>	
	<div id="page-heading">
		<h1>News Articles</h1>
	</div>
	<div class="outer-wrapper white">
		<div class="inner-wrapper">
			
			<?php include $t->load("template/cp-nav.php"); ?>

			<section class="right-main">
				<?php if($news->getCount() != 0): ?>

					<p class="text-right fine-text"><?=$news->getCount();?> News Articles</p>

					<table class="style">
						<tr>
							<th>ID</th>
							<th>Title</th>
							<th>Author</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>

						<?php foreach($articles as $article): ?>

							<tr>
								<td><?=$article->id;?></td>
								<td><a href="<?=PATH;?>news?id=<?=$article->id;?>"><?=Utility::shortenText(Validate::output($article->title), 50);?></a></td>
								<td><?=$article->full_name;?></td>
								<td><a href="<?=PATH;?>cp/edit-news?id=<?=$article->id;?>" class="btn"><i class="fa fa-pencil-square-o"></i></a></td>
								<td><a href="#" data-link="<?=PATH;?>cp/delete-news?id=<?=$article->id;?>" class="delete-btn btn"><i class="fa fa-times"></i></a></td>
							</tr>

						<?php endforeach; ?>

					</table>

				<?php else: ?>

					<div class="notice-box yellow-notice">No news articles have been posted.</div>

				<?php endif; ?>
			</section>

			<div class="clear"></div>
		</div>
	</div>
<?php include $t->load("template/footer.php"); ?>