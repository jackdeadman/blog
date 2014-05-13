<?php
require_once 'includes/ini.php';
require_once 'functions/user.php';
require_once 'functions/blog.php';

$profile = getUserDetails($_GET['id']);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $profile['username'];?></title>
</head>
<body>
	<div>Profile of: <?php echo $profile['username'];?></div>
	<div>
		<?php $posts = getUserPosts($_GET['id']);?>
		<div><strong>Posts (<?php echo count($posts)?>)</strong></div>
		<?php
		foreach ($posts as $post) {
			echo parseBlogPost($post['body']), '<br />';
		}
		?>
	</div>

	<div>
		<?php $mentions = getMentions($_GET['id']);?>
		<div><strong>Mentions (<?php echo count($mentions)?>)</strong></div>
		<div>
			<?php

			foreach ($mentions as $mention) {
				echo parseBlogPost($mention['body']), '<br />';
			}
			?>
		</div>
	</div>

</body>
</html>