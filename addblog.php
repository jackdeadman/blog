<?php
require_once 'includes/ini.php';
require_once 'functions/user.php';
require_once 'functions/blog.php';
require_once 'includes/checklogin.php';

if (isset($_POST['title'])) {
	if (addBlog($_POST['title'])) {
		redirect('allblogs.php');
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
					<div><input name="title" class="post-title" type="text" placeholder="Title of Blog"></div>
					<div class="options cf">
						<div class="buttons">
							<a href="allblogs.php" class="button button-secondary">Cancel</a><input type="submit" value="Add Blog" class="button button-primary">
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