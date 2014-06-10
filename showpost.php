<?php
require_once 'includes/ini.php'; // Initialises the page
require_once 'functions/user.php';
require_once 'functions/blog.php';
require_once 'includes/checklogin.php';

/**
 * Gets the post details based on an ID
 */
if (getPostDetails($_GET['id'], 'posts.id')) {
	$postDetails = getPostDetails($_GET['id'], 'posts.id');
}else{
	// Redirect if no id is given
	redirect(404);
}
/**
 * Gets the blog details based of an id
 */
$blogDetails = getBlogDetails($postDetails['blog_fk']);

/**
 * If a comment is posted it is added to the database, after validation
 */
if (isset($_POST['body'])) {
	addComment($_GET['id'], $userDetails['id'], $_POST['body']);
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Post</title>
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
						<div class="post-username"><a href="profile.php?id=<?php echo $postDetails['id']?>"><?php echo $postDetails['username']?></a></div>
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
							<?php 
							/* Adds links to profile if @ is proceded by a user profile */
							echo parseBlogPost($postDetails['body'])?>
						</div>
					</div>
				</div>
				<?php $comments = getPostComments($_GET['id'])?>
				<div class="post-comments">
					<header class="post-comment-title cf">
						<h3>Comments (<?php echo count($comments)?>)</h3>
						<form method="post">
							<div class="new-comment">
								<textarea name="body" placeholder="What did you think of this blog post?"></textarea>
							</div>
							<div class="action">
								<button class="button button-primary">Post comment</button>
							</div>
						</form>
					</header>
					
					<?php
					// Outputs all the comment in the database for this post
					foreach ($comments as $comment) {?>
						<div class="comment cf">
							<div class="comment-user">
								<div class="comment-picture">
									<img height="50" width="50" src="https://www.gravatar.com/avatar/c7c065e79262d8097dc0f814b8877732?d=mm&s=110">
								</div>
								<div class="comment-username">
									<a href="profile.php?id=<?php echo $comment['id']?>"><?php echo $comment['username']?></a>
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