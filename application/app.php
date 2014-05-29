<?php

include 'get-questions.php';

define('SERVER',php_uname('n'));
define('ISJAIR',strpos(SERVER,'jair')!== false);
define('ISFRAN', strpos(SERVER, 'ubuntu')!== false);
define('ISPI', strpos(SERVER, 'raspberrypi')!== false);
/*** ENVIRONMENT ***/
if (ISJAIR){
  define('BASEURL', "http://localhost/flipupweb/");
}else if (ISFRAN){
  define('BASEURL', "http://localhost/flipup/websiteroot/");
}else if (ISPI){
  define('BASEURL', "http://10.2.215.160/flipup/");
}else {
  define('BASEURL', "https//web.cs.manchester.ac.uk/mbax3jp2/flipup/websiteroot/");
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
	function doLogin($user, $password) {
		global $con;	
		$userID = mysqli_fetch_array(mysqli_query($con, "SELECT userID FROM `User` WHERE name = '$user'"));
		$userID = $userID['userID'];

    if ($userID != null)
    {
      $hash = mysqli_fetch_array(mysqli_query($con, "SELECT password FROM `User` WHERE name = '$user'"));
      $hash = $hash['password'];

      if((checkHash($password, $hash))) {
        if(!ISJAIR && false)
          session_save_path("sessions/");       
        $_SESSION["loggedin"] = 1;
        $username = mysqli_query($con, "SELECT name FROM `User` WHERE userID = '$userID'");
        $username = mysqli_fetch_assoc($username);
        $_SESSION["user"] = $username["name"];
        $_SESSION["userID"] = $userID;
			}
			else
		    $_SESSION['message'] = 'Your username / password is incorrect.'; 
    }else{
	  	$_SESSION['message'] = 'Your username / password is incorrect.'; 
    }
	} // loginCheck

  function isLoggedIn(){
    return isset($_SESSION['userID']);
  }

	function checkHash($password,$hash){
		$parts = split(' ',$hash);
		$hash = $parts[0];
		$salt = $parts[1];
		return md5($password.$salt) == $hash;
	}

	function createHash($password){
		$salt = md5(time());
		return md5($password.$salt)." ".$salt;
	}
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
		$password =  createHash($password);
		$create = mysqli_query($con, "INSERT INTO `User` (name, password)
									  VALUES ('$user', '$password')");
									  // to be modified later on to accept pictures & description	
		return $create != false;
	} // create
	// -----------------------------------------------------------------------------------------------------

	// ------------------------------------------ get subjects ---------------------------------------------
	function getSubjects() {
		global $con;
		$result = mysqli_query($con, "SELECT name, subjectID as id from `Subject` ORDER BY name limit 5");
		while($subject = mysqli_fetch_array($result)) {
			$subjects[] = $subject;
		}
		
		return $subjects;
	} // getSubjects
	// -----------------------------------------------------------------------------------------------------

	// ----------------------------------------- get top decks ---------------------------------------------
	function getTopDecks() {
		global $con;
		$result = mysqli_query($con, <<<SQL
SELECT name, d.deckID as id
FROM `Deck` d
LEFT JOIN Quiz q on q.deckID = d.deckID
GROUP BY d.deckID,d.name,d.rating
ORDER BY d.rating+count(q.quizID)/2 desc, d.name
limit 5
SQL
);
    while($deck = mysqli_fetch_array($result)) {
			$decks[] = $deck;
		}
		return $decks;
	} // getDecks
	// -----------------------------------------------------------------------------------------------------

	// ----------------------------------------- get new decks ---------------------------------------------
function getNewDecks()
{
    global $con;
    $result = mysqli_query($con, "SELECT d.deckID,d.name FROM Deck d ORDER BY createdOn DESC LIMIT 5");
    while (($row = mysqli_fetch_assoc($result)))
        $rows[] = $row;
    return $rows;
}
	// -----------------------------------------------------------------------------------------------------

  // -------
  function getDecks($subjectID){
    global $con;
    $sql =  <<<SQL
    SELECT d.deckID as id,d.name as name,d.rating as rating,(
      select count(1) from Question q where q.deckID = d.deckID
    ) as questions
    FROM Deck as d
    WHERE d.subjectID = $subjectID
    group by d.deckID,d.name,d.rating
SQL
;
    $result = mysqli_query($con,$sql);
		while($deck = mysqli_fetch_array($result)) {
			$decks[] = $deck;
		}
		return $decks;
  } // getDecks

  function getSubjectInfo($subjectID){
    global $con;
    $result = mysqli_query($con,"SELECT name,subjectID AS id FROM Subject WHERE subjectID = $subjectID");

    return mysqli_fetch_array($result);
  }

  function pageInit($needsLogin = false){
    if(!ISJAIR && false){
      session_save_path("../database/sessions/");
    }
	  session_start();
    if($needsLogin && $_SESSION['loggedin'] != 1){
      $_SESSION['message'] = "you must be logged in to edit this question";
      header('location:' . getBaseUrl().'login.php');
      die();
    }
	}

  function deleteQuestion($questionID) {
    global $con;
    $creator = mysqli_query($con, "SELECT userID FROM `Question` WHERE questionID = $questionID");
      mysqli_query($con, "DELETE FROM `Question` WHERE questionID = $questionID");
  }

  function getScore($quizID) {
    global $con;
    $result = mysqli_query($con, "SELECT SUM(correct) AS score FROM `Result` WHERE quizID = $quizID");
    $score = mysqli_fetch_array($result);
    return $score['score'];
  }

  function getNoOfQuestions($quizID) {
    global $con;
    $result = mysqli_query($con, "SELECT startQuestions FROM `Quiz` WHERE quizID = $quizID");
    $noOfQuestions = mysqli_fetch_array($result);
    return $noOfQuestions['startQuestions'];
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
    $js = $jsArray;
	  include 'template/pageFoot.php';
	}

	/**
	 * this should return the non relative link to the subject
	 */
	function getLinkForSubject($subjectID){
	  return BASEURL."decks.php?subjectID=".$subjectID;
	}

  function getQuizLinkForDeck($deckID){
    return '#';
  }

  function getBaseUrl(){
	  return BASEURL;
	}