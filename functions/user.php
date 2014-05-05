<?php
/**
 * Gets an assoc array of a user
 * @param  int $id user id to get data for
 * @return array | bool      assoc array of details or false if user doesnt exist
 */
function getUserDetails($id = false) {
	$mysqli = $GLOBALS['DB'];
	
	if ($id) {
		if($result = $mysqli->query('SELECT * FROM users WHERE id = ' . $id . ';')){
			return $result->fetch_assoc();
		}
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
			if ($userDetails['password'] == hash('sha512', $pass)) {
				$_SESSION['user_id'] = $userDetails['id'];
				return $userDetails;
			}
		}
	}
	return false;
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

	$password = hash('sha512',$password);
	if($mysqli->query('INSERT INTO users(username,password) VALUES("'.$username.'","'.$password.'")')){
		return true;
	}else{
		return false;
	}
}


?>