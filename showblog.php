<?php
require_once 'includes/ini.php';
require_once 'functions/user.php';
require_once 'functions/blog.php';
require_once 'includes/checklogin.php';

if ($blogDetails = getBlogDetails($_GET['id'])) {
	$posts = getBlogPosts($_GET['id']);
}else{
	redirect(404);
}


?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Latest</title>
	<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style/main.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
</head>
<body class="app">
	<div id="wrapper" class="main">
		<?php require_once 'includes/header.php';?>
		<div class="latest-page">
			<?php require_once 'includes/blogsbar.php';?>
			<header class="recent-post cf">
				<h2>Recent Posts in: <span class="blog-title"><?php echo escape($blogDetails['title'])?></span></h2>
				<div class="post-something"><a class="button button-primary" href="addpost.php?blog=<?php echo $_GET['id']?>">Post Something in <?php echo escape($blogDetails['title'])?></a></div>
			</header>
			<div class="feed">
				<?php
				if (empty($posts)) {?>
				<article>
					<header><h3>No Results Found.</h3></header>
					<p>
						It looks like nobody has posted in this blog yet. Why not be the <a href="addpost.php?blog=<?php echo $_GET['id']?>">First?</a>
					</p>
				</article>
				<?php
				}else{
				?>
					<div data-id="<?php echo $_GET['id']?>" class="blog-feed">	
						<div class="items">
							<article class="item">
								<div class="date">APRIL 30, 2014</div>
								<header><h3 data-field="title"></h3></header>
								<p data-field="body">
									
								</p>
								<footer>
									<span>Posted in <a data-base="showblog.php?id=" data-link="blog_fk" data-field="blog"></a></span>
									<a class="readmore" data-base="showpost.php?id=" data-link="id">Read More</a>
								</footer>
							</article>
						</div>
						<div class="more"><a class="items-load" href="#">Load More</a></div>
					</div>
				<?php
				}?>
			</div>
		</div>
		<?php require_once 'includes/footer.php';?>
	</div>
</body>
</html>