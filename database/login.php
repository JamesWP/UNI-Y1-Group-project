<?php
	
	include '../database/connect.php';
	include '../application/app.php';


	if (isset($_REQUEST['user']))
	$user = mysqli_real_escape_string($con, strtolower($_REQUEST['user']));

	if (isset($_REQUEST['password']))
	$password = mysqli_real_escape_string($con, $_REQUEST['password']);

	loginCheck($user, $password);

?>