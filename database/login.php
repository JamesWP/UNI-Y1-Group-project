<?php

	// session_start();

	$database_host = "dbhost.cs.man.ac.uk";
	$database_user = "mbax2ip4";
	$database_pass = "vanillacupcake";
	$database_name = "mbax2ip4";
	$group_dbnames = array("2013_comp10120_w2");

	
	$con = new mysqli($database_host , $database_user, $database_pass, "2013_comp10120_w2");

	/* Check connection */
	if (mysqli_connect_errno())
		echo "Failed to connect to MySQL: " . mysqli_connect_error();

	function loginCheck($con, $user, $password) {	
		$userID = mysqli_fetch_array(mysqli_query($con, "SELECT userID FROM `User` WHERE name = '$user'"));
		$userID = $userID['userID'];

		if ($userID != null)
		{
			$hash = mysqli_fetch_array(mysqli_query($con, "SELECT password FROM `User` WHERE name = '$user'"));
			$hash = $hash['password'];

			if((password_verify($password, $hash)))
				echo "Brilliant! Your user ID is $userID!";
			else
				echo "Wrong password!";
		}

		else
			echo "Wrong username!";

	} // loginCheck

	// stub function for php < 5.5
	function password_verify($password, $hash) {
		return md5($password) == $hash;
	} // password_verify




	if (isset($_REQUEST['user']))
	$user = mysqli_real_escape_string($con, strtolower($_REQUEST['user']));

	if (isset($_REQUEST['password']))
	$password = mysqli_real_escape_string($con, $_REQUEST['password']);

	loginCheck($con, $user, $password);

	
	// session_destroy();
?>