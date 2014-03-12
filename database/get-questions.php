<?php

include '../application/app.php';

function getQuestions($user, $quizID) {
	global $con;

	$result_userID = mysqli_query($con, "SELECT u.userID FROM `User` AS u
										 JOIN `Quiz` AS q on q.userID = u.userID
										 JOIN `Result` AS r on q.quizID = '$quizID'
										 WHERE u.name = '$user' LIMIT 1");
	$userID = $result_userID[0];

	var_export($userID);

	$result_questions = mysqli_query($con, "SELECT questionID FROM `Result` as r
											JOIN `Quiz` as q on q.userID = '$userID'
											AND q.quizID = '$quizID'
											AND r.quizID = q.quizID");
	//print_r($result_questions);
	while ($row = mysqli_fetch_array($result_questions)) {
		$questions[] = $question;
		}

	return $questions;

}

connectDB();

getQuestions('frannybabe', 15);

disconnectDB();
