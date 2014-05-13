<?php
// Used for ajax
require_once 'includes/ini.php';
require_once 'functions/blog.php';
require_once 'functions/user.php';
//header('Content-Type: application/json');

$articles = array();

$start = isset($_GET['start']) ? (int)$_GET['start'] -1 : 0;
$count = isset($_GET['count']) ? (int)$_GET['count'] : 1;
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($id !== null) {
	$where = 'WHERE blog_fk = ' . $id;
}else{
	$where = '';
}

$articles = query("
	SELECT 	SQL_CALC_FOUND_ROWS *,
			posts.title AS title,
			blogs.title AS blog,
			posts.id AS id
	FROM posts 
	JOIN blogs
	ON blogs.id = posts.blog_fk
	$where 
	ORDER BY posts.id DESC
	LIMIT {$start}, {$count}
	");

$articlesTotal = query("SELECT FOUND_ROWS() AS count");
$articlesTotal = $articlesTotal[0]['count'];
$count = 0;

// Checks for @ in the body for profiles
foreach ($articles as $article) {
	$body = $articles[$count]['body'];
	$body = parseBlogPost($body);
	$articles[$count]['body'] = $body;
	$count ++;
}

echo json_encode(array(
	'items' => $articles,
	'last' => ($start + $count) >= $articlesTotal ? true : false,
	'count' => $count,
	'start' => $start,
));

?>