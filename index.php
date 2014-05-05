<?php
require_once('includes/ini.php');
require_once('functions/user.php');

if (!empty($_POST)) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if ($userDetails = login($username, $password)) {
		redirect('latest.php');
	}else{
		$error = 'Username or Password is invalid';
	}
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to the blog!</title>
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style/main.css">
	<link rel="stylesheet" type="text/css" href="style/font-awesome.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
</head>
<body>
	<div id="wrapper">
		<ul class="login-page">
			<li>
				<div class="success login-success">
					<?php if ($success = sessionFlash('success')){
						echo $success;
					}?>
				</div>
			</li>
			<li>
				<header class="login-title"><h2>Blog</h2></header>
			</li>
			<li>
				<div class="error login-error">
					<?php
					if (isset($error)) {
					echo $error;
				}?>
				</div>
			</li>
			<li>
				<?php
				$autofocus = 'username';
				if ($username = sessionFlash('username')){
					$autofocus = 'password';
				}
				if ($username = $_POST['username']) {
					$autofocus = 'password';
				}
				?>
				<div class="login-form">
				<form action="" method="post" autocomplete="off">
					<div>
						<input <?php if($autofocus === 'username')echo 'autofocus'?> value="<?php echo $username?>"placeholder="Username" name="username" id="username" type="text">
					</div>
					<div>
						<input <?php if($autofocus === 'password')echo 'autofocus'?> placeholder="Password" name="password" id="password" type="password">
					</div>
					<div>
						<input type="submit" value="Login"> <span class="register-button"><a href="register.php">Create an Account</a></span>
					</div>
				</form>
			</div>
			</li>
		</ul>
	</div>
</body>
</html>
<html>