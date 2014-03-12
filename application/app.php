<?php

	define(BASEURL, "http://webdev.cs.manchester.ac.uk/~mbax2ip4/websiteroot/");

	// this is where fran should link her functions and files together

	// -------------------------------------------- login --------------------------------------------------
	function loginCheck($user, $password) {
		global $con;	
		$userID = mysqli_fetch_array(mysqli_query($con, "SELECT userID FROM `User` WHERE name = '$user'"));
		$userID = $userID['userID'];

		if ($userID != null)
		{
			$hash = mysqli_fetch_array(mysqli_query($con, "SELECT password FROM `User` WHERE name = '$user'"));
			$hash = $hash['password'];

			if((password_verify($password, $hash))) {
				session_save_path("sessions/");				
				session_start();
				$_SESSION["loggedin"] = 1;
				$_SESSION["user"] = $user;
				header("Location: ../websiteroot/index.php");
			}
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
	// -----------------------------------------------------------------------------------------------------



	// -------------------------------------------- sign up ------------------------------------------------
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
		$password =  md5($password);
		$create = mysqli_query($con, "INSERT INTO `User` (name, password)
									  VALUES ('$user', '$password')");
									  // to be modified later on to accept pictures & description	
		if ($create == false)
			echo "Fail. Please try again!";
		else
			echo "Account successfully created!";
	} // create
	// -----------------------------------------------------------------------------------------------------



	function pageInit(){
	  session_save_path("../database/sessions/");
	  session_start();
	}

	/**
	 * this should print the page head to screen any parameters should be passed if
	 * required
	 */
	function pageHead(){
	  include 'template/pageHead.php';
	}

	/**
	 * this should render the page footer
	 */
	function pageFoot(){
	  include 'template/pageFoot.php';
	}

	/**
	 * this should return the non relative link to the subject
	 */
	function getLinkForSubject($subjectID){
	  return BASEURL."subject.php?id=".$subjectID;
	}

	function getBaseUrl(){
	  return BASEURL;
	}
