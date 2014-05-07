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
				<article>
					<div class="date">APRIL 30, 2014</div>
					<header><h3>Improving UI Animation Workflow with Velocity.js</h3></header>
					<p>
						The following is a guest post by Julian Shapiro. Julian recently released Velocity.js, a more performant jQuery replacement for .animate(). He recently wrote about how JavaScript animations can be so fast over on David Walsh’s blog, a topic we’ve covered here as well. In this article, Julian introduces Velocity.js itself.
					</p>
					<footer class="cf">						
						<a class="readmore" href="showpost.php">Read More</a>
					</footer>
				</article>
				<!-- <div class="more"><a href="#">Load More</a></div> -->
				<?php
				}?>
			</div>
		</div>
		<?php require_once 'includes/footer.php';?>
	</div>
</body>
</html>