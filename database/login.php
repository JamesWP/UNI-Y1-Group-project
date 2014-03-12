<?php
	
	include '../database/connect.php';
	include '../application/app.php';


	if (isset($_POST['user']))
	$user = mysqli_real_escape_string($con, strtolower($_POST['user']));

	if (isset($_POST['password']))
	$password = mysqli_real_escape_string($con, $_POST['password']);

	loginCheck($user, $password);

?>