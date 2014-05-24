<?php
require_once('includes/ini.php');
require_once('functions/user.php');

if (userLoggedIn()) {
	redirect('latest.php');
}

$errors = array();

if(!empty($_POST)){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordRepeat = $_POST['passwordRepeat'];

	if (!required(array('username','password','passwordRepeat'), $_POST)) {
		$errors['all'] = 'All the fields are required.';
	}else{

		if (!strongPassword($password)) {
			$errors['password'] = 'Password is not strong enough.';
		}elseif ($password !== $passwordRepeat) {
			$errors['passwordRepeat'] = 'Passwords do not match.';
		}
		if (isMinLength($username, 4)) {
			$errors['username'] = 'Username is too short.';
		}
		if (isMaxLength($username, 50)) {
			$errors['username'] = 'Username is too long.';
		}

		if (!uniqueEntry($username, 'users', 'username')) {
			$errors['username'] = 'Username has already been taken.';
		}
	}

	if (empty($errors)) {
		if (registerUser($username, $password)) {
			sessionFlash('success', 'Account successfully registered.');
			sessionFlash('username', $username);
			redirect('./');
		}
	}
}

?>
<?php

if(isset($success)){?>
	<div class="success">	
		<?php echo $success;?>
	</div><?php
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register for the blog</title>
	<link rel="stylesheet" type="text/css" href="style/main.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
</head>
<body>
	<div id="wrapper">
		<form method="post">
			<ul class="register-page">
				<li class="avatar">
					<div name="avatar" id="dropzone" class="drop">Avatar</div>
					<input class="avatar-upload" type="file">
				</li>
				<li>
					<div class="register-error error"><?php if ($err = $errors['all']) {
						echo $err;
					}?></div>
				</li>
				<li class="username">
					<input autofocus autocomplete="off" placeholder="Username" value="<?php echo $username?>" name="username" type="text">
					<div class="register-error error"><?php if ($err = $errors['username']) {
						echo $err;
					}?></div>
				</li>
				<li class="password">
					<input placeholder="Password" name="password" type="password">
					<div class="register-error error"><?php if ($err = $errors['password']) {
						echo $err;
					}?></div>
				</li>
				<li class="passwordRepeat">
					<input placeholder="Password again" name="passwordRepeat" type="password">
					<div class="register-error error"><?php if ($err = $errors['passwordRepeat']) {
						echo $err;
					}?></div>
				</li>
				<li class="buttons">
					<a href="./">Back to login</a>
					<input type="submit" value="Sign Up" class="sign-up button button-primary">
				</li>
			</ul>
		</form>
	</div>
</body>
</html>