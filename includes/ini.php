<?php
session_start();
require_once 'functions/general.php';

$dbhost = "212.48.66.176";
$dbuser = "itecdigi_417880c";
$dbpass = "mypassword";
$dbdata = "itecdigi_417880_sd1";


$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbdata);
$GLOBALS['DB'] = $mysqli;
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

?>