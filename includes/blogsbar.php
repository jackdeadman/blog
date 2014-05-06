<div class="popular-blogs">
	<ul class="cf">
		<?php
		foreach (getAllBlogs('id', 5) as $blog) {?>
			<li><a href="blog.php?<?php echo $blog['id']?>"><?php echo $blog['title'];?></a></li>
		<?php
		}
		?>
		<li><a href="allblogs.php">All</a></li>
	</ul>
</div>