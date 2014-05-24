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
	if (is_numeric($location)) {
		switch ($location) {
			case 404:
				header("HTTP/1.0 404 Not Found");
				require_once 'includes/404.php';
				die();
			
		}
	}
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

function required($required = array(), $array){
	$error = false;

	foreach($required as $field) {
		if (empty($array[$field])){
			$error = true;
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

function uniqueEntry($data, $table, $field){
	$results = query("SELECT * FROM $table WHERE $field = '$data'");
	return count($results) === 0;
}

function getDateInFormat(){
	date_default_timezone_set("Europe/London");
	$date = date('o-m-d H:i:s');
	return $date;
}

function lastInsertId(){
	echo $GLOBALS['db']->insert_id;
	return $GLOBALS['db']->insert_id;
}

?>