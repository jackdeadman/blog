<?php
require_once 'includes/ini.php';

// $GLOBALS['DB']->query('INSERT INTO posts(title, body, blog_fk, user_fk) VALUES("Test", "Test", 6, 8)');
$GLOBALS['DB']->query('DELETE FROM blogs where id = 20');


echo '<h1>Blogs</h1>';
echo '<br />';
$res = query('SELECT * FROM blogs');
$keys = array_keys($res[0]);
var_dump($keys);


foreach ($res as $row => $value) {
	var_dump($value);
	echo '<br />';
}

echo '<h1>Posts</h1>';
echo '<br />';
$res = query('SELECT * FROM posts');
$keys = array_keys($res[0]);
var_dump($keys);


foreach ($res as $row => $value) {
	var_dump($value);
	echo '<br />';
}

?>