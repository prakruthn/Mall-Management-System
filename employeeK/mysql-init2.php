<?php // login.php
$db_hostname = 'localhost';
$db_database = 'some';
$db_username = 'root';
$db_password = 'cottonboys';
$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
	if (!$conn) {
 	   die("Access Denied Contact Technical Officer: " . mysqli_connect_error());
	}
?>