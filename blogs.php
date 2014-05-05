<?php
require_once 'includes/ini.php';
require_once 'functions/user.php';
require_once 'functions/blog.php';
require_once 'includes/checklogin.php';

if (isset($_POST['title'])) {
	$title = $_POST['title'];
	if (addBlog($title)) {
		echo 'Successfully added.';
	}else {
		echo 'unsuccessfully added.';
	}
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo escape($userDetails['username'])?></title>
	<link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>
	<div id="wrapper">
		<header>
			<h1>Blogs</h1>
			<div class="menu">
				<ul>
					<li>Hi, <?php echo escape($userDetails['username'])?></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
		</header>
		<div id="blog-wrapper">
		<?php
			$blogs = getAllBlogs('title');
			foreach ($blogs as $blog) {
				$posts = getAllPosts($blog['id']);
				?>
				<div class="blog">
					<a href="posts.php?id=<?php echo $blog['id']?>"><?php echo escape($blog['title'] . ' (' . count($posts) . ')')?></a>
				</div>
		<?php
			}
		?>
		</div>
		<div id="blog-input-wrapper">
			<form method="post" action="">
				Blog title: <input type="text" name="title" placeholder="Add a new Blog">
				<input type="submit" value="Add">
			</form>
		</div>
	</div>
</body>
</html>