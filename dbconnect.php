<?php
function connectDB() {
## Database stuff
$db_svc = getenv('MYSQL_SVC', true) ?: "localhost";
$db_user = getenv('MYSQL_USER', true) ?: "XXXXX";
$db_pass = getenv('MYSQL_PASSWORD', true) ?: "XXXXX";
$db_name = getenv('MYSQL_DATABASE', true) ?: "spider";

global $db;
$db = ($GLOBALS["___mysqli_ston"] = mysqli_connect($db_svc, $db_user, $db_pass));

	if (!$db) {
	die("Unable to connect to database");
	}
##if (!mysql_select_db('spider')) {
if (!mysqli_select_db($GLOBALS["___mysqli_ston"], $db_name))
{		
	die("Unable to access spider database");
	}
}
?>
