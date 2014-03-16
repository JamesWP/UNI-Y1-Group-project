<?php

include 'get-questions.php';

define(SERVER,php_uname('n'));
define(ISJAIR,strpos(SERVER,'jair')!== false);
/*** ENVIRONMENT ***/
if (ISJAIR){
  define(BASEURL, "http://localhost/flipupweb/");
}else{
  define(BASEURL, "http://webdev.cs.manchester.ac.uk/~mbax2ip4/websiteroot/");
}
/*** ENVIRONMENT ***/

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
				header("Location: " . getBaseUrl() . "index.php");
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
		return false;
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
			die("Account failed to be created.");
		else {
			$usercreated = 1;
			echo $usercreated;
			header("Location: " . getBaseUrl() . "signup-page.php"); 
		}
	} // create
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

  // -------
  function getDecks($subjectID){
    global $con;
    $result = mysqli_query($con, <<<SQL
    SELECT d.deckID as id,d.name as name,u.name as user,d.rating as rating,count(q.quizID) as total
    FROM Deck as d
    LEFT JOIN User as u on u.userID = d.userID
    LEFT JOIN Quiz as q on q.deckID = d.deckID
    WHERE d.subjectID = $subjectID
    GROUP BY d.deckID,d.name,u.name,d.rating
SQL
);
		while($deck = mysqli_fetch_array($result)) {
			$decks[] = $deck;
		}
		return $decks;
  } // getDecks

  function getSubjectInfo($subjectID){
    global $con;
    $result = mysqli_query($con,"select name,subjectID as id from Subject where subjectID = $subjectID");

    return mysqli_fetch_array($result);
  }

  function pageInit(){
    if(!ISJAIR){
      session_save_path("../database/sessions/");
    }
	  session_start();
	}

	/**
	 * this should print the page head to screen any parameters should be passed if
	 * required
	 */
	function pageHead($cssArray = array()){
    $css = $cssArray;
	  include 'template/pageHead.php';
	}

	/**
	 * this should render the page footer
	 */
	function pageFoot($jsArray = array()){
    $js = $jsArray();
	  include 'template/pageFoot.php';
	}

	/**
	 * this should return the non relative link to the subject
	 */
	function getLinkForSubject($subjectID){
	  return BASEURL."subject.php?id=".$subjectID;
	}

  function getQuizLinkForDeck($deckID){
    return '#';
  }

  function getBaseUrl(){
	  return BASEURL;
	}
