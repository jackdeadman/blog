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

if (isset($_POST['blog'])) {
	deleteBlog($_POST['blog']);
	sessionFlash('success','Successfully deleted blog');
	redirect('allblogs.php');
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
				<h2>Deleting Blog: <span class="blog-title"><?php echo escape($blogDetails['title'])?></span></h2>
			</header>
			<div class="feed delete-blog">
				<article>
					<header><h2>Warning</h2></header>
					<p>Deleting a blog is perminant and will affect other users. All the posts inside of a blog and the comments will also be deleted.</p>
				</article>
				<?php
				$posts = getBlogPosts($_GET['id']);

				if (!empty($posts)) {?>
					<article>
						<header><h2>Posts affected</h2></header>
						<ul>
							<?php
							foreach ($posts as $post) {?>
								<li><a href="showpost.php?id=<?php echo $post['id']?>"><?php echo $post['title']?></a></li>
							<?php	
							}
							?>
						</ul>
					</article>

				<?php
				}
				?>
				<article>
					<form method="post">
						<input name='blog' type="hidden" value="<?php echo $_GET['id']?>">
						<div class="notify">
							<label for="notify">Notify affected users?</label>
							<input id="notify" checked name="notify" type="checkbox">
						</div>
						<div>
							<a href="showblog.php?id=<?php echo $_GET['id']?>" class="button button-secondary">Cancel</a>
							<button class="button button-danger">Delete</button>
						</div>
					</form>
				</article>
			</div>
		</div>
		<?php require_once 'includes/footer.php';?>
	</div>
</body>
</html>