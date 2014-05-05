<?php
function query($sql){
	$mysqli = $GLOBALS['DB'];
	$result = $mysqli->query($sql);
	$results = array();
	if ($result->num_rows) {
		while ($row = $result->fetch_array(MYSQLI_ASSOC)){
			$results[] = $row;
		}	
	}
	return $results;
}

/**
 * Helper function for redirecting the page
 * @param  string $location url for to redirect to relative to the page
 */
function redirect($location) {
	header('Location: ' . $location);
	die();
}

/**
 * Escapes html entities in strings
 * @param  string $string String to escaped
 * @return string         The escaped string
 */
function escape($string) {
	return htmlentities($string);
}

function required($required = array(), $method = 'post'){
	$error = false;

	if ($method == 'post') {
		foreach($required as $field) {
			if (empty($_POST[$field])){
				$error = true;
			}
		}
	}elseif($method == 'get'){
		foreach($required as $field) {
			if (empty($_GET[$field])){
				$error = true;
			}
		}
	}
	return !$error;
}

function isAlpha($val){
	return preg_match("/^([a-zA-Z])+$/i", $val);
}

 function isEmail($val){
 	return preg_match("/^([a-z0-9+_-]+)(.[a-z0-9+_-]+)*@([a-z0-9-]+.)+[a-z]{2,6}$/ix",$val);
 }

function isMinlength($val, $min){
	return strlen($val) <= $min;
}

function isMaxlength($val, $max){
	return strlen($val) >= $max;
}

function strongPassword($val){
	// return !preg_match('(?=^.{8,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s)[0-9a-zA-Z!@#$%^&*()]*$', $password);
	return true;
}

function sessionFlash($name, $value = null){
	if ($value) {
		$_SESSION[$name] = $value;
		return true;
	}else{
		if (isset($_SESSION[$name])) {
			$value = $_SESSION[$name];
			unset($_SESSION[$name]);
			return $value;
		}else{
			return false;
		}
	}
}

?>