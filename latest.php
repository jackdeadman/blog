<?php
require_once 'includes/ini.php';
require_once 'functions/user.php';
require_once 'functions/blog.php';
require_once 'includes/checklogin.php';

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
			<header class="recent-post cf">
				<h2>Recent Posts</h2>
				<div class="post-something"><a class="button button-primary" href="addpost.php">Post Something</a></div>
			</header>
			<div class="feed">
				<article>
					<div class="date">APRIL 30, 2014</div>
					<header><h3>Improving UI Animation Workflow with Velocity.js</h3></header>
					<p>
						The following is a guest post by Julian Shapiro. Julian recently released Velocity.js, a more performant jQuery replacement for .animate(). He recently wrote about how JavaScript animations can be so fast over on David Walsh’s blog, a topic we’ve covered here as well. In this article, Julian introduces Velocity.js itself.
					</p>
					<footer>
						<span>Posted in <a href="#">CSS and Web Design</a></span>
						<a class="readmore" href="showpost.php">Read More</a>
					</footer>
				</article>

				<article>
					<div class="date">APRIL 29, 2014</div>
					<header><h3>Dealing with Content Images in Email</h3></header>
					<p>
						Let’s say you’re using an RSS-to-Email service. They’re pretty useful. Plenty of people like subscribing to content via email. You have a CMS that generates RSS from the content you create. An RSS-to-Email service can watch for new entries, format those new entries into an email, and send them out to a list of subscribers. MailChimp and Campaign Monitor both offer this service and I’m sure they aren’t the only ones.But how do you handle images within those email-generating …
					</p>
					<footer>
						<span>Posted in <a href="#">CSS and Web Design</a></span>
						<a class="readmore" href="#">Read More</a>
					</footer>
				</article>
				<article>
					<div class="date">APRIL 30, 2014</div>
					<header><h3>Improving UI Animation Workflow with Velocity.js</h3></header>
					<p>
						The following is a guest post by Julian Shapiro. Julian recently released Velocity.js, a more performant jQuery replacement for .animate(). He recently wrote about how JavaScript animations can be so fast over on David Walsh’s blog, a topic we’ve covered here as well. In this article, Julian introduces Velocity.js itself.
					</p>
					<footer>
						<span>Posted in <a href="#">CSS and Web Design</a></span>
						<a class="readmore" href="#">Read More</a>
					</footer>
				</article>

				<article>
					<div class="date">APRIL 29, 2014</div>
					<header><h3>Dealing with Content Images in Email</h3></header>
					<p>
						Let’s say you’re using an RSS-to-Email service. They’re pretty useful. Plenty of people like subscribing to content via email. You have a CMS that generates RSS from the content you create. An RSS-to-Email service can watch for new entries, format those new entries into an email, and send them out to a list of subscribers. MailChimp and Campaign Monitor both offer this service and I’m sure they aren’t the only ones.But how do you handle images within those email-generating …
					</p>
					<footer>
						<span>Posted in <a href="#">CSS and Web Design</a></span>
						<a class="readmore" href="#">Read More</a>
					</footer>
				</article>
				<article>
					<div class="date">APRIL 30, 2014</div>
					<header><h3>Improving UI Animation Workflow with Velocity.js</h3></header>
					<p>
						The following is a guest post by Julian Shapiro. Julian recently released Velocity.js, a more performant jQuery replacement for .animate(). He recently wrote about how JavaScript animations can be so fast over on David Walsh’s blog, a topic we’ve covered here as well. In this article, Julian introduces Velocity.js itself.
					</p>
					<footer>
						<span>Posted in <a href="#">CSS and Web Design</a></span>
						<a class="readmore" href="#">Read More</a>
					</footer>
				</article>

				<article>
					<div class="date">APRIL 29, 2014</div>
					<header><h3>Dealing with Content Images in Email</h3></header>
					<p>
						Let’s say you’re using an RSS-to-Email service. They’re pretty useful. Plenty of people like subscribing to content via email. You have a CMS that generates RSS from the content you create. An RSS-to-Email service can watch for new entries, format those new entries into an email, and send them out to a list of subscribers. MailChimp and Campaign Monitor both offer this service and I’m sure they aren’t the only ones.But how do you handle images within those email-generating …
					</p>
					<footer>
						<span>Posted in <a href="#">CSS and Web Design</a></span>
						<a class="readmore" href="#">Read More</a>
					</footer>
				</article>
				<div class="more"><a href="#">Load More</a></div>
			</div>
		</div>
		<?php require_once 'includes/footer.php';?>
	</div>
</body>
</html>