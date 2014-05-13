<?php
/**
 * Gets an assoc of all the blogs in DB
 * @param  string $orderBy Optional parameter to order the results by
 * @return array          assoc array of all the rows
 */
function getAllBlogs($orderBy = 'title') {
	echo "SELECT * FROM blogs ORDER BY ' . $orderBy";
	$mysqli = $GLOBALS['DB'];
	$result = $mysqli->query('SELECT * FROM blogs ORDER BY ' . $orderBy);
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
	if ($id) {
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
function getAllPosts($blogID = false, $orderBy = 'id') {
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
	if ($id) {
		$result = $mysqli->query('SELECT * FROM posts WHERE ' . $field . ' = ' . $id);
		return $result->fetch_assoc();
	}
	return false;
}

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

?>