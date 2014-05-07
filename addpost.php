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
	<title>Add a Post</title>
	<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body class="app">
	<div id="wrapper" class="main">
		<?php require_once 'includes/header.php';?>
		<div class="latest-page">
			<?php require_once 'includes/blogsbar.php';?>
			<div class="new-post cf">
				<form method="post">
					<div><input name="title" class="post-title" type="text" placeholder="Title of post"></div>
					<div><textarea name="body"></textarea></div>
					<div class="options cf">
						<div class="category">
							<span>Post in: </span>
							<select name="blog">
								<option <?php if (!isset($_GET['blog'])) {
									echo 'selected';
								}?> disabled>Select a Blog</option>
								<?php
								foreach (getAllBlogs('title') as $blog) {?>
									<option <?php if ($blog['id'] === $_GET['blog']) {
										echo 'selected';
									}?> value="<?php echo $blog['id']?>"><?php echo $blog['title']?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="buttons">
							<?php 
							if (getBlogDetails($_GET['blog'])) {?>
								<a href="showblog.php?id=<?php echo $_GET['blog']?>" class="button button-secondary">Cancel</a>
							<?php
							}else{?>
								<a href="latest.php" class="button button-secondary">Cancel</a>
							<?php
							}
							?>
							<input type="submit" value="Post" class="button button-primary">
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php require_once 'includes/footer.php';?>
	</div>
</body>
</html>