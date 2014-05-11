<?php
require_once 'includes/ini.php';
require_once 'functions/user.php';
require_once 'functions/blog.php';
require_once 'includes/checklogin.php';

if (getPostDetails($_GET['id'], 'posts.id')) {
	$postDetails = getPostDetails($_GET['id'], 'posts.id');
}else{
	redirect(404);
}
$blogDetails = getBlogDetails($postDetails['blog_fk']);

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
			<div class="post-page">
				<div class="post-container">
					<div class="post-user">
						<div class="post-image">
							<img src="https://www.gravatar.com/avatar/c7c065e79262d8097dc0f814b8877732?d=mm&s=110">
						</div>
						<div class="post-username"><?php echo $postDetails['username']?></div>
					</div>
					<div class="post-content cf">
						<div class="post-details">
							<span class="post-blog-title"><a href="showblog.php?id=<?php echo $blogDetails['id']?>"><?php echo $blogDetails['title']?></a></span>
							<span>14th May 2014</span>
						</div>
						<div class="post-title">
							<h2><?php echo $postDetails['title']?></h2>
							<div class="post-triangle"></div>
						</div>
						<div class="post-body">
							<?php echo $postDetails['body']?>
						</div>
					</div>
				</div>
				<?php $comments = getPostComments($_GET['id'])?>
				<div class="post-comments">
					<header class="post-comment-title cf">
						<h3>Comments (<?php echo count($comments)?>)</h3>
						<div class="new-comment">
							<textarea placeholder="What did you think of this blog post?"></textarea>
						</div>
						<div class="action">
							<button class="button button-primary">Post comment</button>
						</div>
					</header>
					
					<?php
					foreach ($comments as $comment) {?>
						<div class="comment cf">
							<div class="comment-user">
								<div class="comment-picture">
									<img height="50" width="50" src="https://www.gravatar.com/avatar/c7c065e79262d8097dc0f814b8877732?d=mm&s=110">
								</div>
								<div class="comment-username">
									<?php echo $comment['username']?>	
								</div>
							</div>
							<div class="comment-body">
								<?php echo $comment['body']?>
							</div>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
		<?php require_once 'includes/footer.php';?>
	</div>
</body>
</html>