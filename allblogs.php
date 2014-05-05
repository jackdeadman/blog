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
</head>
<body class="app">
	<div id="wrapper" class="main">
		<?php require_once 'includes/header.php';?>
		<div class="latest-page">
			<div class="popular-blogs">
				<ul class="cf">
					<?php
					foreach (getAllBlogs('id', 5) as $blog) {?>
						<li><a href="#"><?php echo $blog['title'];?></a></li>
					<?php
					}
					?>
					<li><a href="#">All</a></li>
				</ul>
			</div>
			<header class="recent-post cf">
				<h2>All Blogs</h2>
				<div class="post-something"><a class="button button-primary" href="addpost.php">Add new Blog</a></div>
			</header>
			<div class="feed">
				<article>
					<ul>
						<?php
						foreach (getAllBlogs() as $blog) {
							echo '<li>' . $blog['title'] . '</li>';
						}
						?>
					</ul>
				</article>
			</div>
		</div>
		<?php require_once 'includes/footer.php';?>
	</div>
</body>
</html>