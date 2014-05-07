<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>404 Not Found</title>
	<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body class="app">
	<div id="wrapper" class="main">
		<?php require_once 'includes/header.php';?>
		<div class="page-not-found cf">
			<h1>404!</h1>
			<h2>Well, this is awkward.</h2>
			<p>It looks like there is a problem finding the page you requested. If you followed a link on the site to get here please <a href="form.html">Let me know</a> so I can fix it.</p>
			<ul class="nav cf">
				<li><a href="allblogs.php">Blogs</a></li>
				<li><a href="latest.php">Latest Posts</a></li>
				<li><a href="addpost.php">New Post</a></li>
			</ul>
		</div>
		<div class="sticky-footer">
			<?php require_once 'includes/footer.php';?>
		</div>
	</div>
</body>
</html>