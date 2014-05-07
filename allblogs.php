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
			<?php require_once 'includes/blogsbar.php';?>
			<header class="recent-post cf">
				<h2>All Blogs</h2>
				<div class="post-something"><a class="button button-primary" href="addblog.php">Add new Blog</a></div>
			</header>
			<div class="feed">
				<article>
					<ul>
						<?php
						foreach (getAllBlogs('title') as $blog) {?>
							<li><a href="showblog.php?id=<?php echo $blog['id']?>"><?php echo $blog['title']?></a></li>
						<?php
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