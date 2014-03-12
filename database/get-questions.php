<?php

include '../application/app.php';


/*
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
*/
function getNextQuestion($quizID){
  if(/*there is a row for the quiz in the quiz table*/){
    if(/*there is no more questions left for the quiz*/) {
      // return no more questions here
    }else{
      // find a question from the deck that is not in the results table for this quiz
      // return all the data for the question
    }
  }else{
    // return error here
  }
}

function saveQuestionResult($quizID,$result,$questionID){
  if(/* quiz id exists and result is valid true|false and questinoID*/){
    // insert into result a new row for this quizid and questionID
    // update the number of questions left --
  }else{
    // return error
  }
}

function getResults($quizID){
  // for the given quiz id find all results and return an array with for each question attempted...
  // - if the question was answered correctly 
  // - the question title ie the question number 'Question 1','Question 2'...
  // - the json for the question

  // also return the total number of questions answered correctly

  // so you should return an array / object

  // o['numcorrect'] = 10;
  // o['questions'] = array(); this should be all questions as dictated above
}

connectDB();

getQuestions();

disconnectDB();
