<?php
session_start();
$dbhost = "212.48.66.176";
$dbuser = "itecdigi_417880c";
$dbpass = "417880c";
$dbdata = "itecdigi_417880_sd1";

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbdata);
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}

?>