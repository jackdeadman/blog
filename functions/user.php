<?php
/**
 * Gets an assoc array of a user
 * @param  int $id user id to get data for
 * @return array | bool      assoc array of details or false if user doesnt exist
 */
function getUserDetails($id = false, $field = 'users.id') {
	$mysqli = $GLOBALS['DB'];
	
	if ($id) {
		$result = query("SELECT * FROM users WHERE $field = '$id';");
		return $result[0];
	}else {
		return false;
	}
}
/**
 * logs a user into the system 
 * @param  string $username 
 * @param  string $pass     
 * @return bool success state of login
 */
function login($username, $pass) {
	$mysqli = $GLOBALS['DB'];
	if (isset($username, $pass)) {
		if($result = $mysqli->query('SELECT * FROM users WHERE username = "' . $username . '";')){
			$userDetails = $result->fetch_assoc();
			if ($userDetails['password'] == hash('sha512', $pass . $userDetails['salt'])) {
				$_SESSION['user_id'] = $userDetails['id'];
				return $userDetails;
			}
		}
	}
	return false;
}
function userLoggedIn(){
	return isset($_SESSION['user_id']);
}

function usernameExists($username){
	return count(query("SELECT * FROM users WHERE username = '$username'")) ? true : false;
}

/**
 * Registers a user into the as well as logging in
 * @param  string $username       
 * @param  string $password       
 * @param  string $passwordRepeat 
 * @return bool   success state of registration
 */
function registerUser($username, $password) {
	$mysqli = $GLOBALS['DB'];

	$fh = fopen('/dev/urandom','rb');
	$salt = fgets($fh,32);
	fclose($fh);

	$password = hash('sha512',$password . $salt);

	if($mysqli->query("INSERT INTO users(username,password, salt) VALUES('$username','$password', '$salt')")){
		return true;
	}else{
		return false;
	}
}

?>