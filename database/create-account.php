<?php

	$database_host = "dbhost.cs.man.ac.uk";
	$database_user = "mbax2ip4";
	$database_pass = "vanillacupcake";

	$con = new mysqli($database_host , $database_user, $database_pass, "2013_comp10120_w2");

	/* Check connection */
	if (mysqli_connect_errno())
		echo "Failed to connect to MySQL: " . mysqli_connect_error();

	function available($user) {
		global $con;
		$userID = mysqli_fetch_array((mysqli_query($con, "SELECT userID FROM `User`
														  WHERE name = '$user'")));
		if ($userID['userID'] != null) 
			echo "Username unavailable!";
		else
			return true;
	} // available

	function create($user, $password) {
		global $con;
		$create = mysqli_query($con, "INSERT INTO `User` (name, password)
									  VALUES ('$user', '$password')");
									  // to be modified later on to accept pictures & description	
		if ($create == false)
			echo "Fail. Please try again!";
		else
			echo "Account successfully created!";
	} // create


	if (isset($_REQUEST['user']))
	$user = mysqli_real_escape_string($con, $_REQUEST['user']);

	if (isset($_REQUEST['password']))
	$password = mysqli_real_escape_string($con, $_REQUEST['password']);

	// to be modified later on to accept pictures & description

	if (available($user) == true)
		create($user, $password);

	mysqli_close($con);

?>