<?php
	
	include '../database/connect.php';
	include '../application/app.php';


	if (isset($_POST['user']))
		$user = mysqli_real_escape_string($con, $_POST['user']);

	if (isset($_POST['password']))
		$password = mysqli_real_escape_string($con, $_POST['password']);

	if (available($user) == true)
		create($user, $password);
	else
		print_r("nu");

	// to be modified later on to accept pictures & description

?>