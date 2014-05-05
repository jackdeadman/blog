<?php
require_once 'includes/ini.php';
require_once 'functions/user.php';
require_once 'functions/blog.php';
require_once 'includes/checklogin.php';

if (isset($_POST['title'],$_POST['body'],$_POST['blog'])) {
	if (addPost($_POST['blog'], $userDetails['id'], $_POST['title'], $_POST['body'])) {
		// success feedback
	}else{
		// fail feedback
	}
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
			<div class="new-post cf">
				<form method="post">
					<div><input name="title" class="post-title" type="text" placeholder="Title of post"></div>
					<div><textarea name="body"></textarea></div>
					<div class="options cf">
						<div class="category">
							<span>Post in: </span>
							<select name="blog">
								<option selected disabled>Select a Blog</option>
								<?php
								foreach (getAllBlogs('title') as $blog) {
									echo '<option value="' . $blog['id'] . '">' . $blog['title'] . '</option>';
								}
								?>
							</select>
						</div>
						<div class="buttons">
							<a href="latest.php" class="button button-secondary">Cancel</a><input type="submit" value="Post" class="button button-primary">
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="sticky-footer">
			<?php require_once 'includes/footer.php';?>
		</div>
	</div>
</body>
</html>