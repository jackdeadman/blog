<?php
/**
 * Gets an assoc of all the blogs in DB
 * @param  string $orderBy Optional parameter to order the results by
 * @return array          assoc array of all the rows
 */
function getAllBlogs($orderBy = 'blogs.id', $limit = 100) {
	$mysqli = $GLOBALS['DB'];
	if ($orderBy === 'popularity') {
		$result = $mysqli->query('SELECT blogs.*, COUNT(posts.id) AS popularity FROM blogs JOIN posts ON posts.blog_fk = blogs.id GROUP BY blogs.id ORDER BY ' . $orderBy . ' DESC LIMIT ' . $limit);		
	}else{
		$result = $mysqli->query('SELECT * FROM blogs ORDER BY ' . $orderBy);
	}

	$blogs = array();

	while ($row = $result->fetch_assoc()) {
		$blogs[] = $row;
	}
	return $blogs;
}
/**
 * Gets all the blog details for a perticular blog
 * @param  int $id blog id
 * @return array | bool      assoc array blog details or false if blog doesnt exist
 */
function getBlogDetails($id = false) {
	$mysqli = $GLOBALS['DB'];
	if (is_numeric($id)) {
		$result = $mysqli->query('SELECT * FROM blogs WHERE id = ' . $id);
		return $result->fetch_assoc();
	}
	return false;
}
/**
 * Gets all the posts for a blog
 * @param  int $blogID  blog id to find the posts for
 * @param  string  $orderBy optional param to order by a field
 * @return array           assoc array of all the rows
 */
function getBlogPosts($blogID = false, $orderBy = 'posts.id') {
	if ($blogID) {
		$mysqli = $GLOBALS['DB'];
		$result = $mysqli->query('SELECT * FROM posts WHERE blog_fk = ' . $blogID . ' ORDER BY ' . $orderBy);
		$blogs = array();

		while ($row = $result->fetch_assoc()) {
			$blogs[] = $row;
		}
		return $blogs;	
	}
	return false;
}
/**
 * gets the details associated with a post
 * @param  int $id    post id
 * @param  string  $field optional parameter to change the field its searching from
 * @return array | bool         assoc array of post details or false if doesnt exist
 */
function getPostDetails($id = false, $field = 'user_fk') {

	$mysqli = $GLOBALS['DB'];
	if (is_numeric($id)) {
		$sql = "SELECT * FROM posts JOIN users ON users.id = posts.user_fk WHERE $field = $id";
		if ($result = $mysqli->query($sql)) {
			return $result->fetch_assoc();
		}else{
			return false;
		}
	}
	return false;
}

/**
 * Gets all the comments inside of a post
 * @param  int $postID
 * @return array assoc array of all the comments in the post
 */
function getPostComments($postID){
	if (is_numeric($postID)) {
		$sql = "SELECT * FROM comments JOIN users ON comments.user_fk = users.id WHERE post_fk = $postID";
		return query($sql);
	}
}

/**
 * Adds a new comment inside of a post
 * @param int $postID
 * @param int $userID
 * @param string $body
 */
function addComment($postID = null, $userID = null, $body = null){
	date_default_timezone_set("Europe/London");
	$date = date('o-m-d H:i:s');
	if ($postID && $userID && $body) {
		query("INSERT INTO comments(post_fk, user_fk, body, posted_on) VALUES('$postID', '$userID', '$body', '$date')");
		return true;
	}else{
		return false;
	}
}

/**
 * Add a blog to the database
 * @param boolean $title Title to give the blog in the database
 * @return boolean success state
 */
function addBlog($title = false) {
	if ($title) {
		$mysqli = $GLOBALS['DB'];
		$date = getDateInFormat();
		if ($mysqli->query("INSERT INTO blogs(title, date_added) VALUES('$title', '$date')")) {
			return true;
		}
	}
	return false;
}
/**
 * Queries the database to add a new blog post
 * @param int $blogID 
 * @param int $userID 
 * @param int $title  
 * @param int $body   contents of the blog post
 * @return bool success state of query
 */
function addPost($blogID, $userID, $title, $body) {
	if (isset($blogID, $userID, $title, $body)) {
		$mysqli = $GLOBALS['DB'];
		if ($mysqli->query("INSERT INTO posts(blog_fk, user_fk, title, body) VALUES('$blogID', '$userID', '$title', '$body')")) {
			return true;
		}
	}
	return false;
}

/**
 * Queries the database to delete a post
 * @param  int $id id of post to delete
 * @return bool      success state of the query
 */
function deletePost($id = false) {
	if ($id) {
		$mysqli = $GLOBALS['DB'];
		if ($mysqli->query("DELETE FROM posts WHERE id = " . $id)) {
			return true;
		}
	}
	return false;
}
function parseBlogPost($body){
	$checkingProfile = false;
	$profile = '';

	for ($i = 0; $i < strlen($body); $i++)  { 
		$character = substr($body, $i, 1);

		if ($checkingProfile) {
			// End of profile name
			
			if ($character === ' ' || $i + 1 == strlen($body)) {
				if ($i + 1 == strlen($body)) {
					$profile .= $character;
				}
				
				$checkingProfile = false;
				// Checks if profile exists
			
				if (usernameExists($profile)) {
					$profileDetails = getUserDetails($profile, 'username');
					$body = str_replace('@' . $profile, '<a href="profile.php?id=' . $profileDetails['id'] . '">@' . $profile . '</a>', $body);
				}
				$profile = '';
			}else{
				$profile .= $character;
			}
		}

		if ($character === '@') {
			$checkingProfile = true;
		}
	}
	return $body;
}

function getUserPosts($id){
	return query("SELECT * FROM posts WHERE user_fk = '$id'");
}

function getMentions($id){
	$user = getUserDetails($id);
	return query("SELECT * FROM posts WHERE body LIKE '%@{$user['username']}%'");
}

function deleteBlog($id){
	return query("DELETE FROM blogs WHERE id = $id");
}

?>