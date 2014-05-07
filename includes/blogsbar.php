<div class="popular-blogs">
	<ul class="cf">
		<?php
		foreach (getAllBlogs('popularity', 5) as $blog) {?>
			<li><a href="showblog.php?id=<?php echo escape($blog['id'])?>"><?php echo escape($blog['title']);?></a></li>
		<?php
		}
		?>
		<li><a href="allblogs.php">More</a></li>
	</ul>
</div>