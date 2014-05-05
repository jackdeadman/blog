<?php
require_once 'includes/ini.php';
require_once 'functions/user.php';
require_once 'functions/blog.php';
require_once 'includes/checklogin.php';

$blogID = $_GET['id'];
$blogDetails = getBlogDetails($blogID);
if (empty($blogDetails)) {
	// Redirect if blog doesnt exist
	redirect('./blogs.php');
}

if (isset($_POST['title'], $_POST['body'])) {
	$title = $_POST['title'];
	$body = $_POST['body'];

	if (addPost($blogID, $userDetails['id'], $title, $body)) {
		echo 'Successfully added.';
	}else {
		echo 'unsuccessfully added.';
	}
}

if (isset($_GET['delete'])) {
	$postID = $_GET['delete'];
	$postDetails = getPostDetails($postID, 'id');
	$postUserID = $postDetails['user_fk'];
	
	// Checks if logged in user is the one deleting
	if ($postUserID == $userDetails['id']) {
		if (deletePost($postID)) {
			echo 'Successfully deleted';
		}else {
			echo 'Unsuccessfully deleted';
		}
	}
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo escape($blogDetails['title'])?></title>
	<link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>
	<div id="wrapper">
		<header>
			<h1><?php echo escape($blogDetails['title'])?></h1>
		</header>
		<div class="menu">
				<ul>
					<li>Hi, <?php echo escape($userDetails['username'])?></li>
					<li><a href="blogs.php">back</a></li>
				</ul>
			</div>
		<div id="posts-wrapper">
			<?php
				$posts = getAllPosts($blogID);
				if (!empty($posts)) {
					foreach ($posts as $post) {?>
					<div class="post">
						<ul>
							<li><?php echo escape($post['title'])?></li>
							<li><?php echo escape($post['body'])?></li>
							<li><?php
								$postUserDetails = getUserDetails($post['user_fk']);
								echo escape($postUserDetails['username']);
						?></li>
							<?
								if ($postUserDetails['id'] == $userDetails['id']) {?>
									<li><a href="?id=<?php echo escape($blogID.'&delete='.$post['id'])?>">Delete</a></li>
							<?php	
								}
							?>
						</ul>
					</div>
				<?php
					}
				}else {
					echo 'No posts are here, why not make one?';
				}
			?>
		</div>
		<div id="post-input-wrapper">
			<form method="post" action="">
				<div>Post title: <input type="text" name="title" placeholder="Title of your post"></div>
				<div><textarea name="body" placeholder="Post contents..."></textarea></div>
				<div><input type="submit" value="Add"></div>
			</form>
		</div>
	</div>
</body>
</html>