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



	// ---------------------------------------- connect to the DB ------------------------------------------
	function connectDB() {
		global $con;
		$database_host = "dbhost.cs.man.ac.uk";
		$database_user = "mbax2ip4";
		$database_pass = "vanillacupcake";

		$con = new mysqli($database_host , $database_user, $database_pass, "2013_comp10120_w2");

		/* Check connection */
		if (mysqli_connect_errno())
			die("Could not connect to DB.");
	}
	// -----------------------------------------------------------------------------------------------------
	


	// ------------------------------------- disconnect from the DB ----------------------------------------
	function disconnectDB() {
		global $con;
		mysqli_close($con);
	}
	// -----------------------------------------------------------------------------------------------------



	// ------------------------------------------ get subjects ---------------------------------------------
	function getSubjects() {
		global $con;
		$result = mysqli_query($con, "SELECT name, subjectID as id from `Subject` ORDER BY name LIMIT 5");
		while($subject = mysqli_fetch_array($result)) {
			$subjects[] = $subject;
		}
		
		return $subjects;
	} // getSubjects
	// -----------------------------------------------------------------------------------------------------
	

	// ----------------------------------------- get top decks ---------------------------------------------
	function getTopDecks() {
		global $con;
		$result = mysqli_query($con, "SELECT name, deckID as id from `Deck` ORDER BY rating, name LIMIT 5");
		while($deck = mysqli_fetch_array($result)) {
			$decks[] = $deck;
		}
		return $decks;
	} // getDecks
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
