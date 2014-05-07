<?php
/**
 * Gets an assoc of all the blogs in DB
 * @param  string $orderBy Optional parameter to order the results by
 * @return array          assoc array of all the rows
 */
function getAllBlogs($orderBy = 'id', $limit = 100) {
	$mysqli = $GLOBALS['DB'];
	$result = $mysqli->query('SELECT * FROM blogs ORDER BY ' . $orderBy . ' LIMIT ' . $limit);
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
		$result = $mysqli->query('SELECT * FROM posts WHERE ' . $field . ' = ' . $id);
		return $result->fetch_assoc();
	}
	return false;
}

/**
 * Add a blog to the database
 * @param boolean $title Title to give the blog in the database
 * @return boolean success state
 */
function addBlog($title = false) {
	if ($title) {
		$mysqli = $GLOBALS['DB'];
		if ($mysqli->query("INSERT INTO blogs(title) VALUES('$title')")) {
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

?>