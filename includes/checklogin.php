<?php
// Redirects pages that you need to be logged into
if (isset($_SESSION['user_id'])) {
	$userDetails = getUserDetails($_SESSION['user_id']);
}else {
	redirect('./');
}
?>