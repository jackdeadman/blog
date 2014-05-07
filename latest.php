<?php
require_once 'includes/ini.php';
require_once 'functions/user.php';
require_once 'functions/blog.php';
require_once 'includes/checklogin.php';
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
				<h2>Recent Posts</h2>
				<div class="post-something"><a class="button button-primary" href="addpost.php">Post Something</a></div>
			</header>
			<div class="feed all-blogs">
				<div class="items">
					<article class="item">
						<div class="date">APRIL 30, 2014</div>
						<header><h3 data-field="title"></h3></header>
						<p data-field="body"></p>
						<footer>
							<span>Posted in <a data-base="showblog.php?id=" data-link="blog_fk" data-field="blog"></a></span>
							<a class="readmore" data-base="showpost.php?id=" data-link="id">Read More</a>
						</footer>
					</article>
				</div>
				<div class="more"><a class="items-load" href="#">Load More</a></div>
			</div>
		</div>
		<?php require_once 'includes/footer.php';?>
	</div>
</body>
</html>