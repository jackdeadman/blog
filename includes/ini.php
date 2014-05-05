<?php
session_start();
require_once 'functions/general.php';
$ini = parse_ini_file('php.ini');

$dbhost = $ini['dbhost'];
$dbuser = $ini['dbuser'];
$dbpass = $ini['dbpass'];
$dbdata = $ini['dbdata'];


$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbdata);
$GLOBALS['DB'] = $mysqli;
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

?>